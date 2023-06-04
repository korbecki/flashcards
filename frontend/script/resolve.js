function checkAnswer() {
    var flashcard = document.querySelector('.flashcard');
    var cardInner = document.querySelector('.flashcard .card-inner');
    var input = document.querySelector('.flashcard .card-front input[type="text"]');
    var answer = document.querySelector('.flashcard .card-back .answer');

    var correctAnswer = answer.innerHTML;
    var userAnswer = input.value;

    if (userAnswer.toLowerCase() === correctAnswer.toLowerCase()) {
        flashcard.classList.remove("wrong");
        flashcard.classList.add("correct");
    } else {
        flashcard.classList.remove("correct");
        flashcard.classList.add("wrong");
    }

    cardInner.style.transform = "rotateY(180deg)";
}

function nextCard() {
    var flashcard = document.querySelector('.flashcard');
    flashcard.classList.remove("correct");
    flashcard.classList.remove("wrong");
    var cardInner = document.querySelector('.flashcard .card-inner');
    cardInner.style.transform = "rotateY(0deg)";
    document.querySelector('.flashcard .card-front input[type="text"]').value = "";
}

function endQuiz() {
    var flashcard = document.querySelector('.flashcard');
    flashcard.style.display = "none";
}