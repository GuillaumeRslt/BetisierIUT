<h1>Ajouter un étudiant</h1>

<?php if ( !isset($_POST["annee"]) && !isset($_POST["departement"]) ) { ?>

  <form name="ajEtudiant" action ="#" method = "post" id = "ajEtudiant">

    <label>Année : </label>
    <select class="champ" id="division" name="division" >
      <?php
      $listeDivision = $managerDiv->getList();
      foreach ($listeDivision as $division) { ?>
        <option value="<?php echo $division->getNum(); ?>">
          <?php echo $division->getNom(); ?></option>
          <?php echo "\n" ;
        }
        ?>
      </select>	<br /><br />

      <label>Département : </label>
      <select class="champ" id="departement" name="departement" >
        <?php
        $listeDepartement = $managerDep->getList();
        foreach ($listeDepartement as $departement) { ?>
          <option value="<?php echo $departement->getNum(); ?>">
            <?php echo $departement->getNom(); ?></option>
            <?php echo "\n" ;
          }
          ?>
        </select>	<br /><br />

        <!--La ligne qui suit permet d'avoir une valeur pour $_POST["catégorie"] quand la page (ajouterPersonne) est rappelée-->
        <input type="radio" style="display:none;" name="catégorie" value="Etudiant" checked>

        <input type=submit value="Valider">

    </form>

<?php } else { ?>

    <?php $managerEtu->ajoutEtudiant($_SESSION["numNew"], $_POST["departement"], $_POST["division"] ); ?>

  <p><img class = "icone" src="image/valid.png" alt="ajEtudiant"/> L'étudiant a été ajouté !</p>

    <a href="index.php?page=0" > Retour à l'accueil </a>

<?php } ?>
