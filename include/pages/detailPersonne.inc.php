<?php $db = new Mypdo();

  $managerPer = new PersonneManager($db);
  $managerSal = new SalarieManager($db);
  $managerEtu = new EtudiantManager($db);
  ?>

  <?php if ( $managerPer->isSalarie($_GET["per_num"]) == true ) {
    // Si la personne est un salarié?>

    <h1> Détail sur le salarie <?php echo $_GET["per_nom"]; ?> </h1>

    <table>
      <tr>
        <th>Prénom</th>
        <th>Mail</th>
        <th>Tel</th>
        <th>Tel pro</th>
        <th>Fonction</th>
      </tr>

    <?php

    $salarie = $managerSal->getSalarie($_GET["per_num"]);
      ?>
      <tr>
      <td> <?php echo $salarie->getPrenom(); ?></td>
      <td><?php echo $salarie->getMail(); ?></td>
      <td><?php echo $salarie->getTel(); ?></td>
      <td><?php echo $salarie->getTelPro(); ?></td>
      <td><?php echo $salarie->getFonction(); ?></td>
    </tr>

    </table>


<?php  } else { //Si la personne est un étudiant?>

    <h1> Détail sur l'étudiant <?php echo $_GET["per_nom"]; ?> </h1>


    <table>
      <tr>
        <th>Prénom</th>
        <th>Mail</th>
        <th>Tel</th>
        <th>Département</th>
        <th>Ville</th>
      </tr>

    <?php

    $etudiant = $managerEtu->getEtudiant($_GET["per_num"]);
      ?>
      <tr>
      <td><?php echo $etudiant->getPrenom(); ?></td>
      <td> <?php echo $etudiant->getMail(); ?></td>
      <td><?php echo $etudiant->getTel(); ?></td>
      <td> <?php echo $etudiant->getDepartement(); ?></td>
      <td><?php echo $etudiant->getVille(); ?></td>
    </tr>

    </table>

<?php  }?>
