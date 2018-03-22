<?php

namespace App\Controller;

use App\Controller\GameController;
use \App\Controller\LoginController;

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
   * Parse les URL pour les comparé avec un tableau de valeur
   * @param  [string] $path URL
   * @return [string] retourn l'url si valide ou erreur 404
   */
  public function parseRoute($path)
  {
    // On vérifie si $path n'est pas null et n'est pas vide
    if (isset($path) && !empty($path)) {
      // On boucle sur le tableau pour récupéré l'url
      foreach ($this->routes as $nameRoute => $url) {
        // On compare l'url et le chemin fourni
        if ($url === $path) {
          // On vérifie sir $_POST n'est pas vide
          if (isset($_POST)) {
            // On retourne la méthode d'appel du controller avec $_POST
            return $this->getController($nameRoute, $_POST);
          }
          // On retourne une methode avec en paramètre la clé de la route
          return $this->getController($nameRoute);
        }
      }
      // Sinon on renvois une erreur 404
      return $this->error404;
    }
  }

  public function getController($pathName, $post = null)
  {
    switch ($pathName) {
      case 'index':
        $newGame = new GameController;
        $newGame->newGame();
        break;
      case 'login':
        $login = new LoginController;
        if (!empty($_POST)) {
          $login->newAccount($_POST);
        }
        $login->showNewAccountForm();
        break;
      default:
        $this->error404;
        break;
    }
  }

}
