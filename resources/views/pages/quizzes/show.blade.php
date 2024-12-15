<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quiz->title }}</title>
</head>
<body>
    <h1>{{ $quiz->title }}</h1>
    <p>{{ $quiz->description }}</p>

    <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST">
        @csrf

        @foreach ($quiz->questions as $index => $question)
            <div style="margin-bottom: 20px;">
                <p><strong>{{ $index + 1 }}. {{ $question->question }}</strong></p>

                @if ($question->type === 'multiple_choice')
                    @foreach ($question->answers as $answer)
                        <div>
                            <label>
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}">
                                {{ $answer->answer }}
                            </label>
                        </div>
                    @endforeach
                @elseif ($question->type === 'short_answer')
                    <input type="text" name="answers[{{ $question->id }}]" placeholder="Jawaban Anda">
                @endif
            </div>
        @endforeach

        <button type="submit">Kirim Jawaban</button>
    </form>
</body>
</html>
