<?php
namespace HeroGame\Entity;  
use HeroGame\Entity\Player\Hero  ;
use HeroGame\Entity\Player\Beast  ; 
use HeroGame\Entity\Logs\Logger as Logger  ; 
class Game{
    use Logger;
    const MAX_TURE_JOC = 20;
    const RAPID_STRIKE_CHANCE = 10;
    const MAGIC_SHIELD_CHANCE = 20;
    
    protected $hero ;
    protected $beast; 
    protected $turnNumber;
    protected $attacker;
    protected $damage;
    protected $winner;
    protected static $instances = [];
    
    public function __construct() { 
        $this->log('Game init');
    }
 
    private function setTurnNumber(int $turn) { 
        $this->turnNumber = $turn;
    }
    private function getTurnNumber() :int { 
        return $this->turnNumber;
    }
    
    public function startGame(){
        $this->log( 'Game started');
        $this->initGame();
        $turn = 1;
        $this->setTurnNumber($turn);
        while ($this->playersAreAlive() &&  $this->getTurnNumber() <= self::MAX_TURE_JOC) {  
            //$this->getInfoGame('Inainte de atac');
            
            $this->attack();
             
            $this->getInfoGame('');
            
            $turn++;
            $this->setTurnNumber($turn);
        }
        $this->endGame();
    }
    /**
     * 
     * functia unde se seteaza castigatorul jocului
     */
    private function endGame(){

        $this->winner = ($this->hero->getHealth() > $this->beast->getHealth()) ? $this->hero : $this->beast; 

        $this->log( '<b>Winner is: ' . $this->winner->getPlayerName() . ' </b>');
        $this->log( '<b>Rounds played : ' . $this->getTurnNumber(). '</b>');
        if($this->winner instanceof Hero) { 
            $this->log( 'Health of defender : ' . $this->beast->getHealth());
        }else if($this->winner instanceof Beast) { 
            $this->log( 'Health of defender : ' . $this->hero->getHealth());
        }else{
            $this->log( 'Defender unimplemented');
        }
    }
    /**
     * 
     * functia unde se desfasoara un atac
     */
    private function attack(){

        $this->setDamage();
        
        switch (get_class($this->attacker)){
            case 'HeroGame\Entity\Player\Hero' : 
                $health = $this->beast->getHealth() - $this->getDamage();
                $this->beast->setHealth($health);
                $this->attacker = $this->beast;
                break;
            case 'HeroGame\Entity\Player\Beast':
                $health = $this->hero->getHealth() - $this->getDamage();
                $this->hero->setHealth($health);
                $this->attacker = $this->hero;
                break;
            default :
                $this->log('Attacker unimplemented '.get_class($this->attacker));
                break;
        }       
         
    }
    private function getDamage():int{
        return $this->damage;
    }
    /**
     * 
     * functia calculeaza damage in functie de tipul de atac 
     * The damage is subtracted from the defender’s health. An attacker can miss their hit and do no damage if the defender gets lucky that turn.
     * Am presupus eu ca are noroc daca valoarea Luck == valoarea maxima 
     * 
     * se mai ia in calcul si Orderus’ skills occur randomly, based on their chances, so take them into account on each turn 
     * Rapid strike: Strike twice while it’s his turn to attack; there’s a 10% chance he’ll use this skill every time he attacks
     * Magic shield: Takes only half of the usual damage when an enemy attacks; there’s a 20%
     * change he’ll use this skill every time he defends.
     */
    private function setDamage(){
        
        if($this->defenderIsLucky()) return;
            
        switch (get_class($this->attacker)){
            case 'HeroGame\Entity\Player\Hero' : 
                //calcul damage 
                $this->damage = $this->hero->getStrength()-$this->beast->getDefence()  ;
                // daca ataca hero , atunci verific chance-ul hero-ului sa aiba Rapid strike 
                $chanceRapidStrike = (int)self::RAPID_STRIKE_CHANCE;
                $randomRapidStrike = round(mt_rand(1, (1 / $chanceRapidStrike) * 100)); // round it to make an integer
                if($randomRapidStrike == 1){
                    $this->log( '<font color = "blue" >Skill used : <b>Rapid Strike</b></font>');
                    $this->log( '<font color = "red" >Damage before ' .  $this->damage . '</font>');
                    
                    $this->damage = $this->hero->rapidStrike($this->damage);
                    
                    $this->log( '<font color = "red" >Damage after ' .  $this->damage . '</font>');
                }
                      
                break;
            case 'HeroGame\Entity\Player\Beast':    
                //calcul damage
                $this->damage =  $this->beast->getStrength()-$this->hero->getDefence();

                // daca ataca bestia, atunci verific chance-ul hero-ului sa aiba Magic shieds 
                $chanceMagicShield = (int)self::MAGIC_SHIELD_CHANCE;
                $randomMagicShield = round(mt_rand(1, (1 / $chanceMagicShield) * 100)); // round it to make an integer
                if($randomMagicShield == 1){
                    $this->log( '<font color = "blue" >Skill used : <b>Magic Shield</b></font>');
                    $this->log( '<font color = "red" >Damage before ' .  $this->damage . '</font>');
                    
                    $this->damage = $this->hero->magicShields($this->damage);

                    $this->log( '<font color = "red" >Damage after ' .  $this->damage . '</font>');
                    
                }                
                break;
        }
        
    }     
    /**
    * functia verifica daca jucatorii au noroc
    *  
    *  An attacker can miss their hit and do no damage if the defender gets lucky that turn.
    * 
    */
    private function defenderIsLucky(){
        switch (get_class($this->attacker)){
            case 'HeroGame\Entity\Player\Hero' : 
                $luck = $this->beast->getLuck(); // chance in percentage
                $random = round(mt_rand(1, (1 / $luck) * 100)); // round it to make an integer
                if($random == 1) { // luck% chance 0 damage
                    $this->log( '<font color = "green" >Luck for Beast</font>');
                    $this->log( '<font color = "red" >Damage before ' .  $this->damage . '</font>');
                    $this->damage = 0;
                    $this->log( '<font color = "red" >Damage after ' .  $this->damage . '</font>');
                    return true;
                }
                break;
            case 'HeroGame\Entity\Player\Beast':   
                $luck = $this->hero->getLuck(); // chance in percentage
                $random = round(mt_rand(1, (1 / $luck) * 100)); // round it to make an integer
                if($random == 1) { // luck% chance to 0 damage
                    $this->log( '<font color = "green" >Luck for Hero</font>');
                    $this->log( '<font color = "red" >Damage before ' .  $this->damage . '</font>');
                    $this->damage = 0;
                    $this->log( '<font color = "red" >Damage after ' .  $this->damage . '</font>');
                    return true;
                }
                break;               
        }        
        return false;
    }
    /**
    * functia verifica daca jucatorii au Health > 0 a.i. sa continue lupta
    */
    public function playersAreAlive(){
        if($this->hero->getHealth() > 0 && $this->beast->getHealth() > 0) return true;
        return false;
    }
    /**
    * se instantiaza hero , beast si se porneste batalia
    */
    private function initGame(){
        $this->initHero();
        $this->initBeast();
        $this->initAttack();
    }
    /**
     * instantiere Hero
     */
    private function initHero(){         
        $this->hero = new \HeroGame\Entity\Player\Hero();              
       // $this->hero = new  \Hero();              
    }
    /**
     * instantiere Beast
     */
    private function initBeast(){         
        $this->beast =  new \HeroGame\Entity\Player\Beast();
    }
    
