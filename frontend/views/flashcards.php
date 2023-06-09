<!DOCTYPE html>
<html lang="en">
<head>
    <link href="frontend/style/style.css" rel="stylesheet" type="text/css">
    <link href="frontend/style/flashcards.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/fa2eac051b.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./frontend/script/search.js" defer></script>
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
                <input placeholder="Search flashcards">
            </div>
            <div class="add-flashcards">
                <a href="http://localhost:8080/addFlashcards">+</a>
            </div>
        </header>
        <section class="flashcards">

            <?php
                foreach ($my_flashcards as $flashcard):
            ?>

            <div id="project-1" onclick="redirect(<?=$flashcard->getFlashcardId(); ?>)">
                <img src="frontend/images/upload/<?=$flashcard->getIcon(); ?>" >
                <div>
                    <h2><?=$flashcard->getName(); ?></h2>
                    <p><?=$flashcard->getDescription(); ?></p>
                    <div class="social-section">
                        <a>flashcards <?=$flashcard->getPagesCount(); ?></a>
                    </div>
                </div>

            </div>

            <?php endforeach;?>

        </section>
    </main>

</div>
</body>
</html>

<template id="template">
    <div id="project-1">
        <img src="">
        <div>
            <h2>name</h2>
            <p>description</p>
            <div class="social-section">
                <a id="count">flashcards <?=$flashcard->getPagesCount(); ?></a>
            </div>
        </div>
    </div>
</template>
