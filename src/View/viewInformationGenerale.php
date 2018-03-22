<!DOCTYPE html>
<html>
  <head>
    <title>TP : Le super jeux de combats</title>

    <meta charset="utf-8" />
    <link style="stylesheet" href="style.css" />
  </head>

<body>
	<a href="?deconnexion=1">Déconnexion</a><br />
	<a href="?page=nouveauPersonnage">Créer un nouveau personnage</a>
	<p>
		<?php echo 'bonjour '. $_SESSION['pseudo'];?>
	</p>

	<p><h2>Liste de vos <?= $managerPerso->count($_SESSION['id'])?> sur 4 max personnages :</h2></p>

	<?php 
	foreach ($persos as $MesPersos) 
	{?>
		<p>
			<table>
				<tr>
					<td colspan="2"><?=$MesPersos->nom()?></td>
				</tr>

				<tr>
					<td><?=$MesPersos->vie(),'/',$MesPersos->vieMax() ?></td> 
					<td>Vie</td>
				</tr>
				<tr>
					<td><?=$MesPersos->endurence(), '/',$MesPersos->endurenceMax()?></td>
					<td>Endurence</td>
				</tr>
				<tr>
					<td><?=$MesPersos->forcePerso()?></td>
					<td>Force</td> 
				</tr>
				<tr>
					<td><?=$MesPersos->defensePerso()?></td>
					<td>Défense</td>
				</tr>
			</table>
		</p>
	<?php
	} ?>