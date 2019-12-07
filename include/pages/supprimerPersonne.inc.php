<h1>Supprimer des personnes enregistrées</h1>

<?php $db = new Mypdo();

  $manager = new PersonneManager($db);
  ?>

  <?php $_SESSION["suppression"] = true; ?>
  <p>Actuellement <?php echo $manager->getNbPersonne(); ?> personnes sont enregistrées</p>

  <table>
    <tr>
      <th>Nom</th>
      <th>Prenom</th>
      <th>Supprimer</th>
    </tr>

  <?php

  $listePersonne = $manager->getList();
  foreach ($listePersonne as $personne) {
    ?>
    <tr>
    <td><?php echo $personne->getNom(); ?></td>
    <td><?php echo $personne->getPrenom(); ?></td>
    <td> <a href="index.php?page=21&per_num=<?php echo $personne->getNum(); ?>&per_prenom=<?php echo $personne->getPrenom(); ?>&per_nom=<?php echo $personne->getNom(); ?> ">
                          <img class = "icone" src="image/erreur.png" alt="supprimerPersonne"/> </a>
                        </td>
  </tr>
  <?php
  }
  ?>

  </table>
