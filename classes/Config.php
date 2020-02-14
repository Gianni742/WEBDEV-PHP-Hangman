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
    protected $keyWord;

    public function __construct(){
        // get all the letters needed for the game.
        $this->Alphabet = range('A', 'Z');
    }

    public function SetKeyWord($key){
         $this->keyWord = $key;
    }

    public function GetKeyWord(){
        return $this->keyWord;
    }
}