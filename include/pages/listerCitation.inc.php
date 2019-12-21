	<h1>Liste des citations déposées</h1>
	<?php $db = new Mypdo();

		$manager = new CitationManager($db);
		$managerPer = new PersonneManager($db);
		?>
		<p>Actuellement <?php echo $manager->getNbCitation(); ?> citations sont enregistrées</p>
		<table>
		  <tr>
		    <th>Nom de l'enseignement</th>
		    <th>Libellé</th>
				<th>Date</th>
				<th>Moyenne des notes</th>
				<?php if ( isset($_SESSION["num"]) && !$managerPer->isSalarie($_SESSION["num"]) ) {
						echo '<th>Noter</th>';
				} ?>
		  </tr>

		<?php

		$listeCitation = $manager->getList();
		for ($iterateur = 0; $iterateur < 3; $iterateur++) {
			?>
			<tr>
			<td><?php echo $listeCitation[$iterateur]->getPerNom(); ?></td>
			<td><?php echo $listeCitation[$iterateur]->getLibelle(); ?></td>
			<td><?php echo getFrenchDate($listeCitation[$iterateur]->getDate()); ?></td>
			<td><?php echo $listeCitation[$iterateur]->getMoyNote(); ?></td>
			<td><?php if ( isset($_SESSION["num"]) && !$managerPer->isSalarie($_SESSION["num"]) ) {
				echo '<td>';
				if ( $manager->isNote($_SESSION["num"], $listeCitation[$iterateur]->getNum()) ) {
					echo '<img class = "icone" src="image/erreur.png" alt="NoteCitation "/>';
				} else {
  			echo '<a href="index.php?page=17&cit_num='.$listeCitation[$iterateur]->getNum().'
				&cit_nom='.$listeCitation[$iterateur]->getPerNom().'&cit_lib='.$listeCitation[$iterateur]->getLibelle().'
				&cit_date='.getFrenchDate($listeCitation[$iterateur]->getDate()).'&cit_moy='.$listeCitation[$iterateur]->getMoyNote().'" >
				<img class = "icone" src="image/modifier.png" alt="NoteCitation"/></a>';
				}
			echo '</td>';
		}?>
	</tr>
		<?php
		}
		?>

	</table>
