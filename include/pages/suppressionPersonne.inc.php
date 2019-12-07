<h1>Supprimer des personnes enregistrées</h1>

<?php $db = new Mypdo();

  $manager = new PersonneManager($db);
  $managerEtu = new EtudiantManager($db);
  $managerSal = new SalarieManager($db);
  ?>

<?php if ( $_SESSION["suppression"] == true ) {?>

    <?php $_SESSION["suppression"] = false; ?>

    <p>Etes-vous sûr de vouloir supprimer <?php echo $_GET["per_prenom"]." ".$_GET["per_nom"] ?> ?</p>

    <a href=""><button>Valider</button></a> <a href="index.php?page=4"><button>Retour</button></a>

<?php } else { ?>

<?php if ($manager->isSalarie($_GET["per_num"]) ) {
  $managerSal->suprSalarie($_GET["per_num"]);
} else {
  $managerEtu->suprEtudiant($_GET["per_num"]);
}
$manager->suprPersonne($_GET["per_num"]);
?>

  <p><img class = "icone" src="image/valid.png" alt="suppression"/> <?php echo $_GET["per_prenom"]." ".$_GET["per_nom"] ?> a bien été supprimés</p>

  <meta http-equiv="refresh" content="3; URL=index.php?page=0">
    <p> Redirection automatique dans 3 secondes. </p>

<?php } ?>
