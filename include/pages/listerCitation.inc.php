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
				<?php if ( !$managerPer->isSalarie($_SESSION["num"]) ) {
						echo '<th>Noter</th>';
				} ?>
		  </tr>

		<?php
	
		$listeCitation = $manager->getList();
		foreach ($listeCitation as $citation) {
			?>
			<tr>
			<td><?php echo $citation->getPerNom(); ?></td>
			<td><?php echo $citation->getLibelle(); ?></td>
			<td><?php echo getFrenchDate($citation->getDate()); ?></td>
			<td><?php echo $citation->getMoyNote(); ?></td>
			<td><?php if ($managerPer->isSalarie($_SESSION["num"]) ) {
				echo '<img class = "icone" src="image/erreur.png" alt="NoteCitation "/>';
			}
			else {
				if ( $manager->isNote($_SESSION["num"], $citation->getNum()) ) {
					echo '<img class = "icone" src="image/erreur.png" alt="NoteCitation "/>';
				} else {
  			echo '<a href="index.php?page=17&cit_num='.$citation->getNum().'
				&cit_nom='.$citation->getPerNom().'&cit_lib='.$citation->getLibelle().'
				&cit_date='.getFrenchDate($citation->getDate()).'&cit_moy='.$citation->getMoyNote().'" >
				<img class = "icone" src="image/modifier.png" alt="NoteCitation"/></a>';
			}
		}?></td>
	</tr>
		<?php
		}
		?>

	</table>
