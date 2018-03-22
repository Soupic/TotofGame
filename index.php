<?php
// On enregistre notre autoload
// function chargerClasse($classname)
// {
//   require 'class/'.$classname.'.php';
// }
//
// spl_autoload_register('chargerClasse');

// Replace ton ancienne méthode d'autoload
// Ceci ce fait avec composer (Il te manque un cours sur l'injection de
// dépendance, tu verra c'est LAVY après)
// Il gère notament les namespace pour l'import de tes class
require __DIR__ . '/vendor/autoload.php';

// Appel le namespace de notre controller, pour l'instancier par la suite
use App\Controller\RouteController;

session_start(); // session_start doit etre placé apres l'autoload

//Définit une constante pour un retour direct au répertoire courrant
define("PATH_GAME", __DIR__);


//$_SERVER['PATH_INFO'] récupère notre URL
// if (isset($_SERVER["PATH_INFO"]) && ($_SERVER["PATH_INFO"] === "/index")) {
  $routeur = new RouteController;
  $routeur->parseRoute($_SERVER["PATH_INFO"]);
// }

// $managerPerso = new PersonnagesManager();
// $managerCompte = new ComptesManager();
//
//
// if (isset($_GET['page']) AND $_GET['page'] == 'creation')
// {
//     require 'controler/controlerCreationCompte.php';
// }
// elseif (empty($_SESSION['pseudo']) OR (isset($_GET['page']) AND $_GET['page'] == 'connexion'))
// {
//   require 'controler/controlerConnexionCompte.php';
// }
//
//
// elseif (!empty($_SESSION['pseudo']) AND (empty($_GET['page'])))
// {
//     require 'controler/controlerInformationGenerale.php';
// }
// elseif (isset($_GET['page']) AND $_GET['page'] == 'nouveauPersonnage')
// {
//   require 'controler/controlerCreationPersonnage.php';
// }





if (isset($_GET['deconnexion']))
{
  require 'controler/controlerDeconnexionCompte.php';
}

if (isset($message))
{
  require 'controler/controlerMessage.php';
}
