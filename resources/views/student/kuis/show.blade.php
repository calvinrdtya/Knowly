@extends('layouts.apps')

@section('content')

<section>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                @include('student.layouts.aside')
            </aside>
            <!-- Menu -->
            
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    @include('student.layouts.nav')
                </nav>
                <!-- / Navbar -->
    
                <!-- Content wrapper -->
                <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl mt-4">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-center">
                        <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST" class=" mt-2 mx-auto">
                            @csrf
                            <div class="card shadow-sm">
                                <div class="card-header bg-primary">
                                    <h5 class="mb-0 text-white text-center">{{ $quiz->title }}</h5>
                                </div>
                                <div class="card-body p-4">
                                    @foreach ($quiz->questions as $index => $question)
                                        <div class="mb-4">
                                            <h6 class="fw-bold text-secondary">{{ $index + 1 }}.
                                                {{ $question->question }}</h6>
                                            @php
                                                $userAnswer = $userAnswers[$question->id] ?? null;

                                                $correctAnswer = $question
                                                    ->answers()
                                                    ->where('is_correct', true)
                                                    ->first();

                                                $isDisabled = $userAnswer !== null;
                                            @endphp

                                            @if ($question->type === 'multiple_choice')
                                                @foreach ($question->answers as $answer)
                                                    @php
                                                        $isCorrect =
                                                            $userAnswer !== null &&
                                                            $correctAnswer &&
                                                            $correctAnswer->id == $answer->id;
                                                        $isUserAnswer = $userAnswer == $answer->id;
                                                        $answerClass = '';

                                                        if ($isCorrect) {
                                                            $answerClass = 'text-success';
                                                        } elseif ($isUserAnswer && !$isCorrect) {
                                                            $answerClass = 'text-danger';
                                                        }
                                                    @endphp
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio"
                                                            name="answers[{{ $question->id }}]"
                                                            id="answer-{{ $answer->id }}"
                                                            value="{{ $answer->id }}"
                                                            @if ($isUserAnswer) checked @endif
                                                            @if ($isDisabled) disabled @endif>

                                                        <label class="form-check-label {{ $answerClass }}"
                                                            for="answer-{{ $answer->id }}">
                                                            {{ $answer->answer }}
                                                        </label>
                                                    </div>
                                                @endforeach

                                            @elseif ($question->type === 'short_answer')
                                                @php
                                                    $inputClass = '';
                                                    if ($userAnswer !== null && $correctAnswer) {
                                                        $inputClass =
                                                            strcasecmp($correctAnswer->answer, $userAnswer) ===
                                                            0
                                                                ? 'text-success'
                                                                : 'text-danger';
                                                    }
                                                @endphp
                                                <div class="form-group mt-2">
                                                    <input type="text" class="form-control {{ $inputClass }}"
                                                        name="answers[{{ $question->id }}]"
                                                        value="{{ $userAnswer ?? '' }}"
                                                        placeholder="Masukkan jawaban Anda"
                                                        @if ($isDisabled) disabled @endif>
                                                </div>
                                                @if ($isDisabled && $correctAnswer)
                                                    <small class="text-success">Jawaban Benar:
                                                        {{ $correctAnswer->answer }}</small>
                                                @endif
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <div class="card-footer pt-0">
                                    @if (auth()->user()->user_type === 'student')
                                        <button type="submit" class="btn btn-primary btn-md w-100">Submit</button>
                                    @endif
                                </div>
                            </div>
                        </form>     
                    </div>
                </div>                
                    <!-- / Content -->
        
                <div class="content-backdrop fade"></div>
                </div>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
          <!-- / Layout page -->
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
</section>
@endsection