    /**
     * functia stabileste jucatorul care ataca 
     * The first attack is done by the player with the higher speed. If both players have the same speed,than the attack is carried on by the player with the highest luck
     */
    private function initAttack(){        
        
        if($this->hero->getSpeed() > $this->beast->getSpeed()){
            $this->attacker = $this->hero;
        }else if($this->hero->getSpeed() < $this->beast->getSpeed()){
            $this->attacker = $this->beast;
        }else if($this->hero->getLuck() > $this->beast->getLuck()){
            $this->attacker = $this->hero;
        }else if($this->hero->getLuck() < $this->beast->getLuck()){
            $this->attacker = $this->beast;
        }else{
                /**daca si Luck sunt egale retrimit la initGame pentru a genera iar random valorile  */
            $this->initGame();
        }
        $this->log( 'Battle :  '.$this->hero->getPlayerName().' contra '. $this->beast->getPlayerName());
         
    }
    /**
     * 
     * functia afiseaza proprietatile celor 2 participanti dupa un atac
     */
    private function getInfoGame($info){
        $this->log( '<b>Round '.$this->getTurnNumber() .'</b>');
        if(trim($info) != '') $this->log( $info );
        $this->log( 'Attacker : <b>'.get_class($this->attacker) .'</b>');
        $this->log( 'Damage per attack : <b>'. $this->getDamage() .'</b>');
        $this->log( 'Hero properties: H:' .$this->hero->getHealth().
                    '; S:' .$this->hero->getStrength().
                    '; D:' .$this->hero->getDefence().
                    '; Sp:'.$this->hero->getSpeed().
                    '; L:' .$this->hero->getLuck());

        $this->log( 'Beast properties : H '. $this->beast->getHealth().
                    '; S:' .$this->beast->getStrength().
                    '; D:' .$this->beast->getDefence().
                    '; Sp:' .$this->beast->getSpeed().
                    '; L:' .$this->beast->getLuck())   ;
    }    
}