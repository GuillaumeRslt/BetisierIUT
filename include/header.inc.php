<?php session_start(); ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <?php
		$title = "Bienvenue sur le site du bétisier de l'IUT.";?>
		<title>
		<?php echo $title ?>
		</title>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />

</head>
	<body>
	<div id="header">
		<div id="connect">

      <?php if (!isset($_SESSION["login"]) ) { ?>

        <a href="index.php?page=15">Connexion</a>

      <?php } else { ?>

        Utilisateur : <?php echo $_SESSION["login"]; ?>
          <a href="index.php?page=16">Deconnexion</a>

      <?php } ?>

		</div>
		<div id="entete">
			<div id="logo">
        <?php if (isset($_SESSION["num"])) { ?>
            <img class = "image" src="image/smile.jpg" alt="smile" width="200"/>
      <?php  } else { ?>
            <img src="image/lebetisier.gif" alt="lebetisier" width="150"/>
      <?php  }?>
			</div>
			<div id="titre">
				Le bétisier de l'IUT,<br />Partagez les meilleures perles !!!
			</div>
		</div>
	</div>
