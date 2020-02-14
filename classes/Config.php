<?php
/**
 * Class settings.php
 *
 * Class documentation

 *  Setup the basic configs to start a new game.
 */

class Config
{
    public $Alphabet;
    protected  $keyWord;

    public function __construct(){
        // get all the letters needed for the game.
        $this->Alphabet = range('A', 'Z');
        // Generate a new keyword
        $this->GenerateKeyWord();
    }

    public function GenerateKeyWord(){
        // explode — Split a string by a string
        // The file_get_contents() reads a file into a string.
        // leest heel de file in een lange string en splits deze op in array elementen:
        // @info LET OP alle woorden in de file moeten in lowercase!
        $keyWordValues = explode(",", file_get_contents('"./assets/woordenlijst_nl.txt'));
        // Deleting last array item to get rid of whitespace.
        array_pop($keyWordValues);
        // Genereer een random woord:
        $max = count($keyWordValues) - 1;
        $rndIdx = rand(0,$max);
        // assign keyWord value:
        $this->keyWord = $keyWordValues[$rndIdx];
    }

    public function GetKeyWord(){
        return $this->keyWord;
    }
}