<?php
class VilleManager {

private $db;

  public function __construct($db) {
    $this->db = $db;
  }

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

  public function getNbVille() {
    $sql = 'SELECT count(*) AS nbVille FROM ville';

    $req = $this->db->query($sql);

    $nbVille = $req->fetch();

    $req->closeCursor();
    return $nbVille["nbVille"];
  }

  public function ajoutVille($nom) {

    $sql = 'INSERT INTO ville (vil_nom) VALUES(\''.$nom.'\')';

    $req = $this->db->query($sql);

    $req->closeCursor();

  }

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

  public function getNbVilleSupprimable() {
    $sql = 'SELECT count(vil_num) AS nbVille FROM ville
    WHERE vil_num NOT IN (SELECT vil_num FROM departement)';

    $req = $this->db->query($sql);

    $nbVille = $req->fetch();

    $req->closeCursor();
    return $nbVille["nbVille"];
  }

  public function supprimerVille($num) {

  $sql = 'DELETE FROM ville WHERE vil_num='.$num;

  $req = $this->db->query($sql);

  $req->closeCursor();
  }

  public function modifierVille($num, $nom) {

    $sql = 'UPDATE ville SET vil_nom=\''.$nom.'\'
    WHERE vil_num='.$num;

    $req = $this->db->query($sql);

    $req->closeCursor();
  }
}
