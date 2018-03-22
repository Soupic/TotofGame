<?php

namespace App\Repository;

class ComptesManager
{

  // Même chose ici on regroupe les constantes et les
  // attributs en début de classe pour plus de lisibilité

  const PSEUDO_UTILISE = 1;

  const MAIL_UTILISE = 2;

  const MAUVAIS_IDENTIFIANTS = 3;

  private $_db;

  public function __construct()
  {
    $this->setDb($this->dbConnect());
  }


  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }

  public function dbConnect()
  {
    try
    {
      $db = new PDO('mysql:host=localhost;dbname=mini_jeu', 'root', 'dawan');
      return $db;
    }
    catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
  }

  public function addCompte(Compte $info)
  {
  	$req = $this->dbConnect()->prepare('INSERT INTO compte_utilisateur (pseudo , password, adresseMail) VALUES (:pseudo, :password, :adresseMail)');

  	$req->bindValue(':pseudo', $info->pseudo());
  	$req->bindValue(':password', $info->password());
  	$req->bindValue(':adresseMail', $info->adresseMail());

  	$req->execute();

  	$info->hydrate([
  		'id' => $this->dbConnect()->lastInsertId()]);

    $req->closeCursor();
  }

  public function getCompte($infoPseudo, $infoPassword)
  {

    $req = $this->dbConnect()->prepare('SELECT * FROM compte_utilisateur WHERE pseudo = :pseudo');

    $req->execute([':pseudo' => $infoPseudo]);
    $donnees = $req->fetch(PDO::FETCH_ASSOC);

    if (password_verify($infoPassword,$donnees['password']))
    {
      return new Compte($donnees);
    }

    $req->closeCursor();
  }

  public function PseudoVerif($info)
  {
    $req = $this->dbConnect()->prepare('SELECT pseudo FROM compte_utilisateur WHERE pseudo = :pseudo');
    $req->execute(array(
      'pseudo' => $info));

    $resultat = $req->fetch();

    if($resultat)
    {
      return self::PSEUDO_UTILISE;
    }
    $req->closeCursor();
  }

  public function MailVerif($info)
  {
    $req = $this->dbConnect()->prepare('SELECT adresseMail FROM compte_utilisateur WHERE adresseMail = :adresseMail');
    $req->execute(array(
      'adresseMail' => $info));

    $resultat = $req->fetch();
    if($resultat)
    {
      return self::MAIL_UTILISE;
    }
    $req->closeCursor();
  }
}
