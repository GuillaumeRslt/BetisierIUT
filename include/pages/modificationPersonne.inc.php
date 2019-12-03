  <?php $db = new Mypdo();

    $manager = new PersonneManager($db);
		$managerSal = new SalarieManager($db);
		$managerFon = new FonctionManager($db);
		$managerDiv = new DivisionManager($db);
		$managerDep = new DepartementManager($db);

    ?>

    <?php $listePersonne = $manager->getList();
    $iterateur = 0;

  //  print_r($listePersonne);
  while ($listePersonne[$iterateur]->getNum() != $_GET["per_num"] ) {
    $iterateur = $iterateur + 1;
  }

  $personne = $listePersonne[$iterateur]; ?>

<?php if ( !isset($_POST["nom"]) ) {?>

<?php if ($manager->isSalarie($_GET["per_num"])) {?>
		<h1>Modifier une personne</h1>

	<form name="ajPersonne" id="ajPersonne" action="#" method="post" >

		Nom : <input size = 30 maxlength = 50 name="nom" value="<?php echo $personne->getNom(); ?>"><br /><br />
		Prénom : <input size = 30 maxlength = 50 name="prenom" value="<?php echo $personne->getPrenom(); ?>"><br /><br />
		Téléphone : <input size = 30 maxlength = 50 name="tel" value="<?php echo $personne->getTel(); ?>"><br /><br />
		Mail : <input size = 30 maxlength = 50 name="mail" value="<?php echo $personne->getMail(); ?>"><br /><br />
		Login : <input size = 30 maxlength = 50 name="login" value="<?php echo $personne->getLogin(); ?>"><br /><br />
		Mot de passe : <input type="password" size = 30 maxlength = 50 name="mdp" ><br /><br />
		Catégorie : <input type="radio" name="catégorie" value="Etudiant"> Etudiant
		<input type="radio" name="catégorie" value="salarie" checked> Personnel<br /><br />
		<input type=submit value="Suivant">
	</form>

<?php } else { ?>
		<h1>Modifier une personne</h1>

	<form name="ajPersonne" id="ajPersonne" action="#" method="post" >

		Nom : <input size = 30 maxlength = 50 name="nom" value="<?php echo $personne->getNom(); ?>"><br /><br />
		Prénom : <input size = 30 maxlength = 50 name="prenom" value="<?php echo $personne->getPrenom(); ?>"><br /><br />
		Téléphone : <input size = 30 maxlength = 50 name="tel" value="<?php echo $personne->getTel(); ?>"><br /><br />
		Mail : <input size = 30 maxlength = 50 name="mail" value="<?php echo $personne->getMail(); ?>"><br /><br />
		Login : <input size = 30 maxlength = 50 name="login" value="<?php echo $personne->getLogin(); ?>"><br /><br />
		Mot de passe : <input type="password" size = 30 maxlength = 50 name="mdp"><br /><br />
		Catégorie : <input type="radio" name="catégorie" value="Etudiant" checked> Etudiant
		<input type="radio" name="catégorie" value="salarie"> Personnel<br /><br />
		<input type=submit value="Suivant">
	</form>

<?php }

} else {
		if ( empty($_POST["nom"]) || empty($_POST["prenom"]) ||
		empty($_POST["tel"]) || empty($_POST["mail"]) || empty($_POST["login"]) ||
		empty($_POST["mdp"]) ) {?>

				<h1>Modifier une personne</h1>

			<h3><img class = "icone" src="image/erreur.png" alt="ModifPersonne"/> Certains champs ne sont pas remplis...</h3>

			<form name="ModifPersonne" id="ModifPersonne" action="#" method="post" >

				Nom : <input size = 30 maxlength = 50 name="nom" value="<?php echo $personne->getNom(); ?>"><br /><br />
				Prénom : <input size = 30 maxlength = 50 name="prenom" value="<?php echo $personne->getPrenom(); ?>"><br /><br />
				Téléphone : <input size = 30 maxlength = 50 name="tel" value="<?php echo $personne->getTel(); ?>"><br /><br />
				Mail : <input size = 30 maxlength = 50 name="mail" value="<?php echo $personne->getMail(); ?>"><br /><br />
				Login : <input size = 30 maxlength = 50 name="login" value="<?php echo $personne->getLogin(); ?>"><br /><br />
				Mot de passe : <input type="password" size = 30 maxlength = 50 name="mdp" ><br /><br />
				<?php if ($_POST["catégorie"] == "salarie") {?>
				Catégorie : <input type="radio" name="catégorie" value="Etudiant"> Etudiant
				<input type="radio" name="catégorie" value="salarie" checked> Personnel<br /><br />
				<?php } else { ?>
				Catégorie : <input type="radio" name="catégorie" value="Etudiant" checked> Etudiant
				<input type="radio" name="catégorie" value="salarie"> Personnel<br /><br />
				<?php } ?>
				<input type=submit value="Suivant">
			</form>

		<?php } else { ?>

			<?php
			if ( empty($_POST["telPro"]) ) {
				$manager->modifPersonne($_GET["per_num"], $_POST["nom"], $_POST["prenom"], $_POST["tel"], $_POST["mail"], $_POST["login"], $_POST["mdp"]);
			}
			$_SESSION["modif"]= $_GET["per_num"];

			if ($_POST["catégorie"] == "salarie") {

			include_once("modifierSalarie.inc.php");

			 } else {

				include_once("modifierEtudiant.inc.php");

			 		}

		 }

	} ?>
