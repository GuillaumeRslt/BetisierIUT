<div id="texte">
<?php
if (!empty($_GET["page"])){
	$page=$_GET["page"];}
	else
	{$page=0;
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
	include_once('pages/AjouterPersonne.inc.php');
    break;
case 3:
	// inclure ici la page modification des personnes
	include("pages/ModifierPersonne.inc.php");
    break;
case 4:
	// inclure ici la page suppression personnes
	include_once('pages/supprimerPersonne.inc.php');
    break;
case 14:
 	// include ici la page de détail des personne
	include_once('pages/detailPersonne.inc.php');
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
	include("pages/supprmierCitation.inc.php");
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