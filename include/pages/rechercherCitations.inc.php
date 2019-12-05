<?php $db = new Mypdo();

$managerCit = new CitationManager($db);
$managerPer = new PersonneManager($db);
$listeSalarie = $managerPer->getListSalarie();
?>


  <?php
  if (empty($_POST['dateDebut'])) { ?>
     <h1>rechercher une citation</h1>

   <form name="rechercherCit" id="rechercherCit" action="#" method="post">

     Salarie : <select class="champ" id="salarie" name="salarie"/>
     <option value="0" > Sélectionnez salarié </option><?php
     foreach ($listeSalarie as $salarie) {  ?>
         <option value= <?php echo $salarie->getNum(); ?>>
           <?php echo $salarie->getNom(); ?> </option> <?php }?>
         </select><br /><br />

         Date citation :  <br />
         entre <input type="date" name="dateDebut" value="<?php echo $managerCit->getPlusVieilleDate(); ?>">
         et <input type="date" name="dateFin" value="<?php echo $managerCit->getDateJour(); ?>"><br /><br />

         Note : <br />
         entre <input type="number" name="noteDebut" min="0" max="20" value="0" >
         et <input type="number" name="noteFin" min="1" max="20" value="20" ><br /><br />

         <input type="submit" name="Valider" />

   </form>

 <?php } else {

     $listeResultat = $managerCit->getListResultatRechercheCit(
       $_POST['salarie'], $_POST['dateDebut'], $_POST["dateFin"], $_POST['noteDebut'], $_POST['noteFin']);
 ?>
     <h1>Résultat de la recherche </h1>

     <?php if(!empty($listeResultat)){ ?>
       <table>
         <tr>
           <th>Nom de l'enseignement</th>
           <th>Libellé</th>
           <th>Date</th>
           <th>Moyenne des notes</th>
         </tr>

    <?php foreach ($listeResultat as $citation) { ?>
         <tr>
         <td><?php echo $citation->getPerNom(); ?></td>
         <td><?php echo $citation->getLibelle(); ?></td>
         <td><?php echo getFrenchDate($citation->getDate()); ?></td>
         <td><?php echo $citation->getMoyNote(); ?></td>
       </tr>
     <?php } ?>

     </table>

   <?php }else { ?>

     <p>Pas de citations trouvées... </p>

   <?php }
 } ?>
