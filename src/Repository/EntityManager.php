<?php

namespace App\Repository;

/**
 *
 */
class EntityManager
{

/**
 * [Name of host for Database access]
 * @var [string]
 */
  private $host = 'localhost';

/**
 * [Database Name]
 * @var [string]
 */
  private $dbName = 'mini_jeu';

/**
 * [User Name]
 * @var [string]
 */
  private $user = 'root';

/**
 * [Password DataBase]
 * @var [string]
 */
  private $password = 'dawan';

/**
 * [Variable for Database instance]
 * @var [\PDO]
 */
  protected $db;

/**
 * [__construct description]
 */
  function __construct()
  {
    $this->db = $this->dbConnect();
  }

/**
 * [dbConnect result in instance of PDO for connect to Database]
 * @return [object] [Retourn instance of PDO]
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

}
