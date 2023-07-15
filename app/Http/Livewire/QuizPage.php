<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Models\QuizSubmission;

class QuizPage extends Component
{
    public $questions = [];
    public $currentQuestionIndex = 0;
    public $selectedAnswers = [];
    public $timer = 30;
    public $score = 0;
    public $totalQuestions = 0;

    protected $listeners = ['timerFinished'];

    public function mount()
    {
        $questions = Question::with('answers')->get();

        foreach ($questions as $question) {
            $this->questions[] = [
                'id' => $question->id,
                'question' => $question->question_text,
                'options' => $question->answers->pluck('answer_text')->toArray(),
            ];
        }
    }

    public function render()
    {
        return view('livewire.quiz-page');
    }

    public function nextQuestion()
    {
        $this->currentQuestionIndex++;

        if ($this->currentQuestionIndex < count($this->questions)) {
            $this->timer = 30;
            $this->startTimerCountdown();
        } else {
            $this->submitQuiz();
        }
    }


    public function submitQuiz()
    {
        // Calculate the score
        $this->score = 0;
        $this->totalQuestions = count($this->questions);

        foreach ($this->questions as $index => $question) {
            $selectedAnswer = $this->selectedAnswers[$index] ?? null;

            // Check if the selected answer is correct
            $correctAnswer = Question::find($question['id'])
                ->answers()
                ->where('is_correct', true)
                ->value('answer_text');

            if ($selectedAnswer === $correctAnswer) {
                $this->score++;
            }
        }

        // Store the quiz submission
        QuizSubmission::create([
            'user_id' => auth()->user()->id,
            'score' => $this->score,
            'total_questions' => $this->totalQuestions,
        ]);

        // Redirect to the result page
        return redirect()->route('quiz.result', ['score' => $this->score]);
    }

    public function startTimerCountdown()
    {
        $this->emit('timerStarted', $this->timer);
    }

    public function timerFinished()
    {
        if ($this->currentQuestionIndex < count($this->questions)) {
            $this->nextQuestion();
        }
    }
}
