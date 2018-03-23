<?php

namespace App\Controller;

use App\Repository\ComptesManager;
use App\Controller\GameController;
use App\Entity\Compte;

/**
 * [LoginController gère les connexion utilisateur ainsi que les formulaires]
 */
class LoginController
{
  /**
   * [Reference in CompteManager Repository]
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
 * [NewAccount method for add new user]
 *
 * @param  [array] $form [$_POST content]
 * @return [void]       [Redirection]
 */
  public function newAccount(array $form): void
  {
    // Récupération des différents champs du formulaire avant l'envoi
    // dans l'objet Compte
    if (isset($form) && !empty($form)) {
      // On instancie notre compte avec comme paramètre
      // les info fourni par notre formulaire
      $compte = new Compte($form);
      // Envois de l'objet compte à notre répository
      $this->repository->addCompte($compte);
      // Redirection vers notre page d'index
      header("location: /index");
    }
  }

/**
 * [showLoginForm return view form login]
 *
 * @return [void] [Return page HTML]
 */
  public function showNewAccountForm(): void
  {
    require GameController::PATH_VIEW . "/Login/form.html";
  }
}
