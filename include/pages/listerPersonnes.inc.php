	<h1>Liste des personnes enregistrées</h1>
	<?php $db = new Mypdo();

		$manager = new PersonneManager($db);
		?>
		<p>Actuellement <?php echo $manager->getNbPersonne(); ?> personnes sont enregistrées</p>

		<table>
		  <tr>
		    <th>Numéro</th>
		    <th>Nom</th>
				<th>Prenom</th>
		  </tr>

		<?php

		$listePersonne = $manager->getList();
		foreach ($listePersonne as $personne) {
			?>
			<tr>
			<td> <a href="index.php?page=14
														&per_num=<?php echo $personne->getNum(); ?>
														&per_nom=<?php echo $personne->getNom(); ?> ">
														<?php echo $personne->getNum(); ?> </a>
													</td>
			<td><?php echo $personne->getNom(); ?></td>
			<td><?php echo $personne->getPrenom(); ?></td>
		</tr>
		<?php
		}
		?>

		</table>
