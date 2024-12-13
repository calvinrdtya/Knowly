<h3>{{ $quiz->title }}</h3>
<form action="{{ route('quizzes.submit', $quiz) }}" method="POST">
    @csrf
    @foreach($quiz->questions as $question)
        <div>
            <p>{{ $question->question }}</p>
            @foreach($question->answers as $answer)
                <div>
                    <label>
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}">
                        {{ $answer->answer }}
                    </label>
                </div>
            @endforeach
        </div>
    @endforeach
    <button type="submit">Kirim Jawaban</button>
</form>
