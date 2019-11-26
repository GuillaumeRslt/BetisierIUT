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
}
