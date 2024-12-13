<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quiz</title>
</head>
<body>
    <h1>Create a New Quiz</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('quiz.store') }}" method="POST">
        @csrf
        <label for="title">Quiz Title:</label>
        <input type="text" name="title" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br><br>

        <div id="questions">
            <h3>Questions:</h3>
            <div class="question">
                <label>Question:</label>
                <input type="text" name="questions[0][question]" required><br>

                <label>Answers:</label><br>
                @for ($i = 0; $i < 4; $i++)
                    <input type="text" name="questions[0][answers][{{ $i }}][answer]" required>
                    <label>
                        <input type="radio" name="questions[0][correct_answer]" value="{{ $i }}" {{ $i == 0 ? 'checked' : '' }}>
                        Correct
                    </label><br>
                @endfor
                <hr>
            </div>
        </div>

        <button type="button" id="add-question">Add Question</button><br><br>
        <button type="submit">Save Quiz</button>
    </form>

    <script>
        let questionCount = 1;

        document.getElementById('add-question').addEventListener('click', () => {
            const questionsDiv = document.getElementById('questions');
            const questionHtml = `
                <div class="question">
                    <label>Question:</label>
                    <input type="text" name="questions[${questionCount}][question]" required><br>

                    <label>Answers:</label><br>
                    ${[0, 1, 2, 3].map(i => `
                        <input type="text" name="questions[${questionCount}][answers][${i}][answer]" required>
                        <label>
                            <input type="radio" name="questions[${questionCount}][correct_answer]" value="${i}" ${i === 0 ? 'checked' : ''}>
                            Correct
                        </label><br>
                    `).join('')}
                    <hr>
                </div>
            `;
            questionsDiv.innerHTML += questionHtml;
            questionCount++;
        });
    </script>
</body>
</html>
