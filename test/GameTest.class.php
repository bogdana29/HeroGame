<?php
/**
 * Test Game
 * Bogdana Vicol 
 * 
 */

use PHPUnit\Framework\TestCase;
  
/**
 * Class GameTest
 *  
 * */
class GameTest extends TestCase
{
    /** @var $hero */
    protected $hero;

    /** @var $beast */
    protected $beast;

    /**
     * Set up test Classes
     */
    protected function setUp()
    {
        /* @var $hero \HeroGame\Classes\Hero|\PHPUnit_Framework_MockObject_MockObject */
        $hero = $this
            ->getMockBuilder('HeroGame\Classes\Hero')
            ->getMock()
        ;
        $hero
            ->setHealth(20)
            ->setStrength(30)
            ->setDefence(40)
            ->setSpeed(50)
            ->setLuck(60)
        ;
        $this->hero = $hero;

        /* @var $beast \HeroGame\Classes\Beast|\PHPUnit_Framework_MockObject_MockObject */
        $beast = $this
            ->getMockBuilder('HeroGame\Classes\Beast')
            ->getMock()
        ;
        $beast
            ->setHealth(25)
            ->setStrength(23)
            ->setDefence(45)
            ->setSpeed(65)
            ->setLuck(35)
        ;
        $this->beast = $beast;

        $game  = $this
            ->getMockBuilder('HeroGame\Classes\Game')
            ->getMock();

    ;
    }

    /**
     * Test for method that check that both player are alive
     */
    public function testPlayersAliveTrue()
    {

        $game = $this->game;

        self::assertTrue($game->initAttack(),)
        /* @var $hero \HeroGame\Classes\Hero|\PHPUnit_Framework_MockObject_MockObject */
        $hero = $this->hero;
        self::assertTrue($hero->getHealth() > 0, 'Hero is still alive');

        /* @var $beast \HeroGame\Classes\Beast|\PHPUnit_Framework_MockObject_MockObject */
        $beast = $this->beast;
        self::assertTrue($beast->getHeath() > 0, 'Beast is still alive');
    }
}
