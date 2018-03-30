<?php

namespace App\Controller;

use App\Repository\ComptesManager;
use App\Controller\GameController;
use App\Entity\Compte;

/**
 * LoginController gère les connexion utilisateur ainsi que les formulaires
 */
class LoginController extends SessionController
{
  /**
   * Reference in CompteManager Repository
   * @var ComptesManager
   */
  private $repository;

/**
 * __construct description
 */
  public function __construct()
  {
    $this->repository = new ComptesManager;
  }

/**
 * NewAccount method for add new user
 *
 * @param  array $form $_POST content
 * @return void       Redirection
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

  public function connectUser(array $form)
  {
    // Récupération des champs du formulaire si valide
    if ($this->isValid($form)) {
      // Vérification de la présence de l'utilisateur dans la base de donnée
      $user = $this->repository->getCompte($form['pseudo'], $form['password']);
      // Si l'utilisateur n'est pas présent
      if (isset($user) || empty($user)) {
        // On redirige l'utilisateur vers la page de création de compte
        $this->showNewAccountForm();
      }
      // Si l'utilisateur exite on stock les données dans $_SESSION

    }

    // Si l'utilisateur existe on stock ses informations dans la variable de session

    // On redirige l'utilisateur sur la page d'index
  }

  public function showConnectUser(): void
  {
    require GameController::PATH_VIEW . "/Login/connect.html";
  }

/**
 * showLoginForm return view form login
 *
 * @return void Return page HTML
 */
  public function showNewAccountForm(): void
  {
    require GameController::PATH_VIEW . "/Login/form.html";
  }

/**
 * Validator of form
 * @param  array $form form recive of newAccount method
 * @return bool       Return true if form is validated
 */
  private function isValid(array $form): bool
  {
    // var_dump($form);die;
    if ($form['CreerCompte'] === 'CreerCompte') {
      // Doit vérifié si tout les champs du formulaires son correctement renseigné
      if (!isset($form) || (empty($form['pseudo']) || empty($form['adresseMail']) || empty($form['password']))) {

        return false;
      }

      //Doit retourné true si le formulaire est valide et false dans le cas contraire
      return true;
    } elseif ($form['Connexion'] === 'Connexion') {
      if (!isset($form) || (empty($form['pseudo']) || empty($form['password']))) {
        return false;
      }
      //Doit retourné true si le formulaire est valide et false dans le cas contraire
      return true;
    }
  }

/**
 * checkPseudoIsNotUsed verify the user or email is not used in databae
 * @param  string $pseudo Pseudo of the user
 * @param  string $email  Email of the user
 * @return void         Return error or redirection about index
 */
  private function checkPseudoIsNotUsed(string $pseudo,string $email)
  {
    // Vérifi si le pseudo ou l'adresse mail n'est pas déjà utilisé.
    $resultat = $this->repository->getPseudoAndEmailNotUsed($pseudo, $email);

    // Si un résultat est trouvé alors on renvoi un message d'erreur
    if (!isset($resultat)) {

      $message = "Le pseudo ou l'adresse mail est déjà utilisé";

      return $message;
    }
    // Sinon on retourne la page d'acceuil
    header("location: /index");
  }

/**
 * msgForEmptyField method for validate form field and return the empty field
 * @param  array $form Array composed variable $_POST
 * @return string       return error message
 */
  private function msgForEmptyField(array $form): string
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
