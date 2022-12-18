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
		$this->load->library('form_validation'); // mettre des messages grace à la session et form_validation sert à voir si on complete tout les champs d'un formulaire et voir si on respecte le champ mail
		$this->load->helper('form');	
		$this->load->library('session');

	}


	public function index()
	{

		$this->load->view('menu');
		$data['result']=$this->requetes->affToutLesLots();
		$this->load->view('ecranAccueil',$data);

		$this->load->view('piedPAge');
	}

public function url($id){

	 if($id=="inscription")
	 {
		$this->load->view('menu');
		$this->load->view('inscription');
		$this->load->view('piedPAge');
	 }
	 elseif ($id=="connexion"){
		$this->load->view('menu');
		$this->load->view('connexion');
		$this->load->view('piedPAge');
	 }
	 elseif ($id=="helpAcheteur"){
		$this->load->view('menu');
		$this->load->view('helpAcheteur');
		$this->load->view('piedPAge');
	 }
	 elseif ($id=="ajoutLot"){
		$this->load->view('menu');
		$data['nomEspece']=$this->requetes->afficheNomCommunEspece();
		$this->load->view('ajoutLot', $data);
		$this->load->view('piedPAge');
	 }
	 
}


public function inscriptionAcheteur() 
	{
	//    $this->form_validation->set_rules('mailAcheteur', '"L\'adresse email"', 'trim|required|valid_email');//|xss_clean');//is_unique[users.email]
	   $this->form_validation->set_rules('loginAcheteur', '"Le login"', 'trim|required');//|xss_clean');//is_unique[users.email]  
	//    $this->form_validation->set_rules('mdpPremierAcheteur', '"Le Mot de passe"', 'trim|required');//|xss_clean');//is_unique[users.email]  
	//    $this->form_validation->set_rules('mdpConfirmeAcheteur', '"Le Mot de passe"', 'trim|required');//|xss_clean');//is_unique[users.email]  
	//    $this->form_validation->set_rules('raisonSocialEntreprise', '"La raison social de l\'entreprise "', 'trim|required');//|xss_clean');//is_unique[users.email]  
	//    $this->form_validation->set_rules('villeAcheteur', '"La ville de l\'acheteur "', 'trim|required');//|xss_clean');//is_unique[users.email]  
	//    $this->form_validation->set_rules('adresseAcheteur', '"L\'adresse de l\'acheteur "', 'trim|required');//|xss_clean');//is_unique[users.email]  
	//    $this->form_validation->set_rules('codePostalAcheteur', '"Le code postal de l\'acheteur "', 'trim|required');//|xss_clean');//is_unique[users.email]  
	//    $this->form_validation->set_rules('numHabilitation', '"Le numero d\'habilitation de l\'acheteur "', 'trim|required');//|xss_clean');//is_unique[users.email]  
	//    $this->form_validation->set_rules('numRueAcheteur', '"Le numero de la rue de l\'acheteur "', 'trim|required');//|xss_clean');//is_unique[users.email]  
	//    $this->form_validation->set_rules('nomRueAcheteur', '"Le nom de la rue de l\'acheteur "', 'trim|required');//|xss_clean');//is_unique[users.email]  

	
	   /*
	Supprime les espaces au début et à la fin de la chaîne
	Vérifie que la chaîne résultante n'est pas vide
	Vérifie qu'il s'agit d'une adresse e-mail valide
	*/	

		if ($this->form_validation->run() == FALSE)
		{ 
			$this->session->set_flashdata('error','Données non enregistré');
			redirect(base_url('inscription'));
        } 
        else
		{ 

		$mailAcheteur = strip_tags($this->input->post('mailAcheteur'));

		$mdpAChiffre = strip_tags($this->input->post('mdpPremierAcheteur'));
		$mdpAcheteur = password_hash($mdpAChiffre, PASSWORD_DEFAULT); //pour crypter les mdps pour l'instant (car pas java script)

		$loginAcheteur = strip_tags($this->input->post('loginAcheteur'));
		$raisonSocialEntrepriseAcheteur = strip_tags($this->input->post('raisonSocialEntreprise'));
		$villeAcheteur = strip_tags($this->input->post('villeAcheteur'));
		$numRueAcheteur = strip_tags($this->input->post('numRueAcheteur'));
		$nomRueAcheteur = strip_tags($this->input->post('nomRueAcheteur'));
		$codePostalAcheteur = strip_tags($this->input->post('codePostalAcheteur'));
		$numHabilitation = strip_tags($this->input->post('numHabilitation'));
		//$data['resultat']=$this->requetes->setUtilisateur($nomU,$prenomU,$mdpU,$mailU,$numStatut);
		

		$mailExistant = $this->requetes->afficheMailExistant($mailAcheteur);

			// Retourne 1 si le mail existe sinon 0
			foreach ($mailExistant as $value) {
				$mailExistant = $value['verifMail'];
				
			}
			echo $mailExistant;

		if($mailExistant!=0)
		{
			$this->session->set_flashdata('error','Le mail est déjà existant');
			redirect(base_url('inscription'));
		}
		else
		{
			$insertionAcheteur=$this->requetes->insertAcheteur($mailAcheteur,$loginAcheteur,$mdpAcheteur,$raisonSocialEntrepriseAcheteur,$numRueAcheteur, $nomRueAcheteur, $codePostalAcheteur, $villeAcheteur, $numHabilitation);
			$this->session->set_flashdata('succes','Données enregistrées, merci ! Vous pouvez désormais vous connecter');
			redirect(base_url('connexion'));
		}


		// $this->session->set_flashdata('succes','Données enregistrées, merci ! Vous pouvez désormais vous connecter');
		// redirect(base_url('inscription'));
			
        }	 
	}



	public function connectionAcheteur() 
	{
	   $this->form_validation->set_rules('mailAcheteur', '"L\'adresse email"', 'trim|required|valid_email');//|xss_clean');//is_unique[users.email]
	   $this->form_validation->set_rules('mdpAcheteur', '"Le Mot de passe"', 'trim|required');//|xss_clean');//is_unique[users.email]  
	/*
	Supprime les espaces au début et à la fin de la chaîne
	Vérifie que la chaîne résultante n'est pas vide
	Vérifie qu'il s'agit d'une adresse e-mail valide
	*/	

		if ($this->form_validation->run() == FALSE)
		{ 
			$this->session->set_flashdata('error','Mot de passe et/ou mail incorrect frero');
        } 
        else
		{ 
			$mailAcheteur = strip_tags($this->input->post('mailAcheteur'));
			$mdpAcheteur = password_hash($this->input->post('mdpAcheteur'), PASSWORD_DEFAULT); //pour crypter les mdps pour l'instant (car pas java script)
			
			
			echo "<br>";
			echo $mailAcheteur;
			echo "<br>";
			echo "<br>";
			echo $mdpAcheteur;

			// $data['resultat'] = $this->requetes->verifConnectionAcheteur($mailAcheteur,$mdpAcheteur);
			// $this->session->set_flashdata('succes','Connection réussi, merci !');
			// redirect(base_url('incription'));
        }	 

	}


	public function ajouterLot() 
	{
		$this->form_validation->set_rules('NomEspece', '"Nom espece"', 'trim|required');
	   $this->form_validation->set_rules('nomCommunEspece', '"Nom commun espece"', 'trim|required');//|xss_clean');//is_unique[users.email]
	   


		if ($this->form_validation->run() == FALSE)
		{ 
			$this->session->set_flashdata('error','Lot non ajouter');
			redirect(base_url('ajoutLot'));
        } 
        else
		{ 

		$NomEspece = strip_tags($this->input->post('NomEspece'));
		$nomCommunEspece = strip_tags($this->input->post('nomCommunEspece'));

		
		echo $NomEspece;
		echo $nomCommunEspece;


			
			$this->session->set_flashdata('succes','Lot ajouter, merci ! Vous pouvez consulter l\'inventaire');
			redirect(base_url('connexion'));
		

		// $this->session->set_flashdata('succes','Données enregistrées, merci ! Vous pouvez désormais vous connecter');
		// redirect(base_url('inscription'));
			
        }	 
	}
	




}
?>