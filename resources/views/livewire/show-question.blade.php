<div class="quiz-container">
    @if ($index < count($questions))
        <h2 class="mb-4 text-xl font-bold">Question {{ $index + 1 }} sur {{ count($questions) }}</h2>
        <p class="mb-6">{{ $questions[$index]['question'] }}</p>

        <ul class="mb-6">
            @foreach ($questions[$index]['answers'] as $answer)
                <li wirekey:={{ $answer['id'] }} class="mb-2">
                    <label>
                        <input type="radio" wire:model="userAnswer" value={{ $answer['id'] }} />
                        {{ $answer['answer'] }}
                    </label>
                </li>
            @endforeach
        </ul>

        <button wire:click="submitAnswer" class="px-4 py-2 text-white bg-blue-500 rounded">
            Valider
        </button>
    @else
        <h2 class="text-2xl font-bold">Félicitations !</h2>
        <p>Vous avez terminé le quiz avec {{ $score }}/5</p>
        <ul class="mt-6">
            @foreach ($this->questions as $question)
                <li class="mb-4">
                    <h3 class="font-semibold">{{ $question['question'] }}</h3>
                    <ul>
                        @foreach ($question['answers'] as $answer)
                            @php
                                $id = $question['userResponse']['id'];
                                $classCSS = '';
                                if ($answer['isCorrect']) {
                                    $classCSS = 'text-green-500';
                                } elseif ($id === $answer['id']) {
                                    $classCSS = 'text-red-500';
                                }
                            @endphp
                            <li wire:key={{ $answer['id'] }} class="mb-2 {{ $classCSS }}">
                                {{ $answer['answer'] }}
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
        <a class="p-4 mb-4 text-lg font-semibold text-center rounded-lg shadow btnTheme float-end hover:bg-blue-500 hover:text-white"
            href="{{ route('theme.show') }}">Continuer</a>
    @endif
</div>

@vite(['resources/js/quiz/dailyQuiz.js'])
