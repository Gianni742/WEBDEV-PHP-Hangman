<?php
/**
 * Class Game.php
 * Class documentation
 *  All controls and functions for a running game go here:
 */

class Game extends Config
{
    // Controleer de user input (letter)
    // En handel deze correct af
    // @params: Capitalized letter wordt gebruikt om overige & geraden letters te tonen
    // @params: LoweredInputLetter wordt gebruikt om keyword letters te vergelijken
    public function ValidateInput($cappedInputLetter, $loweredInputLetter){
      array_push($_SESSION['gebruikteLetters'], $cappedInputLetter);
            if (in_array($loweredInputLetter, $_SESSION['gekozenLetters'])) {
                // blijf zolang doorzoeken totdat alle mogelijke resultaten gevonden zijn:
                // Dit is nodig wanneer een letter meerdere keren voorkomt in het keyword.
                while(in_array($loweredInputLetter, $_SESSION['gekozenLetters'])) {
                    $charloc = array_search($loweredInputLetter, $_SESSION['gekozenLetters']);
                    $_SESSION['TeRadenLetters'][$charloc] = $cappedInputLetter;
                    $_SESSION['gekozenLetters'][$charloc] = "0";
                }
            }
            else {
                // verander de image op basis van het aantal mislukte pogingen:
                if($_SESSION['imgProgression']  < 10){
                    $_SESSION['imgProgression'] += 1;
                // veranderd de image sneller op basis van difficulty:
                if($_SESSION['difficulty'] == "hard"){
                    if($_SESSION['imgProgression']  >= 5) {
                    $_SESSION['imgProgression']+= 1;
                    }
                }
                    $_SESSION['maxAttempts']--;
                }
                // wanneer al je pogingen op zijn:
                if(($_SESSION['imgProgression']  ==  10) && ($_SESSION['maxAttempts'] == 0)){
                    Echo "<div id='messageBox'><h2 class='alert'>Verloren!</h2>";
                    echo 'Het woord was: <b>';
                    echo ($_SESSION['key']);
                    echo "</b>
                   <form action=\"startscherm.php\" method=\"POST\">
                        <input id='messageButton' type=\"submit\" name=\"Opnieuw\" value=\"Probeer opnieuw\">
                   </form></div>
                  ";
                }
            }
        }
}
