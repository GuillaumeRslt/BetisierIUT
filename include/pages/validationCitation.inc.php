<h1>Valider une citation</h1>

<?php $db = new Mypdo();

  $manager = new CitationManager($db);
  ?>

  <?php $manager->validerCit($_GET["cit_num"], $_SESSION["num"]); ?>

  <p><img class = "icone" src="image/valid.png" alt="validerCitation"/>La citation à bien été validée</p>

  <a href="index.php?page=8" > Retour aux citations </a>
