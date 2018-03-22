<?php

class Personnage
{

	const CEST_MOI = 1;

	const PERSONNAGE_TUE = 2;

	const PERSONNAGE_FRAPPE = 3;

	const ATTAQUE_BLOQUE = 4;

	const TROP_FATIGUE = 5;

	private $_id;

	private $_idPlayer;

	private $_nom;

	private $_degats;

	private $_vieMax;

	private $_vie;

	private $_forcePerso;

	private $_degatMin = 1;

	private $_degatMax = 2;

	private $_defensePerso;

	private $_endurenceMax;

	private $_endurence;

	private $_fatigue;

	private $_chanceCritique = 0;

	private $_multiplicateurCritique = 2;


	public function __construct(array $donnees)
	{
		$this->hydrate($donnees);
	}

	public function  hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value)
		{
			$method = 'set'.ucfirst($key);

			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}

	//GETTERS

	public function id()
	{
		return $this->_id;
	}

	public function idPlayer()
	{
		return $this->_idPlayer;
	}

	public function nom()
	{
		return $this->_nom;
	}

	public function degats()
	{
		return $this->_degats;
	}

	public function vieMax()
	{
		return $this->_vieMax;
	}

	public function vie()
	{
		return $this->_vie = $this->_vieMax - $this->_degats;
	}

	public function forcePerso()
	{
		return $this->_forcePerso;
	}

	public function degatMin()
	{
		return $this->_degatMin;
	}

	public function degatMax()
	{
		return $this->_degatMax;
	}

	public function defensePerso()
	{
		return $this->_defensePerso;
	}

	public function endurenceMax()
	{
		return $this->_endurenceMax;
	}

	public function fatigue()
	{
		return $this->_fatigue;
	}

	public function endurence()
	{
		return $this->_endurence = $this->_endurenceMax - $this->_fatigue;
	}

	public function chanceCritique()
	{
		return $this->_chanceCritique;
	}

	public function multiplicateurCritique()
	{
		return $this->_multiplicateurCritique;
	}


	//SETTERS

	public function setId($id)
	{
		$id = (int) $id;

		if ($id>0)
		{
			$this->_id = $id;
		}
	}

	public function setIdPlayer($idPlayer)
	{
		$idPlayer = (int) $idPlayer;

		if ($idPlayer>0)
		{
			$this->_idPlayer = $idPlayer;
		}
	}
	public function setNom($nom)
	{
		if (is_string($nom))
		{
			$this->_nom = $nom;
		}
	}

	public function setDegats($degats)
	{
		$degats = (int) $degats;

		if ($degats >= 0)
		{
			$this->_degats = $degats;
		}
	}

	public function setVieMax($vieMax)
	{
		$vieMax = (int) $vieMax;

		if ($vieMax >= 0)
		{
			$this->_vieMax = $vieMax;
		}
	}

	public function setForcePerso($forcePerso)
	{
		$forcePerso = (int) $forcePerso;
			if ($forcePerso >= 0)
			{
				$this->_forcePerso = $forcePerso;
			}
	}

	public function setDefensePerso($defensePerso)
	{
		$defensePerso = (int) $defensePerso;
		if ($defensePerso >= 0)
		{
			$this->_defensePerso = $defensePerso;
		}
	}

	public function setDegatMin($degatMin)
	{
		$degatMin = (int) $degatMin;
		if ($degatMin >= 0)
		{
			$this->_degatMin = $degatMin;
		}
	}

	public function setDegatMax($degatMax)
	{
		$degatMax = (int) $degatMax;
		if ($degatMax >= 0)
		{
			$this->_degatMax = $degatMax;
		}
	}

	public function setEndurenceMax($endurenceMax)
	{
		$endurenceMax = (int) $endurenceMax;
		if ($endurenceMax >= 0)
		{
			$this->_endurenceMax = $endurenceMax;
		}
	}

	public function setFatigue($fatigue)
	{
		$fatigue = (int) $fatigue;
		if ($fatigue >= 0)
		{
			$this->_fatigue = $fatigue;
		}
	}

	public function setChanceCritique($chanceCritique)
	{
		$chanceCritique = (int) $chanceCritique;
		if ($chanceCritique >=0)
		{
			$this->_chanceCritique = $chanceCritique;
		}
	}

	public function setMultiplicateurCritique($multiplicateurCritique)
	{
		$multiplicateurCritique = (int) $multiplicateurCritique;
		if ($multiplicateurCritique >=0)
		{
			$this->_multiplicateurCritique = $multiplicateurCritique;
		}
	}


	//Méthode de personnage


  public function frapper(Personnage $perso)
  {
    if ($perso->id() == $this->_id) {
      return array (self::CEST_MOI);
    } elseif ($this->endurence() >= 10) {
    	$this->_fatigue += 10;
 	   return $this->calculDegats($perso);
 		} else {
 			return array(self::TROP_FATIGUE);
 		}
  }


  public function calculDegats($perso)
  {
    $arg = mt_rand(
        $this->forcePerso()*$this->degatMin(),
        $this->forcePerso()*$this->degatMax());
				
				$chanceSuperArg = mt_rand(0,100);

    if ($chanceSuperArg > (100-$this->chanceCritique())) {

      $superArg = $arg *$this->multiplicateurCritique();

      return $perso->reductionDegats($superArg);

    } else {
      return $this->reductionDegats($arg,$perso);
    }
  }

  public function reductionDegats($arg, $perso)
  {
    $finalArg = $arg - $perso->defensePerso()*2;

    $perso->_degats += $finalArg;

    if ($perso->vie() <= 0) {
    	return array (self::PERSONNAGE_TUE);
    } else {
    	return array (self::PERSONNAGE_FRAPPE, $finalArg);
		}
  }




}
