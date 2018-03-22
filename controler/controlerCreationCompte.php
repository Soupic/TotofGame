<?php

require 'view/viewCreationCompte.php';

if (isset($_POST['CreerCompte']))
{
	if (empty($_POST['pseudo']))
	{
		$message = 'Veuillez renseigner un pseudo.';
		return $message;
	}
	elseif (empty($_POST['adresseMail']))
	{
		$message = 'Veuillez renseigner une adresse mail';
		return $message;
	}
	elseif (empty($_POST['password']))
	{
		$message = 'Veuillez renseigner un mot de passe';
		return $message;
	}
	else
	{

		$retourPseudo = $managerCompte->pseudoVerif($_POST['pseudo']);
		$retourMail = $managerCompte->mailVerif($_POST['adresseMail']);

		if ($retourPseudo == ComptesManager::PSEUDO_UTILISE)
		{
			$message = 'Ce pseudo est déjà utilisé. Veuillez en choisir un autre.';
			return $message;
		}
		elseif ($retourMail == ComptesManager::MAIL_UTILISE)
		{
			$message = 'Cette adresse mail est déjà utilisé.';
			return $message;
		}

		else
		{
		$info = new Compte([
			'pseudo' => htmlspecialchars($_POST['pseudo']),
			'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
			'adresseMail' => htmlspecialchars($_POST['adresseMail'])
			]);
		$message = 'Votre compte a bien été créer';

		$managerCompte->addCompte($info);
		}
	}
}



