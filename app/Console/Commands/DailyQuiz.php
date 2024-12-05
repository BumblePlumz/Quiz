<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use DateTime;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Theme;

class DailyQuiz extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-quiz {theme} {difficulty} {--date=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to generate a daily quiz with a given theme and difficulty by a local API';

    private string $difficulty;
    private string $theme;
    private bool $stream = false;
    private float $temperature = 0.7;
    private float $top_p = 0.9;
    private string $format = 'json';
    private string $endpoint = 'http://localhost:11434/api/generate';
    private string $model = 'llama3.2';
    private string $prompt = 'Chaque question doit inclure :
    - Une seule question sous forme de chaîne de caractères.
    - Quatre options de réponse sous forme de tableau de chaînes de caractères.
    - L\'index (commençant à 0) de la réponse correcte.
   
    Output the result in this JSON format:
    {
        \"0\": {
            \"question\": \"...?\",
            \"answers\": [
                \"...\",
                \"...\",
                \"...\",
                \"...\"
            ],
            \"correctAnswerIndex\": x
        },
        \"1\": {
            \"question\": \"...?\",
            \"answers\": [
                \"...\",
                \"...\",
                \"...\",
                \"...\"
            ],
            \"correctAnswerIndex\": x
        },
        \"2\": {
            \"question\": \"...?\",
            \"answers\": [
                \"...\",
                \"...\",
                \"...\",
                \"...\"
            ],
            \"correctAnswerIndex\": x
        },
        \"3\": {
            \"question\": \"...?\",
            \"answers\": [
                \"...\",
                \"...\",
                \"...\",
                \"...\"
            ],
            \"correctAnswerIndex\": x
        },
        \"4\": {
            \"question\": \"...?\",
            \"answers\": [
                \"...\",
                \"...\",
                \"...\",
                \"...\"
            ],
            \"correctAnswerIndex\": x
        }
    }';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = $this->option('date') ? $this->option('date') : now()->format('Y-m-d');
        $this->difficulty = $this->argument('difficulty');
        $this->theme = $this->argument('theme');
        $seed = Str::uuid();
        $currentPrompt = "Génère un quiz à propos de {$this->theme} avec 5 questions {$this->difficulty}. {$this->prompt}";
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($this->endpoint, [
                'model' => $this->model,
                'prompt' => $currentPrompt,
                'stream' => $this->stream,
                'temperature' => $this->temperature,
                'top_p' => $this->top_p,
                'format' => $this->format,
                'seed' => $seed,
            ]);

            if ($response->failed()) throw new \Exception('Failed to get the daily quiz');
            $response = $response->json();
            $jsonString = $response['response'] ?? null;
            if (!$response) throw new \Exception('Failed to get the daily quiz');

            // Nettoyer la chaîne JSON si nécessaire (enlever les sauts de ligne)
            $jsonString = str_replace("\n", "", $jsonString);

            // Décoder la chaîne JSON en un tableau associatif
            $data = json_decode($jsonString, true);
            $theme = Theme::where('name', $this->theme)->first();
            foreach ($data as $questionData) {
                dump($questionData);
                $question = Question::create([
                    'question' => $questionData['question'],
                    'difficulty' => 'medium',
                    'theme_id' => $theme->id,
                    'generated_at' => $date,
                ]);
                $question->save();
                for ($i = 0; $i < count($questionData['answers']); $i++) {
                    $isCorrect = 0;
                    if ($i == $questionData['correctAnswerIndex']) {
                        $isCorrect = 1;
                    }
                    $answer = Answer::create([
                        'question_id' => $question->id,
                        'answer' => $questionData['answers'][$i],
                        'is_correct' => $isCorrect,
                        'generated_at' => $date,
                    ]);
                    $question->answers()->save($answer);
                }
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
