<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url_helper');// Charger des fonctions de bases pour gérer les URL
		$this->load->model('lesFonctions','requetes');	// on renomme lesFonctions par requetes
		$this->load->library('form_validation','session'); // mettre des messages grace à la session et form_validation sert à voir si on complete tout les champs d'un formulaire et voir si on respecte le champ mail
		$this->load->helper('form');	

	}


	public function index()
	{
		$data['result']=$this->requetes->afficheDonnee();
		$data['resultat']=$this->requetes->affToutLesLots();
		$this->load->view('ecranAccueil',$data);
	}

public function formulaire($id){

	// if($id=="")
	// {

	// }
	// elseif ($id==""){
		
	// }
}

public function ABOUBAKR(){

}



}