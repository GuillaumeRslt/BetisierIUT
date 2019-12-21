<?php
class CitationManager {

private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function getList() {
    $listeCitation = array();

    $sql = 'SELECT c.cit_num, concat(per_nom, \' \', per_prenom) AS per_nompre, cit_libelle, cit_date, AVG(vot_valeur) AS note_moy
    FROM citation c
    JOIN personne p ON c.per_num=p.per_num
    LEFT JOIN vote v ON c.cit_num=v.cit_num
    WHERE cit_valide=1 AND cit_date_valide is not null
    GROUP BY per_nom, c.cit_num, cit_date
    ORDER BY cit_date desc';

    $req = $this->db->query($sql);

    while ($citation = $req->fetch(PDO::FETCH_OBJ)) {
      $listeCitation[] = new Citation($citation);
    }

    $req->closeCursor();
    return $listeCitation;

  }

  public function getAllList() {
    $listeCitation = array();

    $sql = 'SELECT c.cit_num, concat(per_nom, \' \', per_prenom) AS per_nompre, cit_libelle, cit_date, AVG(vot_valeur) AS note_moy
    FROM citation c
    JOIN personne p ON c.per_num=p.per_num
    LEFT JOIN vote v ON c.cit_num=v.cit_num
    GROUP BY per_nom, c.cit_num, cit_date
    ORDER BY cit_date desc';

    $req = $this->db->query($sql);

    while ($citation = $req->fetch(PDO::FETCH_OBJ)) {
      $listeCitation[] = new Citation($citation);
    }

    $req->closeCursor();
    return $listeCitation;

  }

  public function getNbCitation() {
    $sql = 'SELECT count(*) AS nbCitation
    FROM citation c
    WHERE cit_valide=1 AND cit_date_valide is not null';

    $req = $this->db->query($sql);

    $nbCitation = $req->fetch();

    $req->closeCursor();
    return $nbCitation["nbCitation"];
  }

  public function getNbAllCitation() {
    $sql = 'SELECT count(*) AS nbCitation
    FROM citation c';

    $req = $this->db->query($sql);

    $nbCitation = $req->fetch();

    $req->closeCursor();
    return $nbCitation["nbCitation"];
  }

  public function ajoutCitation($enseignant, $num, $citation, $dateCit) {

    $dateDepo = $this->getDateJour();

    $sql = 'INSERT INTO citation (per_num, per_num_etu, cit_libelle, cit_date, cit_valide, cit_date_depo)
    VALUES(:enseignant, :num, :citation, :dateCit, 0, :dateDepo)';

    $req = $this->db->prepare($sql);

    $req->bindValue(':enseignant',$enseignant,PDO::PARAM_STR);
    $req->bindValue(':num',$num,PDO::PARAM_STR);
    $req->bindValue(':citation',$citation,PDO::PARAM_STR);
    $req->bindValue(':dateCit',$dateCit,PDO::PARAM_STR);
    $req->bindValue(':dateDepo',$dateDepo,PDO::PARAM_STR);

    $req->execute();

    $req->closeCursor();

  }

  public function getDateJour() {
    $sql = 'SELECT DATE(NOW()) as dateJour';

    $req = $this->db->query($sql);

    $dateJour = $req->fetch();

    $req->closeCursor();
    return $dateJour["dateJour"];
  }

  public function isNote($numEtu, $numCit) {
    $sql = 'SELECT count(*) as nbCitation
    FROM citation c
    JOIN vote v ON c.cit_num=v.cit_num
    WHERE '.$numEtu.'=v.per_num AND '.$numCit.'=v.cit_num
    AND cit_valide=1 AND cit_date_valide is not null';

    $req = $this->db->query($sql);

    $nbCitation = $req->fetch();

    if ($nbCitation["nbCitation"] == 0)
      return false;
    else
      return true;

    $req->closeCursor();
  }

