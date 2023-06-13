<!DOCTYPE html>
<html lang="en">
<head>
    <link href="web/style/add_flashcards.css" rel="stylesheet" type="text/css">
    <link href="web/style/menu.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="./web/script/add_flashcards.js" defer></script>

    <meta charset="UTF-8">
    <title>Flashcards</title>
</head>
<body>
<div class="base-container">
    <main>
        <?php
        include "template/menu-template.php";
        ?>
        <section class="add-flashcards-section">
            <form class="add-flashcards-form" action="addFlashcards" method="POST" enctype="multipart/form-data">
                <?php if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                } ?>
                <div id="formMainData">
                    <input type="text" placeholder="Flashcards Name" name="name">
                    <textarea name="description" rows="3" placeholder="Description"></textarea>
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