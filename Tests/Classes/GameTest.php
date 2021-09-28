<?php
namespace HeroGame\Entity\Tests;
 
/**
 * Test Game
 * Bogdana Vicol 
 * 
 */

use PHPUnit\Framework\TestCase;
use HeroGame\Entity\Game;
/**
 * Class GameTest
 *  
 * */

class GameTest extends TestCase
{     
    /** @var $game 
    */
    protected   $game;
    protected function setUp():void
    { 
        $this->game = $this ->createMock('HeroGame\Entity\Game') ;
        $this->game->setTurnNumber(20);
    }

    public function testJocTemrinat()
    {    
       // $this->expectOutputString(' ' );
        $this->assertEquals(20, $this->game->getTurnNumber());
    }
}
