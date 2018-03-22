<?php

namespace App\Controller;

use App\Repository\ComptesManager;
use App\Controller\GameController;
use App\Entity\Compte;

/**
 *
 */
class LoginController
{
  /**
   * [private description]
   * @var ComptesManager
   */
  private $repository;

/**
 * [__construct description]
 */
  public function __construct()
  {
    $this->repository = new ComptesManager;
  }

/**
 * [login description]
 * @param  [type] $form [description]
 * @return [type]       [description]
 */
  public function login($form)
  {
    // Récupération des différents champs du formulaire avant l'envoi
    // dans l'objet Compte
    if (isset($form) && !empty($form)) {
      // On instancie notre compte avec comme paramètre
      // les info fourni par notre formulaire
      $compte = new Compte($form);
      // Envois de l'objet compte à notre répository
      $this->repository->addCompte($compte);

      return header("location: /index");
    }
  }

/**
 * [showLoginForm description]
 * @return [type] [description]
 */
  public function showLoginForm()
  {
    require GameController::PATH_VIEW . "/Login/form.html";
  }
}
