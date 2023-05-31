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
        <form class="login" action="register" method="POST">
            <div class="message">
                <?php if(isset($messages)){
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }?>
            </div>
            <input name="email" placeholder="your@email.com" type="text">
            <input name="password" placeholder="password" type="password">
            <input name="user_name" placeholder="User name" type="text">
            <input name="surname" placeholder="Surname" type="text">
            <input name="name" placeholder="Name" type="text">

            <button type="submit">Register</button>
        </form>
    </div>
</div>
</body>
</html>