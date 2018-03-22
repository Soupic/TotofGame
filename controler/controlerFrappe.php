<?php
if (!$managerPerso->exists((int) $_GET['frapper']))
{
  $message = 'le personnage que vous voulez frapper n\'existe pas !';
}

else 
{
	$persoAFrapper = $manager->get((int) $_GET['frapper']);// on fait en sorte que le noms du perso que l'on veut frapper soit un lien qui renvoi son id en GET que l'on récupère ici.

	$retour = $perso->frapper($persoAFrapper); // on utilise cette id pour utilisé la méthode frapper et on détaille les cas possible de cette methode.
	switch ($retour[0])
	{
	case Personnage::CEST_MOI :
	  $message = 'Mais... pourquoi voulez vous-vous frapper vous même???';
	  break;

	case Personnage::PERSONNAGE_FRAPPE :
	$message = 'Le personnage ' .$persoAFrapper->nom().' a bien été frappé ! et a subbit '.$retour[1].' de dégats';

	$manager->update($perso);
	$manager->update($persoAFrapper);
	break;

	case Personnage::PERSONNAGE_TUE :
	  $message = 'Vous avez tué le personnage '. $persoAFrapper->nom();

	  $manager->update($perso);
	  $manager->delete($persoAFrapper);
	  break;

	case Personnage::ATTAQUE_BLOQUE :
	$message ='L\'attaque a été bloqué';
	break;

	case Personnage::TROP_FATIGUE : 
	$message = 'Tu n\'as plus assez d\'endurence pour pouvoir frapper !';
	break;
	}
}