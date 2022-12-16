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
		$this->load->view('menu');
		$data['result']=$this->requetes->afficheDonnee();
		$this->load->view('ecranAccueil',$data);
		$this->load->view('piedPAge');
	}

public function url($id){

	 if($id=="inscription")
	 {
		$this->load->view('menu');
		$this->load->view('inscription');
	 }
	 elseif ($id=="connexion"){
		$this->load->view('connexion');
	 }
}


public function inscriptionAcheteur() 
	{
	   $this->form_validation->set_rules('nomAcheteur', '"Le nom"', 'trim|required');//|xss_clean');
	   $this->form_validation->set_rules('prenomAcheteur', '"Le prenom"', 'trim|required');//|xss_clean');
	   $this->form_validation->set_rules('mailAcheteur', '"L\'adresse email"', 'trim|required|valid_email');//|xss_clean');//is_unique[users.email]
	   $this->form_validation->set_rules('mdpPremierAcheteur', '"Le Mot de passe"', 'trim|required');//|xss_clean');//is_unique[users.email]  
	/*
	Supprime les espaces au début et à la fin de la chaîne
	Vérifie que la chaîne résultante n'est pas vide
	Vérifie qu'il s'agit d'une adresse e-mail valide
	*/	

		if ($this->form_validation->run() == FALSE)
		{ 
			//$this->session->set_flashdata('fail','Données non enregistré');
        } 
        else
		{ 
		$nomAcheteur = strip_tags($this->input->post('nomAcheteur'));
		$prenomAcheteur = strip_tags($this->input->post('prenomAcheteur'));
		$mailAcheteur = strip_tags($this->input->post('mailAcheteur'));
		$mdpAcheteur = password_hash($this->input->post('mdpPremierAcheteur', PASSWORD_DEFAULT)); //pour crypter les mdps pour l'instant (car pas java script)
		$loginAcheteur = strip_tags($this->input->post('loginAcheteur'));
		$raisonSocialEntrepriseAcheteur = strip_tags($this->input->post('raisonSocialEntreprise'));
		$villeAcheteur = strip_tags($this->input->post('villeAcheteur'));
		$adresseAcheteur = strip_tags($this->input->post('adresseAcheteur'));
		$codePostalAcheteur = strip_tags($this->input->post('codePostalAcheteur'));
		$numHabilitation = strip_tags($this->input->post('numHabilitation'));


		//$data['resultat']=$this->requetes->setUtilisateur($nomU,$prenomU,$mdpU,$mailU,$numStatut);
		//$this->session->set_flashdata('succes','Données enregistrées, merci ! Vous pouvez désormais vous connecter');
		//redirect(base_url('inscription'));

        }	 
 	 
	}	


}