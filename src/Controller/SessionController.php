<?php

namespace App\Controller;

use App\Entity\Compte;


/**
 *
 */
 class SessionController
{
  public function stockUserSession(Compte $user)
  {
    $pseudo = $user->_pseudo;
    $mail = $user->_adresseMail;

    $_SESSION["pseudo"] = $pseudo;
    $_SESSION["mail"] = $mail;

    var_dump($_SESSION);die; 
  }
}
