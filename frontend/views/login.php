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
        <form class="login" action="login" method="POST">
            <div class="message">
                <?php if(isset($messages)){
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }?>
            </div>
            <input name="email" placeholder="your@email.com" type="text">
            <input name="password" placeholder="password" type="password">
            <button type="submit">LOGIN</button>
        </form>
    </div>
</div>
</body>
</html>