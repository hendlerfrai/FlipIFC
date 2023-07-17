<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="cronometro.js"></script>

    <title> FlipIFC </title>


    <head>
        <style>

        </style>
    </head>

<body>
    <div class='parent'>
        <div class="magicpattern">
            <div class="contagem">
                <h1 id="timer"></h1>
            </diV>
            <div>
                <h1 id="">ciências humanas</h1>
            </div>
            <br>
            <div class="perg">
                <p id="question">pergunta 01: qual a capital da França? </p>
            </div>
            <br>

            <br>
            <div class="container" id="options">
                <button onclick="checkAnswer('Paris')">Paris</button>
                <button onclick="checkAnswer('Londres')">Londres</button>
                <button onclick="checkAnswer('Roma')">Roma</button>
                <button onclick="checkAnswer('Madri')">Madri</button>
            </div>
        </div>

        <script>
            // Definir as perguntas e respostas corretas
            const questions = [
                {
                    question: 'Qual é a capital da França?',
                    answer: 'Paris'
                }
            ];

            let currentQuestion = 0;
            let score = 0;
            let countdown;

            // Função para verificar a resposta selecionada
            function checkAnswer(answer) {
                if (answer === questions[currentQuestion].answer) {
                    score++;
                }

                currentQuestion++;
                showNextQuestion();
            }

            // Função para exibir a próxima pergunta ou resultado final
            function showNextQuestion() {
                if (currentQuestion < questions.length) {
                    document.getElementById('question').textContent = questions[currentQuestion].question;
                } else {
                    clearInterval(countdown);
                    document.getElementById('question').textContent = 'Quiz concluído! Sua pontuação final é: ' + score;
                    document.getElementById('options').innerHTML = '';

                }
            }
        </script>

</body>

</html>