<h1>Ajouter une citation</h1>
<?php $db = new Mypdo();

$managerSal = new SalarieManager($db);
$managerCitation = new CitationManager($db);
?>

<?php if ( empty($_POST["enseignant"]) && empty($_POST["Date"]) &&
empty($_POST["citation"]) ) { ?>

	<form name="ajCitation" id="ajCitation" action="#" method="post" >

    <label>Enseignant : </label>
    <select class="champ" id="enseignant" name="enseignant" required>
      <?php
      $listeEnseignant = $managerSal->getEnseignant();
      foreach ($listeEnseignant as $enseignant) { ?>
        <option value="<?php echo $enseignant->getNum(); ?>">
          <?php echo $enseignant->getNom(); ?></option>
          <?php echo "\n" ;
        }
        ?>
      </select>	<br /><br />

		<label> Daet citation : </label>
		<input type="date" size = 30 maxlength = 50 name="date" required><br /><br />
    <label> Citation : </label><br />
		<textarea rows="3" size="30" name="citation" required></textarea><br /><br />

		<input type=submit value="Valider">
	</form>

<?php } else {

	$citation = explode(" ", $_POST["citation"]);
	echo $_POST["citation"];

	$citationCorrigee = "";
	 $iterateur = 0;

			while (!empty($citation[$iterateur]))  {

				$mot = $citation[$iterateur];

				if ( !$managerCitation->isInterdit($mot) ) {
					$citationCorrigee = $citationCorrigee.$mot.' ';
				} else {
					$citationCorrigee = $citationCorrigee.'--- ';
				}

				$iterateur++;
			}

  if ($citationCorrigee != $_POST["citation"] ) {?>

  <form name="ajCitation" id="ajCitation" action="#" method="post" >

    <label>Enseignant : </label>
    <select class="champ" id="enseignant" name="enseignant" >
			<?php $salarie = $managerSal->getSalarie($_POST["enseignant"]); ?>
			<option value="<?php echo $_POST["enseignant"] ?>"><?php echo $salarie->getNom(); ?></option>
      <?php
      $listeEnseignant = $managerSal->getEnseignant();
      foreach ($listeEnseignant as $enseignant) { ?>
        <option value="<?php echo $enseignant->getNum(); ?>">
          <?php echo $enseignant->getNom(); ?></option>
          <?php echo "\n" ;
        }
        ?>
      </select>	<br /><br />

		<label> Date Citation : </label>
		<input type="date" size = 30 maxlength = 50 name="date" value="<?php echo $_POST["date"]; ?>"><br /><br />
		<label> Citation : </label><br />
		<textarea rows="3" cols="30" name="citation" ><?php echo $citationCorrigee; ?></textarea><br /><br />

		<p>
<?php
		$iterateur = 0;

			 while (!empty($citation[$iterateur]))  {

				 $mot = $citation[$iterateur];

				 if ( $managerCitation->isInterdit($mot) ) {
					echo '<img class = "icone" src="image/erreur.png" alt="ajCitation"/> Le mot : '.$mot.' n\'est pas autorisé<br />';
				 }

				 $iterateur++;
			 }
			 ?>

		 </p>
		<input type=submit value="Valider">
	</form>

<?php } else { ?>

<?php $managerCitation->ajoutCitation($_POST["enseignant"], $_SESSION["num"], $_POST["citation"], $_POST["date"]); ?>

<p><img class = "icone" src="image/valid.png" alt="ajCitation"/> La citation a été ajouté !</p>

  <a href="index.php?page=0" > Retour à l'accueil </a>

<?php  }
}?>
