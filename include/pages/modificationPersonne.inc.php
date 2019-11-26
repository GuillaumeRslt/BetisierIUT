	<h1>Modifier une personne</h1>

  <?php $db = new Mypdo();

    $manager = new PersonneManager($db);
    ?>

    <?php $listePersonne = $manager->getList();
    $iterateur = 0;

  //  print_r($listePersonne);
  while ($listePersonne[$iterateur]->getNum() != $_GET["per_num"] ) {
    $iterateur = $iterateur + 1;
  }

  $personne = $listePersonne[$iterateur];

  print_r($personne);

  if ( $manager->isSalarie($_GET["per_num"]) ) {?>
    <?php echo "alors 1 ?"; ?>
  <form name="modifPersonne" id="ModifPersonne" action="#" method="post" >

    Nom : <input size = 30 maxlength = 50 name="nom" value="<?php echo $personne->getNom(); ?>"><br /><br />
    Prénom : <input size = 30 maxlength = 50 name="prenom" value="<?php echo $personne->getPrenom(); ?>"><br /><br />
    Téléphone : <input size = 30 maxlength = 50 name="tel" value="<?php echo $personne->getTel(); ?>"><br /><br />
    Mail : <input size = 30 maxlength = 50 name="mail" value="<?php echo $personne->getMail(); ?>"><br /><br />
    Login : <input size = 30 maxlength = 50 name="login" value="<?php echo $personne->getLogin(); ?>"><br /><br />
    Mot de passe : <input type="password" size = 30 maxlength = 50 name="mdp" vlaue="<?php echo $personne->getNom(); ?>"><br /><br />
    Catégorie : <input type="radio" name="catégorie" value="Etudiant" checked> Etudiant
    <input type="radio" name="catégorie" value="salarie"> Personnel<br /><br />
    <input type=submit value="Suivant">
  </form>

<?php} else {?>
<?php echo "alors  ?"; ?>
  <form name="modifPersonne" id="ModifPersonne" action="#" method="post" >

    Nom : <input size = 30 maxlength = 50 name="nom" value=""><br /><br />
    Prénom : <input size = 30 maxlength = 50 name="prenom"><br /><br />
    Téléphone : <input size = 30 maxlength = 50 name="tel"><br /><br />
    Mail : <input size = 30 maxlength = 50 name="mail"><br /><br />
    Login : <input size = 30 maxlength = 50 name="login"><br /><br />
    Mot de passe : <input type="password" size = 30 maxlength = 50 name="mdp"><br /><br />
    Catégorie : <input type="radio" name="catégorie" value="Etudiant" checked> Etudiant
    <input type="radio" name="catégorie" value="salarie"> Personnel<br /><br />
    <input type=submit value="Suivant">
  </form>

<?php } ?>
