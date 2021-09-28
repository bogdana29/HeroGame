<?php 
namespace HeroGame\Entity\Player;

/**
 * Class PlayerAbstract
 *  
 */
abstract class PlayerAbstract
{
    /** @var $playerName string */
    protected $playerName;

    /** @var $health int */
    protected $health;

    /** @var $strength int */
    protected $strength;

    /** @var $defence int */
    protected $defence;

    /** @var $speed int */
    protected $speed;

    /** @var $luck */
    protected $luck;

    /**
     * PlayerAbstract constructor.
     */
    public function __construct()
    {
    }
    /**
     * Return a random number
     *
     * @param int $min
     * @param int $max
     *
     * @return int
     *
     * @throws \Exception
     */
    protected function getRandom(int $min = 10, int $max = 0): int
    {
       if ($min >= $max) {
           throw new \Exception('The values ' . $min . ' - ' . $max . ' - incorect') ;
       }

       return mt_rand($min, $max);
    }
    /**
     * @return string
     */
    public function getPlayerName(): string
    {
        return $this->playerName;
    }

    /**
     * @param string $playerName
     * @return PlayerAbstract
     */
    public function setPlayerName(string $playerName): PlayerAbstract
    {
        $this->playerName = $playerName;

        return $this;
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @param int $health
     * @return PlayerAbstract
     */
    public function setHealth(int $health): PlayerAbstract
    {
        $this->health = $health;

        return $this;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @param int $strength
     * @return PlayerAbstract
     */
    public function setStrength(int $strength): PlayerAbstract
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * @return int
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    /**
     * @param int $defence
     * @return PlayerAbstract
     */
    public function setDefence(int $defence): PlayerAbstract
    {
        $this->defence = $defence;

        return $this;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @param int $speed
     * @return PlayerAbstract
     */
    public function setSpeed(int $speed): PlayerAbstract
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLuck(): int
    {
        return $this->luck;
    }

    /**
     * @param mixed $luck
     * @return PlayerAbstract
     */
    public function setLuck(int $luck): PlayerAbstract
    {
        $this->luck = $luck;

        return $this;
    }
}