  public function noterCitation($numCit, $num, $note) {

    $sql = 'INSERT INTO vote (cit_num, per_num, vot_valeur)
    VALUES(\''.$numCit.'\', \''.$num.'\', \''.$note.'\')';

    $req = $this->db->query($sql);

    $req->closeCursor();
  }

  public function getPlusVieilleDate(){

    $sql = 'SELECT cit_date as plusVieilleDate FROM citation
    HAVING plusVieilleDate <= all(SELECT cit_date FROM citation)';

    $req = $this->db->query($sql);

    $date = $req->fetch();

    return $date['plusVieilleDate'];
    $req->closeCursor();
  }

  public function getListResultatRechercheCit($num, $dateDeb, $dateFin, $noteDeb, $noteFin){
  $listeCitation =array();

  if ($num == 0) {

    $sql = 'SELECT c.cit_num, concat(per_nom, \' \', per_prenom) AS per_nompre, cit_libelle, cit_date, AVG(vot_valeur) AS note_moy
    FROM citation c
    JOIN personne p ON c.per_num=p.per_num
    LEFT JOIN vote v ON c.cit_num=v.cit_num
    WHERE cit_valide=1 AND cit_date_valide is not null
    AND cit_date BETWEEN \''.$dateDeb.'\' AND \''.$dateFin.'\'
    GROUP BY per_nom, c.cit_num, cit_date
    HAVING AVG(vot_valeur) BETWEEN '.$noteDeb.' AND '.$noteFin.'
    ORDER BY cit_date desc';

  } else {

    $sql = 'SELECT c.cit_num, concat(per_nom, \' \', per_prenom) AS per_nompre, cit_libelle, cit_date, AVG(vot_valeur) AS note_moy
    FROM citation c
    JOIN personne p ON c.per_num=p.per_num
    LEFT JOIN vote v ON c.cit_num=v.cit_num
    WHERE cit_valide=1 AND cit_date_valide is not null
    AND p.per_num='.$num.'
    AND cit_date BETWEEN \''.$dateDeb.'\' AND \''.$dateFin.'\'
    GROUP BY per_nom, c.cit_num, cit_date
    HAVING AVG(vot_valeur) BETWEEN '.$noteDeb.' AND '.$noteFin.'
    ORDER BY cit_date desc';

  }

  $req= $this->db->query($sql);

  while ($citation = $req->fetch(PDO::FETCH_OBJ)) {
    $listeCitation[] = new Citation($citation);
  }

  return $listeCitation;
  $req->closeCursor();
  }

  public function isInterdit($mot)
  {
    $req = $this->db->prepare('SELECT COUNT(*) AS nb FROM (SELECT mot_interdit ,
                              MATCH (mot_interdit)
                              AGAINST (:mot)
                              AS pertinence FROM mot
                              WHERE MATCH (mot_interdit)
                              AGAINST (:mot))T');

    $req->bindValue(':mot',$mot,PDO::PARAM_STR);

    $req->execute();

    $retour = $req->fetch();

    if ($retour["nb"] == 0)
      return false;
    else
      return true;

    $req->closeCursor();
  }

  public function isValide($num) {
    $sql = 'SELECT COUNT(*) AS nbCitation
    FROM citation c
    WHERE cit_valide=1 AND cit_date_valide is not null AND cit_num=\''.$num.'\'';

    $req = $this->db->query($sql);

    $nbCitation = $req->fetch();

    if ($nbCitation["nbCitation"] == 0)
      return false;
    else
      return true;

    $req->closeCursor();
  }

  public function validerCit($citNum, $numValide) {

    $date = $this->getDateJour();

    $sql = 'UPDATE citation SET cit_valide=1, per_num_valide='.$numValide.', cit_date_valide=\''.$date.'\' WHERE cit_num=\''.$citNum.'\'';

    $req = $this->db->query($sql);

    $req->closeCursor();
  }

  public function supprimerCit($num) {

  $sql = 'DELETE FROM citation WHERE cit_num='.$num;

  $req = $this->db->query($sql);

  $req->closeCursor();
  }
}
