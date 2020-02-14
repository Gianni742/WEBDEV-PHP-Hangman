<?php

// include game attributes:
require_once ("classes/Config.php");
require_once ("classes/Game.php");

//echo __FILE__.__LINE__.__FUNCTION__.'<br />';
//echo '<pre>';
//var_dump($_POST);
//echo '</pre>';

session_start();

// @info Setup session variables:

// Als de speler nog geen spel gestart heeft dan starten we een nieuwe:
// draag je objects in een session.
if (!isset($_SESSION['game'] )){

    if((!isset($_POST['startGame'])))
    {
       return header('Location: startscherm.php');
    }


    $_SESSION['game'] = new Game();
    $_SESSION['config'] = new Config();

    // @info max = 10
    $_SESSION['imgProgression'] = 0;
    $_SESSION['maxAttempts'] = $_POST["difficulty"];
    $_SESSION['difficulty'] = "";

    if($_POST["difficulty"] == 7){
        $_SESSION['difficulty'] = "hard";
    }
    else{
        $_SESSION['difficulty'] = "easy";
    }


//    echo __FILE__.__LINE__.__FUNCTION__.'<br />';
//    echo '<pre>';
//    var_dump($_SESSION['difficulty']);
//    echo '</pre>';
    

    $keyword = $_SESSION['config']->GetKeyWord();

    if(!isset($_SESSION['key'])){
        $_SESSION['key'] = $keyword;
    }

// @info breekt het keyword in aparte letters voor een array.
    $_SESSION['gekozenLetters'] = str_split($keyword);

    // maak een nieuwe array met dezelfde lengte en vul deze met lege karakters
    // als een geraden value uit $_GET overeen komt met een letter in
    // $_SESSION['gekozenLetters'] dan vang de positie op van deze waarde en
    // verander deze in $_SESSION['TeRadenLetters'].

// @info stop de vooruitgang van het te raden woord ook in een sessie:

    for ($i = 0; $i < count($_SESSION['gekozenLetters']); $i++) {
        $_SESSION['TeRadenLetters'][$i] = "__ ";
    }
}

$options = $_SESSION['config']->Alphabet;

    // @info gebruik deze voor debugging of om te spieken:

/*
    echo __FILE__.__LINE__.__FUNCTION__.'<br />';
    echo '<pre>';
    var_dump($_SESSION['TeRadenLetters']);
    echo '</pre>';

    echo __FILE__.__LINE__.__FUNCTION__.'<br />';
    echo '<pre>';
    var_dump($_SESSION['key']);
    echo '</pre>';
*/

    // @info | als een letter is geraden doe er iets mee:
    if(isset($_GET['inputletter'])) {

        $inputInCaps = $_GET['inputletter'];

        // @info | input letter naar lower om hem te vergelijken met de te raden letters
        $loweredInput = strtolower($inputInCaps);

        // valideer de input van de letter:
        $_SESSION['game']->ValidateInput($inputInCaps, $loweredInput);

    }

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
    <!--  custom css -->
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

<div class="content">
    <div class="row">
        <div class="col-md-3">

                <h2>Hangman Game</h2>
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
                     ?>

                        <a href="?inputletter=<?php echo $optionValue ?>"><?php echo $optionValue ?></a>
                    <?php
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
