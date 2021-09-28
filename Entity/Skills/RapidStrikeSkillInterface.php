<?php
namespace HeroGame\Entity\Skills;

/**
 * Class RapidStrikeSkillInterface
 *  
 */
interface RapidStrikeSkillInterface{
    
    public function rapidStrike(int $damage): int;

}