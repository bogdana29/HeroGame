<?php
namespace HeroGame\Entity\Skills;

/**
 * Class MagicStrikeSkillInterface
 *  
 */
interface MagicStrikeSkillInterface{
    
    public function magicShields(int $damage): int;
}