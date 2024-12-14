@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@foreach($quizzes as $quiz)
    <div>
        <h3>{{ $quiz->title }}</h3>
        <a href="{{ route('quizzes.show', $quiz) }}">Mulai Kuis</a>
    </div>
@endforeach
