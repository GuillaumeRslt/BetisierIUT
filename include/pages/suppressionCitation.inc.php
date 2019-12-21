<h1>Supprimer une citation</h1>

<?php $db = new Mypdo();

  $manager = new CitationManager($db);
  ?>

  <?php $manager->supprimerCit($_GET["cit_num"]); ?>

  <p><img class = "icone" src="image/valid.png" alt="supprimerCitation"/>La citation à bien été supprimée</p>

  <a href="index.php?page=9" > Retour aux citations </a>
