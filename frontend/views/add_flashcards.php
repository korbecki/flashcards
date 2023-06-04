<!DOCTYPE html>
<html lang="en">
<head>
    <link href="frontend/style/add_flashcards.css" rel="stylesheet" type="text/css">
    <script>
        var counter = 2;

        function addInput() {
            var inputContainer = document.getElementById("inputContainer");

            var questionInput = document.createElement("input");
            questionInput.type = "text";
            questionInput.name = "question" + counter;
            questionInput.placeholder = "Pytanie " + counter;

            var answerInput = document.createElement("input");
            answerInput.type = "text";
            answerInput.name = "answer" + counter;
            answerInput.placeholder = "Odpowiedź " + counter;

            var container = document.createElement("div");
            container.className = "input-container";
            container.appendChild(questionInput);
            container.appendChild(answerInput);

            inputContainer.appendChild(container);

            counter++;
        }
    </script>
    <meta charset="UTF-8">
    <title>Flashcards</title>
</head>
<body>
<div class="base-container">
    <main>
        <header>
            <ul>
                <li>
                    <a href="http://localhost:8080/flashcards" class="button">Flashcards</a>
                </li>
                <li>
                    <a href="#" class="button">Friends</a>
                </li>
            </ul>
            <div class="search-bar">
                <form>
                    <input placeholder="Search flashcards">
                </form>
            </div>
            <div class="add-flashcards">
                <a href="#">+</a>
            </div>
        </header>
        <section class="add-flashcards-section">
            <form class="add-flashcards-form" action="addFlashcards" method="POST" enctype="multipart/form-data">
                <?php if(isset($messages)){
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }?>
                <div id="formMainData">
                    <input type="text" placeholder="Flashcards Name" name="name">
<!--                    <input type="text" placeholder="Flashcards Description" name="description">-->
                    <textarea name="description" rows = "3" placeholder="Description"></textarea>
                    <label>Upload icon<input type="file" name="file" placeholder=""></label>
                </div>
                <div id="inputContainer">
                    <input type="text" placeholder="Question" name="question1">
                    <input type="text" placeholder="Answer" name="answer1">
                </div>
                <button type="button" onclick="addInput()">Add</button>
                <button type="submit">Save</button>
            </form>
        </section>
    </main>

</div>
</body>
</html>