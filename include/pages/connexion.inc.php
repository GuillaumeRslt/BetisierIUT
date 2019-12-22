<h1> Pour vous connecter </h1>

<?php $db = new Mypdo();

  $manager = new ConnexionManager($db);
  $managerPer = new PersonneManager($db);
  ?>

<?php if (empty($_POST["nom"]) && empty($_POST["mdp"]) ) {
  //Première fois qu'on rentre sur la page ?>

<form name="connexion" id="connexion" action="#" method="post" >
  Nom d'utilisateur : <input size = 30 maxlength = 50 name="nom"><br /><br />
  Mot de passe : <input type="password" size = 30 maxlength = 50 name="mdp"><br /><br />
  <?php

  $img1 = random_int(1,9);
  $img2 = random_int(1,9);
  $_SESSION["img1"] = $img1;
  $_SESSION["img2"] = $img2;
  echo '<img class = "icone" src="image/nb/'.$img1.'.jpg" alt="numero1" name="1" /> +
  <img class = "icone" src="image/nb/'.$img2.'.jpg" alt="numero2" name="2"/>
  <input size = 30 maxlength = 50 name="verifCode"><br /><br />';
 ?>
  <input type=submit value="Valider">
</form>

<?php } else {
if ( ($manager->isGoodLog($_POST["nom"], $_POST["mdp"])) && ($_SESSION["img1"] + $_SESSION["img2"] == $_POST["verifCode"]) ) {
  //Si les données renseignées sont correctes?>

<p><img class = "icone" src="image/valid.png" alt="connexion"/> Vous avez bien été connecté !</p>

  <?php $_SESSION["login"]=$_POST["nom"];
  $_SESSION["num"]=$managerPer->getNumPer($_POST["nom"], $_POST["mdp"]);?>

<meta http-equiv="refresh" content="2; URL=index.php?page=0">
  <p> Redirection automatique dans 2 secondes. </p>

<?php }
    else { //Connexion mauvaise ?>

      <h3><img class = "icone" src="image/erreur.png" alt="connexion"/> Données d'authentification non valide ... </h3>

            <form name="connexion" id="connexion" action="#" method="post" >
              Nom d'utilisateur : <input size = 30 maxlength = 50 name="nom" value="<?php echo $_POST["nom"]; ?>"><br /><br />
              Mot de passe : <input type="password" size = 30 maxlength = 50 name="mdp"><br /><br />
              <?php
              $img1 = random_int(1,9);
              $img2 = random_int(1,9);
              $_SESSION["img1"] = $img1;
              $_SESSION["img2"] = $img2;
              echo '<img class = "icone" src="image/nb/'.$img1.'.jpg" alt="numero1" name="1" /> +
              <img class = "icone" src="image/nb/'.$img2.'.jpg" alt="numero2" name="2"/>
              <input size = 30 maxlength = 50 name="verifCode"><br /><br />';
             ?>

              <input type=submit value="Valider">
            </form>

<?php }
  }?>
