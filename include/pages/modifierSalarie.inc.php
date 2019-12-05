<h1>Modifier un salarié</h1>

<?php if (!$manager->isSalarie($_SESSION["modif"]) ) {
    $managerEtu->suprEtudiant($_SESSION["modif"]);
    $managerSal->ajoutSalarie($_SESSION["modif"], "0000000000", 1);
}?>

  <form name="ModifSalarie" action ="index.php?page=19" method = "post" id = "ModifSalarie">

    	Téléphone professionnel : <input size = 30 maxlength = 50 name="telPro" value="<?php echo $managerSal->getSalarie($_SESSION["modif"])->getTelPro(); ?>" required><br /><br />

      <label>Fonction : </label>
      <select class="champ" id="fonction" name="fonction" >
        <?php
        $listeFonction = $managerFon->getList();
        foreach ($listeFonction as $fonction) { ?>
          <option value="<?php echo $fonction->getNum(); ?>">
            <?php echo $fonction->getNom(); ?></option>
            <?php echo "\n" ;
          }
          ?>
        </select>	<br /><br />

        <input type=submit value="Valider">

    </form>
