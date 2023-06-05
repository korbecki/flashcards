function checkAnswer() {
    var flashcard = document.querySelector('.flashcard');
    var cardInner = document.querySelector('.flashcard .card-inner');
    var input = document.querySelector('.flashcard .card-front input[type="text"]');
    var answer = document.querySelector('.flashcard .card-back .answer');
    var pageId = document.querySelector('.pageId').innerHTML;


    var correctAnswer = answer.innerHTML;
    var userAnswer = input.value;
    var isCorrect = userAnswer.toLowerCase() === correctAnswer.toLowerCase()

    if (isCorrect) {
        flashcard.classList.remove("wrong");
        flashcard.classList.add("correct");
    } else {
        flashcard.classList.remove("correct");
        flashcard.classList.add("wrong");
    }

    cardInner.style.transform = "rotateY(180deg)";

    const data = {
        pageId: pageId,
        isCorrect : isCorrect,
        answer: userAnswer};

    fetch("/saveAttempt", {
        method: "POST",
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    }).then(r => r.json());
}

function nextCard() {
    var flashcard = document.querySelector('.flashcard');
    flashcard.classList.remove("correct");
    flashcard.classList.remove("wrong");
    var cardInner = document.querySelector('.flashcard .card-inner');
    cardInner.style.transform = "rotateY(0deg)";
    document.querySelector('.flashcard .card-front input[type="text"]').value = "";

    var pageId = document.querySelector('.pageId').innerHTML;
    var question = document.querySelector('.flashcard .question');
    var answer = document.querySelector('.flashcard .card-back .answer');

    const data = {
        pageId: pageId};

    fetch("/getNextPage", {
        method: "POST",
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (page){
        pageId = page.pageId;
        question.innerHTML = page.question;
        answer.innerHTML = page.answer;
    });

}

function endQuiz() {
    var flashcard = document.querySelector('.flashcard');
    flashcard.style.display = "none";
}