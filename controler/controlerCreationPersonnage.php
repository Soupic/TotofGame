<?php

require 'view/viewCreationPersonnage.php';
var_dump($managerPerso->count($_SESSION['id']));


if (isset($_POST['CreerPersonnage']))
{
  if ($managerPerso->count($_SESSION['id']) < 4)
  {
    $perso = new Personnage([
      'nom' => $_POST['nom'],
      'vieMax' => 100,
      'forcePerso' => 2,
      'defensePerso' => 2,
      'degatMin' => 1,
      'degatMax' => 2,
      'endurenceMax' => 100,
      'idPlayer' => $_SESSION['id']]);

    if (empty($_POST['nom']))
    {
      $message = 'Il faut lui donner un petit nom a se pauvre perso.';
      return $message;
      unset($perso);
    }
    // On vérifie également si le nom du perso éxiste déjà si oui on le transmet dans la varaible $message
    elseif ($managerPerso->exists($perso->nom()))
    {
      $message = 'Le nom du personnage est déjà pris.';
      return $message;
      unset($perso);
    }
    //Si le nom est valide et n'est pas déjà pris alors on ajoute le perso a la base de données.
    else
    {
      $managerPerso->add($perso);
      header('location:index.php');
    }
  }
  else
  {
    $message = 'Tu ne peut pas créer plus de 4 personnages, désolé';
    return $message;
  }
}
