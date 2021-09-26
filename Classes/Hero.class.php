<?php
/**
 * Description of Hero
 *
 * @author Bogdana Vicol
 */
class Hero extends PlayerAbstract implements RapidStrikeSkillInterface,MagicStrikeSkillInterface{
    const NAME = 'Orderus';
    const HEALTH = ['MIN' => 70,'MAX' => 100];
    const STRENGTH = ['MIN' => 70,'MAX' => 80];
    const DEFENCE = ['MIN' => 45,'MAX' => 55];
    const SPEED = ['MIN' => 40,'MAX' => 50];
    const LUCK = ['MIN' => 10,'MAX' => 30];
    
    /**
     * This is the constructor for the Hero class 
     */
    function __construct() {
	     
	    //echo "I am a hero!";
        $this->setPlayerName(self::NAME);
        $this->setHealth($this->getrandom(self::HEALTH['MIN'],self::HEALTH['MAX']));
        $this->setStrength($this->getrandom(self::STRENGTH['MIN'],self::STRENGTH['MAX']));
        $this->setDefence($this->getrandom(self::DEFENCE['MIN'],self::DEFENCE['MAX']));
        $this->setSpeed($this->getrandom(self::SPEED['MIN'],self::SPEED['MAX']));
        $this->setLuck($this->getrandom(self::LUCK['MIN'],self::LUCK['MAX']));
    }

    /**
     * rapidStrike
     * ● Rapid strike: Strike twice while it’s his turn to attack; there’s a 10% chance he’ll use this skill every time he attacks
     * @return int
     */
    public function rapidStrike(int $damage):int {
        return $damage * 2;
    }
    
    /**
     * magic shield: Takes only half of the usual damage when an enemy attacks; there’s a 20% change he’ll use this skill every time he defends
     * @return string
     */
    public function magicShields(int $damage):int {
         
	    return $damage / 2;
    }

} 