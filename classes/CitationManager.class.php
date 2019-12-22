<?php
class CitationManager {

private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  //Récupération des citations validées
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

//Récupération de toutes les citations valides ou non
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

//Nombre des citations valides
  public function getNbCitation() {
    $sql = 'SELECT count(*) AS nbCitation
    FROM citation c
    WHERE cit_valide=1 AND cit_date_valide is not null';

    $req = $this->db->query($sql);

    $nbCitation = $req->fetch();

    $req->closeCursor();
    return $nbCitation["nbCitation"];
  }

//Nombre de toutes les citations valides ou non
  public function getNbAllCitation() {
    $sql = 'SELECT count(*) AS nbCitation
    FROM citation c';

    $req = $this->db->query($sql);

    $nbCitation = $req->fetch();

    $req->closeCursor();
    return $nbCitation["nbCitation"];
  }

//Ajout d'une citation dans la base de données
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

//Récupération de la date actuelle
  public function getDateJour() {
    $sql = 'SELECT DATE(NOW()) as dateJour';

    $req = $this->db->query($sql);

    $dateJour = $req->fetch();

    $req->closeCursor();
    return $dateJour["dateJour"];
  }

//Est-ce que la citation est notée
  public function isNote($numEtu, $numCit) {
    $sql = 'SELECT count(*) as nbCitation
    FROM citation c
    JOIN vote v ON c.cit_num=v.cit_num
    WHERE v.per_num=:numEtu AND v.cit_num=:numCit
    AND cit_valide=1 AND cit_date_valide is not null';

    $req = $this->db->prepare($sql);

    $req->bindValue(':numEtu',$numEtu,PDO::PARAM_STR);
    $req->bindValue(':numCit',$numCit,PDO::PARAM_STR);

    $req->execute();

    $nbCitation = $req->fetch();

    if ($nbCitation["nbCitation"] == 0)
      return false;
    else
      return true;

    $req->closeCursor();
  }

//Ajout d'une note dans la table vote
  public function noterCitation($numCit, $num, $note) {

    $sql = 'INSERT INTO vote (cit_num, per_num, vot_valeur)
    VALUES(:numCit, :num, :note )';

    $req = $this->db->prepare($sql);

    $req->bindValue(':numCit',$numCit,PDO::PARAM_STR);
    $req->bindValue(':num',$num,PDO::PARAM_STR);
    $req->bindValue(':note',$note,PDO::PARAM_STR);

    $req->execute();

    $req->closeCursor();
  }

//Récupération de la plus vieille date d'une citation
  public function getPlusVieilleDate(){

    $sql = 'SELECT cit_date as plusVieilleDate FROM citation
    HAVING plusVieilleDate <= all(SELECT cit_date FROM citation)';

    $req = $this->db->query($sql);

    $date = $req->fetch();

    return $date['plusVieilleDate'];
    $req->closeCursor();
  }

//Récupère le résultat de la recherche en fonction que l'utilisateur est définis ou non un enseignant dans la recherche
  public function getListResultatRechercheCit($num, $dateDeb, $dateFin, $noteDeb, $noteFin){
  $listeCitation =array();

  if ($num == 0) { //Si aucun enseignant n'a été défini

    $sql = 'SELECT c.cit_num, concat(per_nom, \' \', per_prenom) AS per_nompre, cit_libelle, cit_date, AVG(vot_valeur) AS note_moy
    FROM citation c
    JOIN personne p ON c.per_num=p.per_num
    LEFT JOIN vote v ON c.cit_num=v.cit_num
    WHERE cit_valide=1 AND cit_date_valide is not null
    AND cit_date BETWEEN :dateDeb AND :dateFin
    GROUP BY per_nom, c.cit_num, cit_date
    HAVING AVG(vot_valeur) BETWEEN :noteDeb AND :noteFin
    ORDER BY cit_date desc';

    $req= $this->db->prepare($sql);

  } else {

    $sql = 'SELECT c.cit_num, concat(per_nom, \' \', per_prenom) AS per_nompre, cit_libelle, cit_date, AVG(vot_valeur) AS note_moy
    FROM citation c
    JOIN personne p ON c.per_num=p.per_num
    LEFT JOIN vote v ON c.cit_num=v.cit_num
    WHERE cit_valide=1 AND cit_date_valide is not null
    AND p.per_num=:num
    AND cit_date BETWEEN :dateDeb AND :dateFin
    GROUP BY per_nom, c.cit_num, cit_date
    HAVING AVG(vot_valeur) BETWEEN :noteDeb AND :noteFin
    ORDER BY cit_date desc';

    $req= $this->db->prepare($sql);

    $req->bindValue(':num', $num,PDO::PARAM_STR);

  }

  $req->bindValue(':dateDeb', $dateDeb,PDO::PARAM_STR);
  $req->bindValue(':dateFin', $dateFin,PDO::PARAM_STR);
  $req->bindValue(':noteDeb', $noteDeb,PDO::PARAM_STR);
  $req->bindValue(':noteFin', $noteFin,PDO::PARAM_STR);

  $req->execute();

  while ($citation = $req->fetch(PDO::FETCH_OBJ)) {
    $listeCitation[] = new Citation($citation);
  }

  return $listeCitation;
  $req->closeCursor();
  }

//Est-ce que le mot est interdit ou non (présent dans la table mot)
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

//Est-ce qu'une citation est valide
  public function isValide($num) {
    $sql = 'SELECT COUNT(*) AS nbCitation
    FROM citation c
    WHERE cit_valide=1 AND cit_date_valide is not null AND cit_num=:num';

    $req = $this->db->prepare($sql);

    $req->bindValue(':num', $num, PDO::PARAM_STR);

    $req->execute();

    $nbCitation = $req->fetch();

    if ($nbCitation["nbCitation"] == 0)
      return false;
    else
      return true;

    $req->closeCursor();
  }

//Valide une citation
  public function validerCit($citNum, $numValide) {

    $date = $this->getDateJour();

    $req = $this->db->prepare('UPDATE citation
      SET cit_valide=1, per_num_valide=:numValide, cit_date_valide=:dateJour
      WHERE cit_num=:citNum');

    $req->bindValue(':numValide', $numValide, PDO::PARAM_STR);
    $req->bindValue(':dateJour', $date, PDO::PARAM_STR);
    $req->bindValue(':citNum', $citNum, PDO::PARAM_STR);

    $req->execute();

    $req->closeCursor();
  }

//Supprime une citation ainsi que ses notes
  public function supprimerCit($num) {
//Suppréssion de la citation
  $req = $this->db->prepare('DELETE FROM citation WHERE cit_num=:num');

  $req->bindValue(':num', $num, PDO::PARAM_STR);

  $req->execute();

  $req->closeCursor();

//Suppréssion de ses notes
  $req = $this->db->prepare('DELETE FROM vote WHERE cit_num=:num');

  $req->bindValue(':num', $num, PDO::PARAM_STR);

  $req->execute();

  $req->closeCursor();

  }
}
