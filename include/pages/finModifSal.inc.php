<?php $db = new Mypdo();
  $managerSal = new SalarieManager($db);
  ?>

<h1>Modifier un salarié</h1>

<?php $managerSal->modifSalarie($_SESSION["modif"], $_POST["telPro"], $_POST["fonction"] ); ?>

<p><img class = "icone" src="image/valid.png" alt="modifSalarie"/> Le salarié a été modifier !</p>

<a href="index.php?page=0" > Retour à l'accueil </a>
