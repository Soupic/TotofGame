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
      // Vérifcation si le formulaire est valide
    if ($this->isValid($form)) {
      // On vérifie si le pseudo ou l'adresse mail n'est pas déjà utilisé
      $this->checkPseudoIsNotUsed($form['pseudo'], $form['adresseMail']);
      // On instancie notre compte avec comme paramètre
      // les info fourni par notre formulaire
      $compte = new Compte($form);
      // Envois de l'objet compte à notre répository
      $this->repository->addCompte($compte);
      // Redirection vers notre page d'index
      header("location: /index");
    } else {
      // Vérifi quel sont les champs manquant
      $this->msgForEmptyField($form);
      // Redirige vers la page de login
      header('location: /login');
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

/**
 * [Validator of form]
 * @param  [array] $form [form recive of newAccount method]
 * @return [bool]       [Return true if form is validated]
 */
  private function isValid(array $form): bool
  {
    // Doit vérifié si tout les champs du formulaires son correctement renseigné
    if (!isset($form) || (empty($form['pseudo']) || empty($form['adresseMail']) || empty($form['password']))) {

      return false;
    }

    //Doit retourné true si le formulaire est valide et false dans le cas contraire
    return true;
  }

  private function checkPseudoIsNotUsed($pseudo, $email)
  {
    $this->repository->getPseudoAndEmailNotUsed($pseudo, $email);
  }

/**
 * [msgForEmptyField method for validate form field and return the empty field]
 * @param  [array] $form [Array composed variable $_POST]
 * @return [string]       [return error message]
 */
  private function msgForEmptyField($form)
  {
    // Doit retourné la valeur manquante
    foreach ($form as $field => $value) {
      if ($value === '') {
        // var_dump($field);die;
        $msg = 'Le ' . $field . ' n\'est pas renseigné';
      }
      return $msg;
    }
  }
}
