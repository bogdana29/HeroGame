<?php
declare(strict_types = 1);
 
error_reporting(E_ALL  & ~E_NOTICE & ~E_DEPRECATED & ~E_USER_DEPRECATED  & ~E_WARNING  );
//ini_set('display_errors', true);

//include './include/autoloader.inc.php';
require_once 'vendor/autoload.php';
echo "Hero game"; 
$game = new HeroGame\Entity\Game();
$game->startGame();