<?php $db = new Mypdo();
  $managerEtu = new EtudiantManager($db);
  ?>

<h1>Modifier un salarié</h1>

<?php $managerEtu->modifEtudiant($_SESSION["modif"], $_POST["dep"], $_POST["div"] ); ?>

<p><img class = "icone" src="image/valid.png" alt="modifSalarie"/> L'étudiant a été modifier !</p>

<a href="index.php?page=0" > Retour à l'accueil </a>
