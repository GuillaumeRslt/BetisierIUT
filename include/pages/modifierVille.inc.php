<h1>Modifier une ville</h1>
<?php $db = new Mypdo();

	$manager = new VilleManager($db);
	?>

  <?php if ( empty($_GET["cit_num"]) ) {?>
	<p>Actuellement <?php echo $manager->getNbVille(); ?> villes sont enregistrées</p>
	<table>
	  <tr>
	    <th>Numéro</th>
	    <th>Nom</th>
      <th>Modifier</th>
	  </tr>

	<?php

	$listeVille = $manager->getList();
	foreach ($listeVille as $ville) {
		?>
		<tr>
		<td><?php echo $ville->getNum(); ?></td>
		<td><?php echo $ville->getNom(); ?></td>
    <td><?php echo '<a href="index.php?page=12&cit_num='.$ville->getNum().'&cit_nom='.$ville->getNom().'" >
      <img class = "icone" src="image/modifier.png" alt="ModifierVille"/></a>'; ?></td>
	</tr>
	<?php
	}
	?>

	</table>

<?php } else {

  if (empty($_POST["nom"]) ) { ?>

    <form name="modifVille" id="modifVille" action="#" method="post" >

      Nom : <input size = 30 maxlength = 50 name="nom" value="<?php echo $_GET["cit_nom"]?>" required focus><br /><br />

      <input type=submit value="Valider">
    </form>

<?php  } else {
	
    $manager->modifierVille($_GET["cit_num"], $_POST["nom"]); ?>

	  <p><img class = "icone" src="image/valid.png" alt="modifierVille"/>La ville a bien été modifiée</p>

	  <a href="index.php?page=12" > Retour aux Villes </a>
<?php }
} ?>
