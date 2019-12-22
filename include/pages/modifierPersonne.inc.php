
	<h1>Modifier une personne enregistrées</h1>

	<?php $db = new Mypdo();

		$manager = new PersonneManager($db);
		?>
		<p>Actuellement <?php echo $manager->getNbPersonne(); ?> personnes sont enregistrées</p>

		<table>
			<tr>
				<th>Nom</th>
				<th>Prenom</th>
				<th>Modifier</th>
			</tr>

		<?php

		$listePersonne = $manager->getList();
		foreach ($listePersonne as $personne) {
			?>
			<tr>
			<td><?php echo $personne->getNom(); ?></td>
			<td><?php echo $personne->getPrenom(); ?></td>
			<td>
				<a href="index.php?page=18&per_num=<?php echo $personne->getNum(); ?>" >
				<img class = "icone" src="image/modifier.png" alt="modifierPersonne"/></a>
		</td>
		</tr>
		<?php
		}
		?>

		</table>
