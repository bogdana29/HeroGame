<?php
/**
 * Description of Beast
 *
 * @author Bogdana Vicol
 */
class Beast extends PlayerAbstract{
    const NAME = 'The Beast';
    const HEALTH = ['MIN' => 60,'MAX' => 90];
    const STRENGTH = ['MIN' => 60,'MAX' => 90];
    const DEFENCE = ['MIN' => 40,'MAX' => 60];
    const SPEED = ['MIN' => 40,'MAX' => 60];
    const LUCK = ['MIN' => 25,'MAX' => 40];

    /**
     * This is the constructor for the Beast class. It will be called
     * when creating an Beast object ($Beast = new Beast();) or 
     * on of its subtypes (Hero or Beast). 
     */
    function __construct() {
	    
        $this->setPlayerName(self::NAME);
        $this->setHealth($this->getrandom(self::HEALTH['MIN'],self::HEALTH['MAX']));
        $this->setStrength($this->getrandom(self::STRENGTH['MIN'],self::STRENGTH['MAX']));
        $this->setDefence($this->getrandom(self::DEFENCE['MIN'],self::DEFENCE['MAX']));
        $this->setSpeed($this->getrandom(self::SPEED['MIN'],self::SPEED['MAX']));
        $this->setLuck($this->getrandom(self::LUCK['MIN'],self::LUCK['MAX']));
   
    }


} 