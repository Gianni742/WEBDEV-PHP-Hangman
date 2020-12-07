<?php

// include game attributes:
require_once ("classes/Config.php");
require_once ("classes/Game.php");


session_start();
$illegalCharacters = "/[`'\"~!@# $*()<>,:;{}\|]/";

// @info Setup session variables:

// Als de speler nog geen spel gestart heeft dan starten we een nieuwe:
// draag je objects in een session.
if (!isset($_SESSION['game'] )){


    if((!isset($_POST['startGame']) || preg_match('~[0-9]~',$_POST['keyword']) || preg_match($illegalCharacters,$_POST['keyword'])))
    {
       $_SESSION['errorMsg'] = 'Input can only contain letters!';
       return header('Location: startscherm.php');
    }

    $_SESSION['game'] = new Game();
    $_SESSION['config'] = new Config();
    // maakt een sessie om gebruikte letters bij te houden
    $_SESSION['gebruikteLetters'] = array();

    $_SESSION['config']->SetKeyWord($_POST['keyword']);

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

    // @info gebruik deze om te spieken:
/*
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

    // include hangman view:
    include_once("hangman.php");
