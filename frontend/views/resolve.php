<!DOCTYPE html>
<html lang="en">
<head>
    <link href="frontend/style/add_flashcards.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <title>Flashcards</title>
</head>
<body>
<div class="base-container">
    <main>
        <header>
            <ul>
                <li>
                    <a href="#" class="button">Flashcards</a>
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
        <section class="resolve-section">
            <form class="resolve-form" action="addFlashcards" method="POST" enctype="multipart/form-data">
                <p>Question</p>
                <input>Your answer
                <button type="submit">Save</button>
            </form>
        </section>
    </main>

</div>
</body>
</html>