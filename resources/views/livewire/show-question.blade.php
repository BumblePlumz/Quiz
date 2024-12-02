<div class="quiz-container">
    @if ($index < count($questions))
        <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Question {{ $index + 1 }} sur
            {{ count($questions) }}</h2>
        <p class="mb-6 text-gray-900 dark:text-white">{{ $questions[$index]['question'] }}</p>

        <ul class="mb-6 text-gray-900 dark:text-white">
            @foreach ($questions[$index]['answers'] as $answer)
                <li wirekey:={{ $answer['id'] }} class="mb-2">
                    <label>
                        <input type="radio" wire:model="userAnswer" value={{ $answer['id'] }} />
                        {{ $answer['answer'] }}
                    </label>
                </li>
            @endforeach
        </ul>

        <button wire:click="submitAnswer" class="px-4 py-2 bg-blue-500 text-white rounded">
            Valider
        </button>
    @else
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Félicitations !</h2>
        <p class="text-gray-900 dark:text-white">Vous avez terminé le quiz avec {{ $score }}/5</p>
        <ul class="mt-6 text-gray-900 dark:text-white">
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
        <a class="btnTheme text-center text-lg font-semibold p-4 shadow rounded-lg float-end mb-4 hover:bg-blue-500 hover:text-white text-gray-900 dark:text-blue-500 dark:bg-white"
            href="{{ route('theme.show') }}">Continuer</a>
    @endif
</div>
