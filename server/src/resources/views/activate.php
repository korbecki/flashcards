<!DOCTYPE html>
<html lang="en">
<head>
    <link href="frontend/style/style.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <title>Flashcards</title>
</head>
<body>
<div class="container">
    <div class="logo">
        <img alt="Logo image" src="frontend/images/logo.svg">
    </div>
    <div class="login-container">
        <form class="login" action="activate" method="POST">
            <div class="message">
                <?php if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                } ?>
            </div>
            <input name="email" placeholder="your@email.com" type="text">
            <input name="code" placeholder="ABCDEF" type="text">
            <button type="submit">ACTIVATE</button>
            <p>You don't received e-mail? <a href="http://localhost:8080/activateAgain">Send email again</a></p>
        </form>
    </div>
</div>
</body>
</html>