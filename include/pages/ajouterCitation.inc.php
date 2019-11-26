<h1>Ajouter une citation</h1>
<?php $db = new Mypdo();

$managerSal = new SalarieManager($db);
$managerCitation = new CitationManager($db);
?>

<?php if ( empty($_POST["enseignant"]) && empty($_POST["Date"]) &&
empty($_POST["citation"]) ) { ?>

	<form name="ajCitation" id="ajCitation" action="#" method="post" >

    <label>Enseignant : </label>
    <select class="champ" id="enseignant" name="enseignant" >
      <?php
      $listeEnseignant = $managerSal->getEnseignant();
      foreach ($listeEnseignant as $enseignant) { ?>
        <option value="<?php echo $enseignant->getNum(); ?>">
          <?php echo $enseignant->getNom(); ?></option>
          <?php echo "\n" ;
        }
        ?>
      </select>	<br /><br />

		Date Citation : <input type="date" size = 30 maxlength = 50 name="date"><br /><br />
    Citation : <input rows="3" cols="30" name="citation"><br /><br />

		<input type=submit value="Valider">
	</form>

<?php } else {
  if (empty($_POST["date"]) || empty($_POST["citation"]) ) {?>

	<h3><img class = "icone" src="image/erreur.png" alt="ajCitation"/> Certains champs ne sont pas remplis...</h3>

  <form name="ajCitation" id="ajCitation" action="#" method="post" >

    <label>Enseignant : </label>
    <select class="champ" id="enseignant" name="enseignant" >
      <?php
      $listeEnseignant = $managerSal->getEnseignant();
      foreach ($listeEnseignant as $enseignant) { ?>
        <option value="<?php echo $enseignant->getNum(); ?>">
          <?php echo $enseignant->getNom(); ?></option>
          <?php echo "\n" ;
        }
        ?>
      </select>	<br /><br />

		Date Citation : <input type="date" size = 30 maxlength = 50 name="date" value="<?php echo $_POST["date"]; ?>"><br /><br />
		Citation : <input rows="3" cols="30" name="citation" value="<?php echo $_POST["citation"]; ?>"><br /><br />

		<input type=submit value="Valider">
	</form>



<?php } else { ?>

<?php $managerCitation->ajoutCitation($_POST["enseignant"], $_SESSION["num"], $_POST["citation"], $_POST["date"]); ?>

<p><img class = "icone" src="image/valid.png" alt="ajCitation"/> La citation a été ajouté !</p>

  <a href="index.php?page=0" > Retour à l'accueil </a>

<?php  }
}?>
