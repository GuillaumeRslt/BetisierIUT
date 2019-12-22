<?php $db = new Mypdo();

  $manager = new ConnexionManager($db);
  $managerPer = new PersonneManager($db);
  ?>

<?php if (!isset($_SESSION["login"]) ) {
  //Menu pour une personne non connectée?>

<div id="menu">
	<div id="menuInt">
		<p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Accueil</a></p>
		<p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
		<ul>
			<li><a href="index.php?page=1">Lister</a></li>
		</ul>
		<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
		<ul>
			<li><a href="index.php?page=6">Lister</a></li>
      <li><a href="index.php?page=7">Rechercher</a></li>
		</ul>
		<p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
		<ul>
			<li><a href="index.php?page=10">Lister</a></li>
		</ul>
	</div>
</div>

<?php } else {
		if ($manager->isAdmin($_SESSION["login"])) {
      //Menu pour une personne admin?>

	<div id="menu">
		<div id="menuInt">
			<p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Accueil</a></p>
			<p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
			<ul>
				<li><a href="index.php?page=1">Lister</a></li>
				<li><a href="index.php?page=2">Ajouter</a></li>
				<li><a href="index.php?page=3">Modifier</a></li>
				<li><a href="index.php?page=4">Supprimer</a></li>
			</ul>
			<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
			<ul>
      <?php if ( !$managerPer->isSalarie($_SESSION["num"]) ) {
        //Si on est salarié on ne peut pas ajouter de citation ?>
				<li><a href="index.php?page=5">Ajouter</a></li>
      <?php } ?>
				<li><a href="index.php?page=6">Lister</a></li>
				<li><a href="index.php?page=7">Rechercher</a></li>
				<li><a href="index.php?page=8">Valider</a></li>
				<li><a href="index.php?page=9">Supprimer</a></li>
			</ul>
			<p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
			<ul>
				<li><a href="index.php?page=10">Lister</a></li>
				<li><a href="index.php?page=11">Ajouter</a></li>
				<li><a href="index.php?page=12">Modifier</a></li>
				<li><a href="index.php?page=13">Supprimer</a></li>
			</ul>
		</div>
	</div>

<?php } else if ( $managerPer->isSalarie($_SESSION["num"]) ) {
  //Menu pour un salarié?>

	<div id="menu">
		<div id="menuInt">
			<p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Accueil</a></p>
			<p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
			<ul>
				<li><a href="index.php?page=1">Lister</a></li>
				<li><a href="index.php?page=2">Ajouter</a></li>
			</ul>
			<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
			<ul>
				<li><a href="index.php?page=6">Lister</a></li>
				<li><a href="index.php?page=7">Rechercher</a></li>
			</ul>
			<p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
			<ul>
				<li><a href="index.php?page=10">Lister</a></li>
				<li><a href="index.php?page=11">Ajouter</a></li>
				<li><a href="index.php?page=12">Modifier</a></li>
			</ul>
		</div>
	</div>

<?php } else {
  //Menu pour un étudiant?>

  <div id="menu">
    <div id="menuInt">
      <p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Accueil</a></p>
      <p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
      <ul>
        <li><a href="index.php?page=1">Lister</a></li>
        <li><a href="index.php?page=2">Ajouter</a></li>
      </ul>
      <p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
      <ul>
        <li><a href="index.php?page=5">Ajouter</a></li>
        <li><a href="index.php?page=6">Lister</a></li>
        <li><a href="index.php?page=7">Rechercher</a></li>
      </ul>
      <p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
      <ul>
        <li><a href="index.php?page=10">Lister</a></li>
        <li><a href="index.php?page=11">Ajouter</a></li>
        <li><a href="index.php?page=12">Modifier</a></li>
      </ul>
    </div>
  </div>

<?php }
}
?>
