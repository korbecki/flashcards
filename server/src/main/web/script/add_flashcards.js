var counter = 2;

function addInput() {
    var inputContainer = document.getElementById("inputContainer");

    var questionInput = document.createElement("input");
    questionInput.type = "text";
    questionInput.name = "question" + counter;
    questionInput.placeholder = "Question ";

    var answerInput = document.createElement("input");
    answerInput.type = "text";
    answerInput.name = "answer" + counter;
    answerInput.placeholder = "Answer";

    var container = document.createElement("div");
    container.className = "input-container";
    container.appendChild(questionInput);
    container.appendChild(answerInput);

    inputContainer.appendChild(container);

    counter++;
}