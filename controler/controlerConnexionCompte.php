<?php

require 'view/viewConnexionCompte.php';


if (isset($_POST['Connexion']))
{
	if (empty($_POST['pseudo']))
	{
		$message = 'Veuillez renseigner un pseudo.';
		return $message;
	}
	elseif (empty($_POST['password']))
	{
		$message = 'Veuillez renseigner un mot de passe';
		return $message;
	}

	else
	{
		$utilisateur = $managerCompte->getCompte($_POST['pseudo'],$_POST['password']);
		if (empty($utilisateur))
		{
			$message = 'Mauvaise combinaison Pseudo-Mot de Passe';
			unset($utilisateur);
			return $message;
		}
		else
		{
			$_SESSION['pseudo'] = $utilisateur->pseudo();
			$_SESSION['id'] = $utilisateur->id();
			header('location:index.php');
		}
	}
}


