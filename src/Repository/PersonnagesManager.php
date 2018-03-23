<?php

namespace App\Repository;

use App\Repository\EntityManager;

class PersonnagesManager extends EntityManager
{

  /** Les attributs et les constantes
  * doivent être placé au début de ta classe
  * pour un souci de lisibilité
  ***/
  const PSEUDO_UTILISE = 1;


  public function add(Personnage $perso)
  {
    $req = $this->dbConnect()->prepare('INSERT INTO
      personnages(nom, forcePerso, defensePerso, vieMax, degatMin, degatMax, endurenceMax, idPlayer
      ) VALUES (
        :nom, :forcePerso, :defensePerso, :vieMax, :degatMin, :degatMax, :endurenceMax, :idPlayer
      )');

    $req->bindValue(':nom', $perso->nom());
    $req->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
    $req->bindValue(':defensePerso', $perso->defensePerso(), PDO::PARAM_INT);
    $req->bindValue(':vieMax', $perso->vieMax(), PDO::PARAM_INT);
    $req->bindValue(':degatMin', $perso->degatMin(), PDO::PARAM_INT);
    $req->bindValue(':degatMax', $perso->degatMax(), PDO::PARAM_INT);
    $req->bindValue(':endurenceMax', $perso->endurenceMax(), PDO::PARAM_INT);
    $req->bindValue(':idPlayer', $perso->idPlayer(), PDO::PARAM_INT);

    $req->execute();

    $perso->hydrate([
      'id' => $this->dbConnect()->lastInsertId(),
      'degats' => 0,
      'fatigue' => 0,
      'chanceCritique' => 0,
      'multiplicateurCritique' => 0,
    ]);
    $req->closeCursor();
  }

  public function count($idPlayer)
  {
    return $this->dbConnect()->query('SELECT COUNT(*) FROM personnages WHERE idPlayer = '.$idPlayer)->fetchColumn();
  }

  public function delete(Personnage $perso)
  {
    $this->dbConnect()->exec('DELETE FROM personnages WHERE id = '.$perso->id());
  }

  public function exists($info)
  {
      if (is_int($info))
      {
        return (bool) $this->dbConnect()->query('SELECT COUNT(*) FROM personnages WHERE id ='.$info)->fetchColumn();
      }
      else
      {
        $req = $this->dbConnect()->prepare('SELECT COUNT(*) FROM personnages WHERE nom = :nom');
        $req->execute([':nom' => $info]);

        return (bool) $req->fetchColumn();
        $req->closeCursor();
      }
  }

  public function get($info)
  {
    if (is_int($info))
    {
      $req = $this->dbConnect()->query('SELECT * FROM personnages WHERE id = '.$info);
      $donnees = $req->fetch(PDO::FETCH_ASSOC);

      return new Personnage($donnees);
      $req->closeCursor();
    }
    else
    {
      $req = $this->dbConnect()->prepare('SELECT * FROM personnages WHERE nom = :nom');
      $req->execute([':nom' => $info]);

      return new Personnage($req->fetch(PDO::FETCH_ASSOC));
      $req->closeCursor();
    }
  }

  public function getList($nom)
  {
    $persos = [];

    $req = $this->dbConnect()->prepare('SELECT id, nom, degats, vieMax, defensePerso FROM personnages WHERE nom <> :nom ORDER BY nom');
    $req->execute([':nom'=> $nom]);

    while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
      {
        $persos[] = new Personnage($donnees);
      }

      return $persos;
      $req->closeCursor();
  }

  public function update(Personnage $perso)
  {
    $req = $this->dbConnect()->prepare('UPDATE personnages SET fatigue = :fatigue, degats = :degats WHERE id = :id');

    $req->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
    $req->bindValue(':id', $perso->id(), PDO::PARAM_INT);
    $req->bindValue(':fatigue', $perso->fatigue(), PDO::PARAM_INT);


    $req->execute();

    $req->closeCursor();
  }

  public function getListCompte($id)
  {
    $persos = [];

    $req = $this->dbConnect()->prepare('SELECT * FROM personnages WHERE idPlayer = :idPlayer ORDER BY id');
    $req->execute([':idPlayer'=> $id]);

    while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
      {
        $persos[] = new Personnage($donnees);
      }

      return $persos;
      $req->closeCursor();
  }

}
