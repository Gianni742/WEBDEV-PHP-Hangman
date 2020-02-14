<?php

// @info als de speler het woord geraden heeft echo:
if (!in_array("__ ", $_SESSION['TeRadenLetters'])){
    Echo "<div id='messageBox'><h2 class='alert'>Gefeliciteerd, je bent gewonnen!</h2>";
    echo 'Het woord was: <b>';
    echo ($_SESSION['key']);
    echo "</b>
    <form action=\"startscherm.php\" method=\"POST\">
    <input id='messageButton' type=\"submit\" name=\"Opnieuw\" value=\"Probeer opnieuw\">
    </form></div>
    ";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Opracht Hangman</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700|Righteous&display=swap" rel="stylesheet">
    <!--  custom css -->
    <link rel="stylesheet" href="style/hangman.css">
</head>
<body>
                <h1>Hangman</h1>
                <div id="wrapper">
                  <div id="wrapperleft">
                                    <div class="boxleft" id="woord">
                <h2>Probeer het woord te raden:</h2>
                    <?php
                        echo "<h3>";
                            for ($i = 0; $i < count($_SESSION['TeRadenLetters']); $i++) {
                                echo $_SESSION['TeRadenLetters'][$i];
                            }
                        echo "</h3>";
                    ?>
</div>

<div class="boxleft" id="keuzemenu">
  <h2>Kies een letter:</h2>
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
    <h2>Resterende pogingen: <?php echo $_SESSION['maxAttempts'] ?></h2>
</div>
</div>
<div id="wrapperright">
    <img src="assets/img/<?php echo $_SESSION['imgProgression'] ?>.png  ">
  </div>
</div>
  </body>
</html>
