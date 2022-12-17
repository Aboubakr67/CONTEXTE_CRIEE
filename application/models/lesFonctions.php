<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class lesFonctions extends CI_Model
{
 public function __construct()
 {
	parent::__construct();
 }

// Avec une requete SQL
public function afficheDonnee()
{
	$search = "SELECT lot.* FROM lot";
	$result = $this->db->conn_id->prepare($search);
	$result->execute();
	$query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	return $query_result; 
}


// Avec une procédure stockée
public function affToutLesLots()
{
	$search = "call affLot";
	$result = $this->db->conn_id->prepare($search);
	$result->execute();
	$query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	return $query_result; 
}

public function recupNumAcheteur($login, $mdp)
 {
    // echo $login;
	// echo $mdp;
	 $search = "call recupNumAcheteur('$login', '$mdp')";
	 $result = $this->db->conn_id->prepare($search);
	 $result->execute();

	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 
	 return $query_result; 

 }

 // Verifie que l'acheteur est inscrit dans la bdd
 public function verifConnectionAcheteur($mail, $mdp)
 {
	 $search = "call verifConnectionAcheteur('$mail', '$mdp')";
	 $result = $this->db->conn_id->prepare($search);
	 $result->execute();

	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 
	 return $query_result; 

 }


 // Verifie que l'admin est dans la bdd
 public function verifConnectionAdmin($mail, $mdp)
 {
	 $search = "call verifConnectionAdmin('$mail', '$mdp')";
	 $result = $this->db->conn_id->prepare($search);
	 $result->execute();

	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 
	 return $query_result; 

 }

 // Verifie que le directeur de vente est dans la bdd
 public function verifConnectionDirecteurVente($mail, $mdp)
 {
	 $search = "call verifConnectionDirecteurVente('$mail', '$mdp')";
	 $result = $this->db->conn_id->prepare($search);
	 $result->execute();

	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 
	 return $query_result; 

 }
public function insertAcheteur($mailAch, $loginAch, $pwdAch, $raisonSocialEntrepriseAchAch, $numRueAcheteurnumRueAcheteur, $nomRueAcheteur, $codePostalAch, $villeAch, $numHabilitationAch)
 {

	 $search = "call insertAcheteur(:mailAch, :loginAch, :pwdAch, :raisonSocialEntrepriseAchAch, :numRueAcheteurnumRueAcheteur, :nomRueAcheteur, :codePostalAch, :villeAch, :numHabilitationAch)";
	 $result = $this->db->conn_id->prepare($search);

	 $result->bindParam(':mailAch', $mailAch, PDO::PARAM_STR);
	 $result->bindParam(':loginAch', $loginAch, PDO::PARAM_STR);
	 $result->bindParam(':pwdAch', $pwdAch, PDO::PARAM_STR);
	 $result->bindParam(':raisonSocialEntrepriseAchAch', $raisonSocialEntrepriseAchAch, PDO::PARAM_STR);
	 $result->bindParam(':numRueAcheteurnumRueAcheteur', $numRueAcheteurnumRueAcheteur, PDO::PARAM_STR);
	 $result->bindParam(':nomRueAcheteur', $nomRueAcheteur, PDO::PARAM_STR);
	 $result->bindParam(':codePostalAch', $codePostalAch, PDO::PARAM_STR);
	 $result->bindParam(':villeAch', $villeAch, PDO::PARAM_STR);
	 $result->bindParam(':numHabilitationAch', $numHabilitationAch, PDO::PARAM_STR);
	 $result->execute();

	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 
	 return $query_result; 

}

// ancienne, marche pas
// public function afficheMailExistant($mailAch)
// {
// 	$search = "call insertAcheteur(:mailAch)";
// 	 $result = $this->db->conn_id->prepare($search);
// 	 $result->bindParam(':mailAch', $mailAch, PDO::PARAM_STR);
// 	 $result->execute();
// 	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
// 	 return $query_result; 
// 	 if($query_result->num_rows()==1)
// 	 {
// 	 	return $query_result->row();
// 	 }
// 	 else
// 	 {
// 	 	return false;
// 	 }
	 
// }


public function afficheMailExistant($mailAch)
{
	$search = "call verifExistMail(:mailAch)";
	 $result = $this->db->conn_id->prepare($search);
	 $result->bindParam(':mailAch', $mailAch, PDO::PARAM_STR);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 return $query_result;
	 
}














}