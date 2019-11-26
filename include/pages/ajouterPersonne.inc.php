<?php $db = new Mypdo();

$managerDiv = new DivisionManager($db);
$managerDep = new DepartementManager($db);
$managerEtu = new EtudiantManager($db);
$managerSal = new SalarieManager($db);
$managerPer = new PersonneManager($db);
$managerFonction = new FonctionManager($db);
?>

<?php if ( empty($_POST["nom"]) && empty($_POST["prenom"]) &&
empty($_POST["tel"]) && empty($_POST["mail"]) && empty($_POST["login"]) &&
empty($_POST["mdp"]) && !isset($_POST["division"]) && !isset($_POST["fonction"]) ) { ?>

<h1>Ajouter une personne</h1>

	<form name="ajPersonne" id="ajPersonne" action="#" method="post" >

		Nom : <input size = 30 maxlength = 50 name="nom"><br /><br />
		Prénom : <input size = 30 maxlength = 50 name="prenom"><br /><br />
		Téléphone : <input size = 30 maxlength = 50 name="tel"><br /><br />
		Mail : <input size = 30 maxlength = 50 name="mail"><br /><br />
		Login : <input size = 30 maxlength = 50 name="login"><br /><br />
		Mot de passe : <input type="password" size = 30 maxlength = 50 name="mdp"><br /><br />
		Catégorie : <input type="radio" name="catégorie" value="Etudiant" checked> Etudiant
  	<input type="radio" name="catégorie" value="salarie"> Personnel<br /><br />
		<input type=submit value="Suivant">
	</form>

<?php } else {
if ( (empty($_POST["nom"]) || empty($_POST["prenom"]) ||
empty($_POST["tel"]) || empty($_POST["mail"]) || empty($_POST["login"]) ||
empty($_POST["mdp"])) && (!isset($_POST["division"]) && !isset($_POST["fonction"])) ) { ?>

<h1>Ajouter une personne</h1>

	<h3><img class = "icone" src="image/erreur.png" alt="ajPersonne"/> Certains champs ne sont pas remplis...</h3>

	<form name="ajPersonne" id="ajPersonne" action="#" method="post" >

		Nom : <input size = 30 maxlength = 50 name="nom" value="<?php echo $_POST["nom"]; ?>"><br /><br />
		Prénom : <input size = 30 maxlength = 50 name="prenom" value="<?php echo $_POST["prenom"]; ?>"><br /><br />
		Téléphone : <input size = 30 maxlength = 50 name="tel" value="<?php echo $_POST["tel"]; ?>"><br /><br />
		Mail : <input size = 30 maxlength = 50 name="mail" value="<?php echo $_POST["mail"]; ?>"><br /><br />
		Login : <input size = 30 maxlength = 50 name="login" value="<?php echo $_POST["login"]; ?>"><br /><br />
		Mot de passe : <input type="password" size = 30 maxlength = 50 name="mdp"><br /><br />
		Catégorie : <input type="radio" name="catégorie" value="etudiant" checked> Etudiant
  	<input type="radio" name="catégorie" value="salarie"> Personnel<br /><br />
		<input type=submit value="Suivant">
	</form>



<?php } else {

	if (isset($_POST["nom"]) ) {
 $_SESSION["numNew"] = $managerPer->ajoutPersonne($_POST["nom"], $_POST["prenom"], $_POST["tel"], $_POST["mail"], $_POST["login"], $_POST["mdp"] );
	}

if ($_POST["catégorie"] == "salarie") {

include_once("ajouterSalarie.inc.php");

 } else {

	include_once("ajouterEtudiant.inc.php");

 		}
	}
}?>
