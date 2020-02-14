<?php
session_start();

// @info start een nieuwe sessie wanneer het spel voorbij is (nieuw spel):
if (isset($_POST['Opnieuw'])){
    session_destroy();
    header("Refresh:0");
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hangman startscherm</title>
</head>
<body>
    <h3> Welkom bij hangman </h3>



    <form method="post" action="index.php">
    <label for="difficulty">Select difficulty:
        <select id="difficulty" name="difficulty">
            <option selected value="10">Easy</option>
            <option value="7"> Hard</option>
        </select>
    </label>
        <h3><button type="submit" name="startGame">Start Game</button></h3>
    </form>


</body>
</html>
