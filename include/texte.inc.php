<?php $db = new Mypdo();

  $managerCo = new ConnexionManager($db);
  $managerPer = new PersonneManager($db);
  ?>
<div id="texte">
<?php
//On determine le satus de la personne connecté ou non
$connecter = "";
if ( isset($_SESSION["num"]) ) {
	if ( $managerCo->isAdmin($_SESSION["login"]) ) {
		if ( $managerPer->isSalarie($_SESSION["num"]) )
			$connecter = "salAdmin"; //salarié admin
	 	else
			$connecter = "etuAdmin"; //étudiant admin
	} else {
		if ( $managerPer->isSalarie($_SESSION["num"]) )
			$connecter = "sal"; //salarié
	 	else
			$connecter = "etu"; //étudiant
	}
} else
		$connecter = "pasCo"; //personne non connecté

if (!empty($_GET["page"])){
	$page=$_GET["page"];
//On défini les droits sur les pages on fonction du status de l'utilisateur du site
	if ( $connecter == "salAdmin" && ($page == 5 || $page == 17 || $page == 15) ) 
		$page = 0;
	if ( $connecter == "etuAdmin" && $page == 15 )
		$page = 0;
	if ( $connecter == "sal" && !($page == 0 || $page == 1 || $page == 2
	|| $page == 11 || $page == 12 || $page == 16 || $page == 6
	|| $page == 7 || $page == 10 || $page == 14 ) )
		$page = 0;
	if ( $connecter == "etu" && ($page == 3 || $page == 4 || $page == 21 || $page == 18 || $page == 19 || $page == 20 || $page == 15) ) {
		$page = 0; }
	if ( $connecter == "pasCo" && !($page == 0 || $page == 1 || $page == 2
	|| $page == 15 || $page == 6 || $page == 7 || $page == 10
	|| $page == 14 ) )
		$page = 0;

	} else {
	$page=0;
}

switch ($page) {
//
// Accueil
//
case 0:
	// inclure ici la page accueil photo
	include_once('pages/accueil.inc.php');
	break;
//
// Personne
//
case 1:
	// inclure ici la page insertion nouvelle personne
	include("pages/listerPersonnes.inc.php");
    break;

case 2:
	// inclure ici la page liste des personnes
	include_once('pages/ajouterPersonne.inc.php');
    break;
case 3:
	// inclure ici la page modification des personnes
	include("pages/modifierPersonne.inc.php");
    break;
case 4:
	// inclure ici la page suppression personnes
	include_once('pages/supprimerPersonne.inc.php');
    break;
case 21:
	include_once('pages/suppressionPersonne.inc.php');
		break;
case 14:
 	// include ici la page de détail des personne
	include_once('pages/detailPersonne.inc.php');
		break;
case 18:
	// inclure ici la page permmettant de modifier une personne
	include_once('pages/modificationPersonne.inc.php');
		break;
case 19:
	// inclure ici la page modifiant un salarié
	include_once('pages/finModifSal.inc.php');
		break;
case 20:
	// inclure ici la page modifiant un étudiant
	include_once('pages/finModifEtu.inc.php');
		break;


//
// Citations
//
case 5:
	// inclure ici la page ajouter citations
    include("pages/ajouterCitation.inc.php");
    break;
case 6:
	// inclure ici la page liste des citations
	include("pages/listerCitation.inc.php");
    break;
case 7:
	// inclure ici la page rechercher citations
	include("pages/rechercherCitations.inc.php");
    break;
case 8:
	// inclure ici la page valider citation
	include("pages/validerCitation.inc.php");
    break;
case 9:
	// inclure ici la page supprimer citation
	include("pages/supprimerCitation.inc.php");
    break;
case 17:
	// inclure ici la page noter citation
	include("pages/noterCitation.inc.php");
		break;
//
// Villes
//
case 10:
	// inclure ici la page lister villes
	include("pages/listerVilles.inc.php");
    break;
case 11:
	// inclure ici la page ajouter ville
	include("pages/ajouterVille.inc.php");
    break;
case 12:
	// inclure ici la page modifier ville
	include("pages/modifierVille.inc.php");
    break;
case 13:
	// inclure ici la page supprimer ville
	include("pages/supprimerVille.inc.php");
		break;
//
// connexion
//
	case 15:
		// inclure ici la page de Connexion
		include("pages/connexion.inc.php");
			break;
	case 16:
		// inclure ici la page de déconnexion
		include("pages/deconnexion.inc.php");
			break;

default : 	include_once('pages/accueil.inc.php');
}

?>
</div>
