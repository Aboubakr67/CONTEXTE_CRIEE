<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class lesFonctions extends CI_Model
{
 public function __construct()
 {
	parent::__construct();
 }

public function insertAcheteur($mailAch, $loginAch, $pwdAch, $raisonSocialeEntrepriseAch, $numRueAcheteurAch, $nomRueAcheteurAch, $codePostalAch, $villeAch, $numHabilitationAch)
 {

	 $search = "call insertAcheteur(:mailAch, :loginAch, :pwdAch, :raisonSocialeEntrepriseAch, :numRueAcheteurAch, :nomRueAcheteurAch, :codePostalAch, :villeAch, :numHabilitationAch)";
	 $result = $this->db->conn_id->prepare($search);

	 $result->bindParam(':mailAch', $mailAch, PDO::PARAM_STR);
	 $result->bindParam(':loginAch', $loginAch, PDO::PARAM_STR);
	 $result->bindParam(':pwdAch', $pwdAch, PDO::PARAM_STR);
	 $result->bindParam(':raisonSocialeEntrepriseAch', $raisonSocialeEntrepriseAch, PDO::PARAM_STR);
	 $result->bindParam(':numRueAcheteurAch', $numRueAcheteurAch, PDO::PARAM_STR);
	 $result->bindParam(':nomRueAcheteurAch', $nomRueAcheteurAch, PDO::PARAM_STR);
	 $result->bindParam(':codePostalAch', $codePostalAch, PDO::PARAM_STR);
	 $result->bindParam(':villeAch', $villeAch, PDO::PARAM_STR);
	 $result->bindParam(':numHabilitationAch', $numHabilitationAch, PDO::PARAM_STR);
	 $result->execute();

	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 
	 return $query_result; 

}


public function afficheMailExistant($mailAch)
{
	$search = "call verifExistMail(:mailAch)";
	 $result = $this->db->conn_id->prepare($search);
	 $result->bindParam(':mailAch', $mailAch, PDO::PARAM_STR);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 return $query_result; 
	 if($query_result->num_rows()==0)
	 {
	 	return $query_result->row();
	 }
	 else
	 {
	 	return true;
	 }

	 
}

public function afficheMdpHasheeAcheteur($mail){
	$search = "call afficheMdpHashAcheteur(:mail)";
	 $result = $this->db->conn_id->prepare($search);
	 $result->bindParam(':mail', $mail, PDO::PARAM_STR);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 return $query_result; 
	
}

public function afficheMdpHasheeAdmin($mail){
	$search = "call afficheMdpHashAdmin(:mail)";
	 $result = $this->db->conn_id->prepare($search);
	 $result->bindParam(':mail', $mail, PDO::PARAM_STR);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 return $query_result; 
	
}



public function afficheMdpHashDirecteurVente($mail){
	$search = "call afficheMdpHashDirecteurVente(:mail)";
	 $result = $this->db->conn_id->prepare($search);
	 $result->bindParam(':mail', $mail, PDO::PARAM_STR);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 return $query_result; 
	
}





}