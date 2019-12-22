<?php
class VilleManager {

private $db;

  public function __construct($db) {
    $this->db = $db;
  }

//Récupération des ville présentes dans la base de données
  public function getList() {
    $listeVille = array();

    $sql = 'SELECT vil_num, vil_nom from ville';

    $req = $this->db->query($sql);

    while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
      $listeVille[] = new Ville($ville);
    }

    $req->closeCursor();
    return $listeVille;

  }

//Récupération du nombre de ville présentes dans le base
  public function getNbVille() {
    $sql = 'SELECT count(*) AS nbVille FROM ville';

    $req = $this->db->query($sql);

    $nbVille = $req->fetch();

    $req->closeCursor();
    return $nbVille["nbVille"];
  }

//Ajoute une ville dans la table vile
  public function ajoutVille($nom) {

    $req = $this->db->prepare('INSERT INTO ville (vil_nom) VALUES(:nom)');

    $req->bindValue(':nom', $nom, PDO::PARAM_STR);

    $req->execute();

    $req->closeCursor();

  }
//Récupère les villes n'étant pas présentent dans la table departement
  public function getListSupprimable() {
    $listeVille = array();

    $sql = 'SELECT vil_num, vil_nom FROM ville
    WHERE vil_num NOT IN (SELECT vil_num FROM departement)';

    $req = $this->db->query($sql);

    while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
      $listeVille[] = new Ville($ville);
    }

    $req->closeCursor();
    return $listeVille;

  }

//Nombre des ville n'étant pas dans la table département
  public function getNbVilleSupprimable() {
    $sql = 'SELECT count(vil_num) AS nbVille FROM ville
    WHERE vil_num NOT IN (SELECT vil_num FROM departement)';

    $req = $this->db->query($sql);

    $nbVille = $req->fetch();

    $req->closeCursor();
    return $nbVille["nbVille"];
  }

//Supprime une ville de la table ville
  public function supprimerVille($num) {

  $req = $this->db->prepare('DELETE FROM ville WHERE vil_num=:num');

  $req->bindValue(':num', $num, PDO::PARAM_STR);

  $req->execute();

  $req->closeCursor();
  }

//Modifie le nom d'une ville (à partir de son id)
  public function modifierVille($num, $nom) {

    $req = $this->db->prepare('UPDATE ville SET vil_nom=:nom
    WHERE vil_num=:num');

    $req->bindValue(':num', $num, PDO::PARAM_STR);
    $req->bindValue(':nom', $nom, PDO::PARAM_STR);

    $req->execute();

    $req->closeCursor();
  }
}
