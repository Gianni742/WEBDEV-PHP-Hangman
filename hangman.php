<?php

// @info als de speler het woord geraden heeft echo:
if (!in_array("__ ", $_SESSION['TeRadenLetters'])){

    Echo "<h2 class='alert'>Gefelciteerd je hebt gewonnen!</h2>";

    echo '<pre> Het woord was: ';
    echo ($_SESSION['key']);
    echo '</pre>';

    echo "
    <form action=\"startscherm.php\" method=\"POST\">
    <input type=\"submit\" name=\"Opnieuw\" value=\"Probeer opnieuw\">
    </form>
    ";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Opracht Hangman</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700|Righteous&display=swap" rel="stylesheet">
    <!--  custom css -->
    <link rel="stylesheet" href="style/hangman.css">
</head>
<body>

<div class="content">
    <div class="row">
        <div class="col-md-3">

                <h1>Hangman</h1>
                <h3>Probeer het woord te raden:</h3>

                <div class="raadsel">
                    <?php
                        echo "<h3>";
                            for ($i = 0; $i < count($_SESSION['TeRadenLetters']); $i++) {
                                echo $_SESSION['TeRadenLetters'][$i];
                            }
                        echo "</h3>";
                    ?>
</div>

<h3> Kies een letter: </h3>
<div class="keuzemenu">
    <form action="/index.php" method="post">
        <?php
        foreach ( $options as $optionValue) {
          if (in_array($optionValue, $_SESSION['gebruikteLetters'])) {
            echo $optionValue;
          } else {
            ?>
              <a href="?inputletter=<?php echo $optionValue ?>"><?php echo $optionValue ?></a> <?php
          }
        }
        ?>
    </form>
</div>
<br>
<h3>Aantal pogingen: <?php echo $_SESSION['maxAttempts'] ?></h3>
<br>
</div>

<div class="col-md-3 hangman">
    <img src="assets/img/<?php echo $_SESSION['imgProgression'] ?>.jpg">
</div>
</div>
</div>
</body>
</html>
