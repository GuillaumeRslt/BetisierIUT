<h1>Ajouter une ville</h1>

<?php $db = new Mypdo();

	$manager = new VilleManager($db);
	?>

<?php if ( empty($_POST["nom"]) ) { ?>

<form name="ajVille" id="ajVille" action="#" method="post" >

  Nom : <input size = 30 maxlength = 50 name="nom"><br /><br />

  <input type=submit value="Valider">
</form>

<?php } else { ?>

  <?php $manager->ajoutVille($_POST["nom"]); ?>

  <p><img class = "icone" src="image/valid.png" alt="ajVille"/> La ville "<?php echo $_POST["nom"]; ?>" a été ajoutée</p>

	<meta http-equiv="refresh" content="2; URL=index.php?page=0">
	  <p> Redirection automatique dans 2 secondes. </p>

 <?php } ?>
