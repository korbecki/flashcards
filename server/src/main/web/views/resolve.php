<!DOCTYPE html>
<html lang="en">
<head>
    <link href="web/style/resolve.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="./web/script/resolve.js" defer></script>
    <link href="web/style/menu.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <title>Flashcards</title>
</head>
<body>
<div class="base-container">
    <main>
        <?php
        include "template/menu-template.php";
        ?>
        <div class="flashcard">
            <div class="card-inner">
                <?php if (isset($page)): ?>
                    <p style="visibility: hidden" class="pageId"><?= $page->getPageId(); ?></p>
                    <div class="card-front">
                        <div class="question"><?= $page->getQuestion(); ?></div>
                        <div class="answer">
                            <input type="text" placeholder="Answer">
                        </div>
                        <div class="actions">
                            <button onclick="checkAnswer()">Sprawdź</button>
                            <button onclick="endQuiz()">Zakończ</button>
                        </div>
                    </div>
                    <div class="card-back">
                        <div class="answer"><?= $page->getAnswer(); ?></div>
                        <div class="actions">
                            <button onclick="nextCard()">Następna</button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
    </main>
</div>
</body>
</html>