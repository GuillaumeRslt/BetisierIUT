<h1>Supprimer une ville enregistrée</h1>
<?php $db = new Mypdo();

	$manager = new VilleManager($db);
	?>

  <?php if ( empty($_GET["cit_num"]) ) {?>
	<p>Actuellement <?php echo $manager->getNbVilleSupprimable(); ?> villes sont enregistrées</p>
	<table>
	  <tr>
	    <th>Numéro</th>
	    <th>Nom</th>
      <th>Supprimer</th>
	  </tr>

	<?php

	$listeVille = $manager->getListSupprimable();
	foreach ($listeVille as $ville) {
		?>
		<tr>
		<td><?php echo $ville->getNum(); ?></td>
		<td><?php echo $ville->getNom(); ?></td>
    <td><?php echo '<a href="index.php?page=13&cit_num='.$ville->getNum().'" >
      <img class = "icone" src="image/erreur.png" alt="SupprimerVille"/></a>'; ?></td>
	</tr>
	<?php
	}
	?>

	</table>

<?php } else {

	 $manager->supprimerVille($_GET["cit_num"]); ?>

	  <p><img class = "icone" src="image/valid.png" alt="supprimerVille"/>La ville a bien été supprimée</p>

	  <a href="index.php?page=13" > Retour aux Villes </a>
<?php } ?>
