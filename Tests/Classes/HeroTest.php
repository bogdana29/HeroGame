<?php
declare(strict_types=1);
/**
 * Test Beast
 * Bogdana Vicol 
 * 
 */
 
use PHPUnit\Framework\TestCase; 
/**
 * Class PlayerAbstract  
 */
final class HeroTest extends TestCase
{
    /** @var $player 
    */
    protected   $player;
    protected function setUp():void
    { 
        $this->player = $this ->createMock('HeroGame\Entity\Player\PlayerAbstract') ;
        $this->player->setPlayerName('Jucator');
    }

    public function testPlayersAliveTrue(): void
    {            
        $this->assertEquals( $this->player->getPlayerName() ,'Jucator' );
       
    }
    
}
