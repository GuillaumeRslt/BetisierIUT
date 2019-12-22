<h1>Ajouter une citation</h1>
<?php $db = new Mypdo();

$managerSal = new SalarieManager($db);
$managerCitation = new CitationManager($db);
?>

<?php if ( empty($_POST["enseignant"]) && empty($_POST["Date"]) &&
empty($_POST["citation"]) ) { //Si première fois qu'on rentre sur la page?>

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

		<label> Date citation : </label>
		<input type="date" size = 30 name="date" required><br /><br />
    <label> Citation : </label><br />
		<textarea rows="3" name="citation" required></textarea><br /><br />

		<input type=submit value="Valider">
	</form>

<?php } else {
//On modifie la ctation si elle contient des mots interdit
	$citation = explode(" ", $_POST["citation"]);

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
// Si c'est la citation a changée on demande confirmation sinon on la valide diretement
  if ($citationCorrigee != $_POST["citation"].' ' ) {?>

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
		<input type="date" size = 30 name="date" value="<?php echo $_POST["date"]; ?>"><br /><br />
		<label> Citation : </label><br />
		<textarea rows="3" cols="30" name="citation" ><?php echo $citationCorrigee; ?></textarea><br /><br />

		<p>
<?php
		$iterateur = 0;
// On affiche les mots qui ont été supprimé
			 while (!empty($citation[$iterateur]))  {

				 $mot = $citation[$iterateur];

				 if ( $managerCitation->isInterdit($mot) ) {
					echo '<img class = "icone" src="image/erreur.png" alt="ajCitation"/> Le mot : <label style="color : red;">'.$mot.'</label> n\'est pas autorisé<br />';
				 }

				 $iterateur++;
			 }
			 ?>

		 </p>
		<input type=submit value="Valider">
	</form>

<?php } else { //On ajoute la citation et on confirme l'ajout à l'utilisateur ?>

<?php $managerCitation->ajoutCitation($_POST["enseignant"], $_SESSION["num"], $_POST["citation"], $_POST["date"]); ?>

<p><img class = "icone" src="image/valid.png" alt="ajCitation"/> La citation a été ajouté !</p>

<meta http-equiv="refresh" content="2; URL=index.php?page=0">
	<p> Redirection automatique dans 2 secondes. </p>

<?php  }
}?>
