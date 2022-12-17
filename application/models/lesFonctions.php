<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class lesFonctions extends CI_Model
{
 public function __construct()
 {
	parent::__construct();
 }


public function afficheDonnee()
{
	$search = "SELECT lot.* FROM lot";
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


public function afficheMailExistant($mailAch)
{
	$search = "call afficheMail(:mailAch)";
	 $result = $this->db->conn_id->prepare($search);
	 $result->bindParam(':mailAch', $mailAch, PDO::PARAM_STR);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 return $query_result; 
	 if($query_result->num_rows()==1)
	 {
	 	return $query_result->row();
	 }
	 else
	 {
	 	return false;
	 }
	 
}














}