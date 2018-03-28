<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Repository\ComptesManager;

/**
 * Lunch the Game
 */
class GameController
{
  const PATH_VIEW = PATH_GAME . "/src/View/";

  public function newGame()
  {
    require self::PATH_VIEW . '/Game/newGame.html';
  }

}
