<h1>Supprimer une citation enregistrée</h1>

<?php $db = new Mypdo();

  $manager = new CitationManager($db);
  $managerCo = new ConnexionManager($db);
  ?>
  <p>Actuellement <?php echo $manager->getNbAllCitation(); ?> citations sont enregistrées</p>
  <table>
    <tr>
      <th>Nom de l'enseignement</th>
      <th>Libellé</th>
      <th>Date</th>
      <th>Moyenne des notes</th>
      <?php if ( $managerCo->isAdmin($_SESSION["login"]) ) {
          echo '<th>Supprimer</sth>';
      } ?>
    </tr>

  <?php

  $listeCitation = $manager->getAllList();
  foreach ($listeCitation as $citation) {
    ?>
    <tr>
    <td><?php echo $citation->getPerNom(); ?></td>
    <td><?php echo $citation->getLibelle(); ?></td>
    <td><?php echo getFrenchDate($citation->getDate()); ?></td>
    <td><?php echo $citation->getMoyNote(); ?></td>
    <?php if ($managerCo->isAdmin($_SESSION["login"]) ) {
      echo '<td>';
      echo '<a href="index.php?page=23&cit_num='.$citation->getNum().'" >
      <img class = "icone" src="image/erreur.png" alt="SupprimerCitation"/></a>';
    } ?></td>
</tr>
  <?php
  }
  ?>

</table>
