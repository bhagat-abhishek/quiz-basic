<div class="p-4">
    @if (count($questions) > 0)
        <h2 class="text-lg font-semibold mb-4">Question {{ $currentQuestionIndex + 1 }}</h2>
        <p class="mb-4">{{ $questions[$currentQuestionIndex]['question'] }}</p>
        <ul class="mb-4">
            @foreach ($questions[$currentQuestionIndex]['options'] as $option)
                <li class="flex items-center space-x-2 mb-2">
                    <label class="flex items-center">
                        <input type="radio" class="form-radio" wire:model="selectedAnswers.{{ $currentQuestionIndex }}"
                            name="question_{{ $currentQuestionIndex }}" value="{{ $option }}">
                        <span class="ml-2">{{ $option }}</span>
                    </label>
                </li>
            @endforeach
        </ul>
        <p>Time Remaining: <span class="font-semibold" id="timer">{{ $timer }}</span> seconds</p>
        @if ($currentQuestionIndex < count($questions) - 1)
            <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                wire:click="nextQuestion">Next</button>
        @else
            <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                wire:click="submitQuiz">Submit</button>
        @endif
    @else
        <p>No questions available.</p>
    @endif

    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function() {
                let timer = document.getElementById('timer');
                let time = {{ $timer }};
                let interval;

                function startTimer() {
                    timer.textContent = time;

                    interval = setInterval(function() {
                        time--;
                        timer.textContent = time;

                        if (time === 0) {
                            clearInterval(interval);
                            Livewire.emit('timerFinished');
                        }
                    }, 1000);
                }

                Livewire.on('timerStarted', (timerValue) => {
                    time = timerValue;
                    clearInterval(interval);
                    startTimer();
                });

                startTimer();
            });
        </script>
    @endpush




</div>
