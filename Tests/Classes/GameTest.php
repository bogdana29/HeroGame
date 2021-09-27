<?php
namespace Tests;
 
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
    /**
     * testez daca sunt 
     */
    public function testPlayersAliveTrue()
    {    
        $this->expectOutputString('Revin cu testele dupa ziua de miercuri, daca mai e nevoie . (Am un deadline si ceva nu imi iese cand fac un Mock pe interfete )' );
        
    }
}
