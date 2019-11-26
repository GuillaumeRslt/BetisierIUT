	<h1>Liste des villes</h1>
<?php $db = new Mypdo();

	$manager = new VilleManager($db);
	?>
	<p>Actuellement <?php echo $manager->getNbVille(); ?> villes sont enregistrées</p>
	<table>
	  <tr>
	    <th>Numéro</th>
	    <th>Nom</th>
	  </tr>

	<?php
/**/
	$listeVille = $manager->getList();
	foreach ($listeVille as $ville) {
		?>
		<tr>
		<td><?php echo $ville->getNum(); ?></td>
		<td><?php echo $ville->getNom(); ?></td>
	</tr>
	<?php
	}
	?>

	</table>
