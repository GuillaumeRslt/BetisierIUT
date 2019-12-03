<h1>Modifier un étudiant</h1>

  <form name="ModifEtudiant" action ="index.php?page=20" method = "post" id = "ModifEtudiant">

    <label>Année : </label>
    <select class="champ" id="annee" name="div" >
      <?php
      $listeDiv = $managerDiv->getList();
      foreach ($listeDiv as $division) { ?>
        <option value="<?php echo $division->getNum(); ?>">
          <?php echo $division->getNom(); ?></option>
          <?php echo "\n" ;
        }
        ?>
      </select>	<br /><br />

      <label>Département : </label>
      <select class="champ" id="departement" name="dep" >
        <?php
        $listeDep = $managerDep->getList();
        foreach ($listeDep as $departement) { ?>
          <option value="<?php echo $departement->getNum(); ?>">
            <?php echo $departement->getNom(); ?></option>
            <?php echo "\n" ;
          }
          ?>
        </select>	<br /><br />

        <input type=submit value="Valider">

    </form>
