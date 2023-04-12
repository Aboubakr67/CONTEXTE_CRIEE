<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class lesFonctions extends CI_Model
{
 public function __construct()
 {
	parent::__construct();
 }


// Affiche tout les lots
public function affToutLesLots()
{
	$search = "select * from vue_lot_info";
	$result = $this->db->conn_id->prepare($search);
	$result->execute();
	$query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	return $query_result; 
}


public function affPanier($loginAch)
{
	$search = "call affPanier(:loginAch)";
	$result = $this->db->conn_id->prepare($search);
	$result->bindParam(':loginAch', $loginAch, PDO::PARAM_STR);
	$result->execute();
	$query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	return $query_result; 
}

public function deleteLotPanier($loginAch, $paramIdLot)
{
	$search = "call deleteLotPanier(:loginAch, :paramIdLot)";
	$result = $this->db->conn_id->prepare($search);
	$result->bindParam(':loginAch', $loginAch, PDO::PARAM_STR);
	$result->bindParam(':paramIdLot', $paramIdLot, PDO::PARAM_INT);
	$result->execute();
	$query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	return $query_result; 
}

public function verifDeleteLot($paramIdLot)
{
	$search = "SELECT verifDeleteLot(:paramIdLot)";
	$result = $this->db->conn_id->prepare($search);
	$result->bindParam(':paramIdLot', $paramIdLot, PDO::PARAM_INT);
	$result->execute();
	$query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	return $query_result; 
}

public function affDeuxLotsPrecedents()
{
	$search = "call affDeuxLotsPrecedents";
	$result = $this->db->conn_id->prepare($search);
	$result->execute();
	$query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	return $query_result; 
}

public function affLotEnVente()
{
	$search = "call affLotEnVente";
	$result = $this->db->conn_id->prepare($search);
	$result->execute();
	$query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	return $query_result; 
}

public function affLotsSuivants()
{
	$search = "call affLotsSuivants";
	$result = $this->db->conn_id->prepare($search);
	$result->execute();
	$query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	return $query_result; 
}

public function recupNumAcheteur($login, $mdp)
 {
    
	 $search = "call recupNumAcheteur('$login', '$mdp')";
	 $result = $this->db->conn_id->prepare($search);
	 $result->execute();

	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 
	 return $query_result; 

 }

 public function recupNumDirecteurVente($login)
 {

	 $search = "call recupNumDirecteurVente('$login')";
	 $result = $this->db->conn_id->prepare($search);
	 $result->execute();

	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 
	 return $query_result; 

 }

 public function recupNumAdmin($login)
 {

	 $search = "call recupNumAdmin('$login')";
	 $result = $this->db->conn_id->prepare($search);
	 $result->execute();

	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 
	 return $query_result; 

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

public function insertLot($idLot, $idBateau, $datePeche, $idEspece, $idTaille, $idPresentation, $idBac, $idQualite, $idAdmin, $idDirecteur, $poidsBrutLot, $prixPlancher, $prixDepart, $prixEnchereMax, $dateEnchere, $codeEtat)
 {

	 $search = "call insertLot(:idLot, :idBateau, :datePeche, :idEspece, :idTaille, :idPresentation, :idBac, :idQualite, :idAdmin, :idDirecteur, :poidsBrutLot, :prixPlancher, :prixDepart, :prixEnchereMax, :dateEnchere, :codeEtat)";
	 $result = $this->db->conn_id->prepare($search);

	 $result->bindParam(':idLot', $idLot, PDO::PARAM_INT);
	 $result->bindParam(':idBateau', $idBateau, PDO::PARAM_INT);
	 $result->bindParam(':datePeche', $datePeche, PDO::PARAM_STR);
	 $result->bindParam(':idEspece', $idEspece, PDO::PARAM_INT);
	 $result->bindParam(':idTaille', $idTaille, PDO::PARAM_INT);
	 $result->bindParam(':idPresentation', $idPresentation, PDO::PARAM_STR);
	 $result->bindParam(':idBac', $idBac, PDO::PARAM_INT);
	 $result->bindParam(':idQualite', $idQualite, PDO::PARAM_INT);
	 $result->bindParam(':idAdmin', $idAdmin, PDO::PARAM_INT);
	 $result->bindParam(':idDirecteur', $idDirecteur, PDO::PARAM_INT);
	 $result->bindParam(':poidsBrutLot', $poidsBrutLot, PDO::PARAM_STR);
	 $result->bindParam(':prixPlancher', $prixPlancher, PDO::PARAM_STR);
	 $result->bindParam(':prixDepart', $prixDepart, PDO::PARAM_STR);
	 $result->bindParam(':prixEnchereMax', $prixEnchereMax, PDO::PARAM_STR);
	 $result->bindParam(':dateEnchere', $dateEnchere, PDO::PARAM_STR);
	 $result->bindParam(':codeEtat', $codeEtat, PDO::PARAM_STR);


	 $result->execute();

	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 
	 return $query_result; 

}

public function insertDatePeche($idBateau, $datePeche)
 {

	 $search = "call insertDatePeche(:idBateau, :datePeche)";
	 $result = $this->db->conn_id->prepare($search);

	 $result->bindParam(':idBateau', $idBateau, PDO::PARAM_STR);
	 $result->bindParam(':datePeche', $datePeche, PDO::PARAM_STR);


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


public function afficheInformationConnexionAcheteur($mail){
	$search = "call afficheInformationConnexionAcheteur(:mail)";
	 $result = $this->db->conn_id->prepare($search);
	 $result->bindParam(':mail', $mail, PDO::PARAM_STR);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 return $query_result; 
	
}

public function afficheInformationConnexionAdmin($mail){
	$search = "call afficheInformationConnexionAdmin(:mail)";
	 $result = $this->db->conn_id->prepare($search);
	 $result->bindParam(':mail', $mail, PDO::PARAM_STR);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 return $query_result; 
	
}



public function afficheInformationConnexionDirecteurVente($mail){
	$search = "call afficheInformationConnexionDirecteurVente(:mail)";
	 $result = $this->db->conn_id->prepare($search);
	 $result->bindParam(':mail', $mail, PDO::PARAM_STR);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 return $query_result; 
	
}


public function afficheToutEspece()
{
	$search = "call affEspece";
	$result = $this->db->conn_id->prepare($search);
	$result->execute();
	$query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	return $query_result; 
}



public function afficheInfoEspece($esp = array())
{
	$response = array();

	if(isset($esp['idEspece']))
	{
		$espece = $esp['idEspece'];

		$search = "call affInfoEspece(:espece)";
		$result = $this->db->conn_id->prepare($search);
		$result->bindParam(':espece', $espece, PDO::PARAM_INT);
		$result->execute();
		$response = $result->fetchAll(PDO::FETCH_ASSOC);
	}

	return $response; 
}


public function afficheTaille()
{
	$search = "call affTaille";
	$result = $this->db->conn_id->prepare($search);
	$result->execute();
	$query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	return $query_result; 
}

public function afficheTare($taille = array())
{
	$response = array();
	

	if(isset($taille['idTaille']) == 1)
	{
		$idTaille = $taille['idTaille'];
		$search = "call affTare(:idTaille)";
		$result = $this->db->conn_id->prepare($search);
		$result->bindParam(':idTaille', $idTaille, PDO::PARAM_INT);
		$result->execute();
		$response = $result->fetchAll(PDO::FETCH_ASSOC);
	}
	elseif(isset($taille['idTaille']) == 2)
		{
			$idTaille = $taille['idTaille'];
			$search = "call affTare(:idTaille)";
			$result = $this->db->conn_id->prepare($search);
			$result->bindParam(':idTaille', $idTaille, PDO::PARAM_INT);
			$result->execute();
			$response = $result->fetchAll(PDO::FETCH_ASSOC);

		}
	return $response; 

}

public function afficheQualite()
{
	$search = "call affQualite";
	$result = $this->db->conn_id->prepare($search);
	$result->execute();
	$query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	return $query_result; 
}


public function affichePresentation()
{
	$search = "call affPresentation";
	$result = $this->db->conn_id->prepare($search);
	$result->execute();
	$query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	return $query_result; 
}


public function afficheBateau()
{
	$search = "call affBateau";
	$result = $this->db->conn_id->prepare($search);
	$result->execute();
	$query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	return $query_result; 
}

public function RecupDernierLot()
{
	$search = "call RecupDernierLot";
	$result = $this->db->conn_id->prepare($search);
	$result->execute();
	$query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	return $query_result; 
}





public function modifieCodeEtatLot($codeEtatForm,$idLotForm,$idBateauForm,$datePecheForm){
	$search = "call modifieCodeEtatLot(:codeEtatForm, :idLotForm, :idBateauForm, :datePecheForm)";
	$result = $this->db->conn_id->prepare($search);
	$result->bindParam(':codeEtatForm', $codeEtatForm, PDO::PARAM_STR);
	$result->bindParam(':idLotForm', $idLotForm, PDO::PARAM_STR);
	$result->bindParam(':idBateauForm', $idBateauForm, PDO::PARAM_STR);
	$result->bindParam(':datePecheForm', $datePecheForm, PDO::PARAM_STR);
	$result->execute();
	$query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	return $query_result; 
	
}

public function affLotCodeADirecteurVente($date){
	$search = "call affLotCodeADirecteurVente(:date)";
	 $result = $this->db->conn_id->prepare($search);
	 $result->bindParam(':date', $date, PDO::PARAM_STR);
	 $result->execute();
	 $query_result = $result->fetchAll(PDO::FETCH_ASSOC);
	 return $query_result; 
}


}
