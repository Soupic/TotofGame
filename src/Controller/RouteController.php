<?php

namespace App\Controller;

use App\Controller\GameController;

class RouteController
{
  // Définition de l'erreur 404
  private $error404 = "404";
  // Création d'un tableau contenant nos routes
  private $routes = [
    "index" => "/index",
    "login" => "/login",
  ];

  /**
   * [parseRoute description]
   * @param  [string] $path URL
   * @return [type]       [description]
   */
  public function parseRoute($path)
  {
    // On vérifie si $path n'est pas null et n'est pas vide
    if (isset($path) && !empty($path)) {
      // On boucle sur le tableau pour récupéré l'url
      foreach ($this->routes as $nameRoute => $url) {
        // On compare l'url et le chemin fourni
        if ($url === $path) {
          // On appel une methode avec en paramètre le nom de la route
          return $this->getController($nameRoute);
        }
      }
      // sinon on renvois une erreur 404
      return $this->error404;
    }
  }

  public function getController($pathName)
  {
    switch ($pathName) {
      case 'index':
        $newGame = new GameController;
        $newGame->newGame();
        break;

      default:
        # code...
        break;
    }
  }

}
