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














}