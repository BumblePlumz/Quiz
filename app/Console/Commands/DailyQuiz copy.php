<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
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
    protected $signature = 'app:daily-quiz {theme} {difficulty}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private string $difficulty;
    private string $theme;
    private string $endpoint = 'http://localhost:11434/api/generate';
    private string $model = 'llama3.2';
    private string $prompt = 'Each question should include:
    - A single question as a string.
    - Four answer options as an array of strings.
    - The index (0-based) of the correct answer.

   
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

    private bool $stream = false;
    private string $temperature = "0.7";
    private string $format = 'json';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->difficulty = $this->argument('difficulty');
        $this->theme = $this->argument('theme');
        $currentPrompt = "Create a quiz about {$this->theme} with 5 {$this->difficulty} questions. {$this->prompt}";
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($this->endpoint, [
                'model' => $this->model,
                'prompt' => $currentPrompt,
                'stream' => $this->stream,
                'temperature' => $this->temperature,
                'format' => $this->format,
            ]);

            if ($response->failed()) throw new \Exception('Failed to get the daily quiz');
            $response = $response->json();
            $jsonString = $response['response'] ?? null;
            if (!$response) throw new \Exception('Failed to get the daily quiz');

            // Nettoyer la chaîne JSON si nécessaire (enlever les sauts de ligne)
            $jsonString = str_replace("\n", "", $jsonString);

            // Décoder la chaîne JSON en un tableau associatif
            $data = json_decode($jsonString, true);
            $theme = Theme::where('name', 'PHP')->first();
            foreach($data as $questionData) {
                dump($questionData);
                $question = Question::create([
                    'question' => $questionData['question'],
                    'difficulty' => 'medium',
                    'theme_id' => $theme->id,
                ]);
                $question->save();
                for($i = 0; $i < count($questionData['answers']); $i++) {
                    $isCorrect = 0;
                    if ($i == $questionData['correctAnswerIndex']) {
                        $isCorrect = 1;
                    }
                    $answer = Answer::create([
                        'question_id' => $question->id,
                        'answer' => $questionData['answers'][$i],
                        'is_correct' => $isCorrect,
                    ]);
                    $question->answers()->save($answer);
                }
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
