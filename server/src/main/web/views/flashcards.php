<!DOCTYPE html>
<html lang="en">
<head>
    <link href="web/style/style.css" rel="stylesheet" type="text/css">
    <link href="web/style/flashcards.css" rel="stylesheet" type="text/css">
    <link href="web/style/menu.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/fa2eac051b.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./web/script/search.js" defer></script>
    <meta charset="UTF-8">
    <title>Flashcards</title>
</head>
<body>
<div class="base-container">
    <main>
        <?php
        include "template/menu-template.php";
        ?>
        <section class="flashcards">

            <?php
            foreach ($my_flashcards as $flashcard):
                ?>

                <div id="project-1" onclick="redirect(<?= $flashcard->getFlashcardId(); ?>)">
                    <img src="web/images/upload/<?= $flashcard->getIcon(); ?>">
                    <div>
                        <h2><?= $flashcard->getName(); ?></h2>
                        <p><?= $flashcard->getDescription(); ?></p>
                        <div class="social-section">
                            <a>flashcards <?= $flashcard->getPagesCount(); ?></a>
                        </div>
                    </div>

                </div>

            <?php endforeach; ?>

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
                <a id="count">flashcards <?= $flashcard->getPagesCount(); ?></a>
            </div>
        </div>
    </div>
</template>
