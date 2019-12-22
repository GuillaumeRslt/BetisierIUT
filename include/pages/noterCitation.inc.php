<h1>Note Citation</h1>
<?php $db = new Mypdo();

  $manager = new CitationManager($db);
  $managerPer = new PersonneManager($db);
  ?>

<?php if (empty($_POST["noteCit"]) ) {
  $_SESSION["citNum"] = $_GET["cit_num"];?>

  <table>
    <tr>
      <th>Nom de l'enseignement</th>
      <th>Libellé</th>
      <th>Date</th>
      <th>Moyenne des notes</th>
    <tr>
    <td><?php echo $_GET["cit_nom"]; ?></td>
    <td><?php echo $_GET["cit_lib"]; ?></td>
    <td><?php echo $_GET["cit_date"]; ?></td>
    <td><?php echo $_GET["cit_moy"]; ?></td>
  </tr>

  </table>

  <form name="noterCitation" id="noterCitation" action="#" method="post" >

    Note : <input type="number" min="0" max="20" name="noteCit" required><br /><br />

    <input type=submit value="Valider">
  </form>

<?php } else {

 $manager->noterCitation( $_GET["cit_num"], $_SESSION["num"], $_POST["noteCit"]); ?>

  <p><img class = "icone" src="image/valid.png" alt="noteCitation"/> Vous avez mis la note de <?php echo $_POST["noteCit"]; ?></p>

  <a href="index.php?page=6" > Retour aux citations </a>

<?php } ?>
