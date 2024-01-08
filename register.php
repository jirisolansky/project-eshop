<?php

    if(isset($_POST[""])){

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://kit.fontawesome.com/d12e0dd2a7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">

    <title>Document</title>
</head>
<body>

    <header>
        <?php require "assets/header.php"; ?>
    </header>

    <form>
    <input type="text" name="first_name" placeholder="Křestní jméno"><br>
    <input type="text" name="second_name" placeholder="Příjmení"><br>
    <input type="password" name="password" placeholder="Heslo"><br>
    <input type="email" name="email" placeholder="E-mail"><br>
    <input type="date" name="date"><br>
    <input type="hidden" name="form-type" value="kontakt">
    <textarea name="message" placeholder="Vaše zpráva"></textarea><br>
    <!-- <input type="submit" value="Registrovat"> -->
    <button>Odeslat</button>
    </form>
    
    <footer>
        <?php require "assets/footer.php"; ?>
    </footer>
</body>
</html>