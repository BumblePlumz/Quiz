<div class="quiz-container">
    @if ($index < count($questions))
        <h2 class="text-xl font-bold mb-4">Question {{ $index + 1 }} sur {{ count($questions) }}</h2>
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

        <button wire:click="submitAnswer" class="px-4 py-2 bg-blue-500 text-white rounded">
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
    @endif
</div>
