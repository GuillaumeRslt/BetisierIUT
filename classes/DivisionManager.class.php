<?php
class DivisionManager {

private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function getList() {
    $listeDivision = array();

    $sql = 'SELECT div_num, div_nom from division';

    $req = $this->db->query($sql);

    while ($division = $req->fetch(PDO::FETCH_OBJ)) {
      $listeDivision[] = new Division($division);
    }

    $req->closeCursor();
    return $listeDivision;

  }
}
