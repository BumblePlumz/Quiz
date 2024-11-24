<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Question;
use App\Models\Answer;

class DailyQuiz extends Command
{
    private string $endpoint = 'http://localhost:11434/api/generate -d';
    private string $model = 'llama3.2';
    private string $prompt = 'Answer only following stricly this json schema: 
    {
        "question": "Que pensez-vous du film Inception ?",
        "answers": [
            "Le film explore des concepts profonds comme les rêves et la réalité.",
            "La performance de Leonardo DiCaprio est exceptionnelle.",
            "La bande sonore de Hans Zimmer est mémorable.",
            "Certains spectateurs peuvent trouver l\'intrigue complexe."
        ],
        "correctAnswerIndex": 1
    }
    Create a quiz about PHP with 5 questions and 4 answers and one of them is true. The difficulty of the questions should be medium';
    private string $stream = "false";
    private string $temperature = "0.5";
    private string $format = 'json';


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-quiz';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try{
            $response = Http::post($this->endpoint, [
                'model' => $this->model,
                'prompt' => $this->prompt,
                'stream' => $this->stream,
                'temperature' => $this->temperature,
                'format' => $this->format,
            ]);
            if ($response->failed()) throw new \Exception('Failed to get the daily quiz');
            $data = $response->json();

            $questionData = $data['question'] ?? null;
            $question = Question::create([
                'question' => $questionData,
                'difficulty' => 'medium',
            ]);
            $question->save();

            $answersData = $data['answers'] ?? [];
            $isCorrectIndexData = $data['correctAnswerIndex'] ?? null;
            foreach($answersData as $answerData){
                    $answer = Answer::create([
                    'answer' => $answerData,
                    'is_correct' => $isCorrectIndexData,
                ]);
                $answer->save();
            }
        }catch(\Exception $e){
            $this->error($e->getMessage());
        }
    }
}
