<h1>Ajouter un salarié</h1>

<?php if ( !isset($_POST["telPro"]) && !isset($_POST["fonction"]) ) { ?>

  <form name="ajSalarie" action ="#" method = "post" id = "ajSalarie">

    	Téléphone professionnel : <input size = 30 maxlength = 50 name="telPro"><br /><br />

      <label>Fonction : </label>
      <select class="champ" id="fonction" name="fonction" >
        <?php
        $listeFonction = $managerFonction->getList();
        foreach ($listeFonction as $fonction) { ?>
          <option value="<?php echo $fonction->getNum(); ?>">
            <?php echo $fonction->getNom(); ?></option>
            <?php echo "\n" ;
          }
          ?>
        </select>	<br /><br />

        <!--La ligne qui suit permet d'avoir une valeur pour $_POST["catégorie"] quand la page (ajouterPersonne) est rappelée-->
        <input type="radio" style="display:none;" name="catégorie" value="salarie" checked>

        <input type=submit value="Valider">

    </form>

<?php } else {
    if ( empty($_POST["telPro"]) ) {?>

      <h3><img class = "icone" src="image/erreur.png" alt="ajSalarie"/> Vous devez renseigner un numéro de téléphone profesionnel...</h3>

      <form name="ajSalarie" action ="#" method = "post" id = "ajSalarie">

        	Téléphone professionnel : <input size = 30 maxlength = 50 name="telPro"><br /><br />

          <label>Fonction : </label>
          <select class="champ" id="fonction" name="fonction" >
            <?php
            $listeFonction = $managerFonction->getList();
            foreach ($listeFonction as $fonction) { ?>
              <option value="<?php echo $fonction->getNum(); ?>">
                <?php echo $fonction->getNom(); ?></option>
                <?php echo "\n" ;
              }
              ?>
            </select>	<br /><br />

            <!--La ligne qui suit permet d'avoir une valeur pour $_POST["catégorie"] quand la page (ajouterPersonne) est rappelée-->
            <input type="radio" style="display:none;" name="catégorie" value="salarie" checked>

            <input type=submit value="Valider">

        </form>

    <?php } else { ?>

    <?php $managerSal->ajoutSalarie($_SESSION["numNew"], $_POST["telPro"], $_POST["fonction"] ); ?>

  <p><img class = "icone" src="image/valid.png" alt="ajSalarie"/> Le salarié a été ajouté !</p>

  <meta http-equiv="refresh" content="2; URL=index.php?page=0">
    <p> Redirection automatique dans 2 secondes. </p>

<?php }
} ?>
