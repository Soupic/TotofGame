<?php

namespace App\Repository;

/**
 *
 */
class EntityManager
{

/**
 * Name of host for Database access
 * @var string
 */
  private $host = 'localhost';

/**
 * Database Name
 * @var string
 */
  private $dbName = 'mini_jeu';

/**
 * User Name
 * @var string
 */
  private $user = 'root';

/**
 * Password DataBase
 * @var string
 */
  private $password = 'dawan';

/**
 * Variable for Database instance
 * @var \PDO
 */
  protected $db;

/**
 * __construct description
 */
  function __construct()
  {
    $this->db = $this->dbConnect();
  }

/**
 * dbConnect result in instance of PDO for connect to Database
 * @return object Return instance of PDO
 */
  public function dbConnect()
  {
    try
    {
      $db = new \PDO(
        'mysql:host='.
        $this->host .
        ';dbname=' .
        $this->dbName,
        $this->user,
        $this->password
      );

      return $db;
    }
    catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
  }

/**
 * readConfDb read yaml file conf
 * @return array Return array with in config database
 */
  private function readConfDb()
  {
    $fileConfDb = PATH_GAME . "/config/config_db.yml";

    $yamlParses = yaml_parse_file($fileConfDb);

    return $yamlParses;
  }

}
