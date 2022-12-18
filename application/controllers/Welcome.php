<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * CodeIgniter est un framework qui va répondre à nos besoins
	 * commentaire fait par wassim. de rien .
	 */
	public function __construct() {
		parent::__construct();
		$this->load->database(); // on charge la base de donnée du fichier config->database
		$this->load->helper('url_helper');// Charger des fonctions de bases pour gérer les URL
		$this->load->model('lesFonctions','requetes');	// on renomme lesFonctions par requetes
		$this->load->model('utilitaire');
		$this->load->library('form_validation'); // form_validation sert à voir si on complete tout les champs d'un formulaire et voir si on respecte le champ mail
		$this->load->helper('form');	//comme form validation
		$this->load->library('session'); //mettre des messages grace à la session

	}


	public function index() //la premiere page du projet qui va être chargé "context_criee"
	{
		session_destroy();
		$this->load->view('menu');
		$this->load->view('ecranAccueil');
		$this->load->view('piedPAge');
	}

public function url($id){ // on va gerer l'url avec cette fonction

	 if($id=="inscription") // si l'id de la page est égale a inscription on va faire ce qui suis
	 {
		$this->load->view('menu'); //on charge le menu
		$this->load->view('inscription'); // on charge l'inscription
	 }
	 elseif ($id=="connexion"){  // sinon si l'url est egale a connexion on charge connexion ... un peu logique 
		$this->load->view('menu');
		$this->load->view('connexion');
	 }
	 elseif ($id == "helpAcheteur"){
		
		$this->load->view('helpAcheteur');
	 }
	 elseif($id == "profilAdmin"){
		
		$this->load->view('profilAdmin');
	 }
	 elseif($id == "profilDirecteurVente"){
		
		$this->load->view('profilDirecteurVente');
	 }
}


public function inscriptionAcheteur() 
	{
	    $this->form_validation->set_rules('mailAcheteur', '"L\'adresse email"', 'trim|required|valid_email'); //on appel la librarie de form validation pour verifier si le name de mailAcheteur est bien saisie par le client
	    $this->form_validation->set_rules('loginAcheteur', '"Le login"', 'trim|required');
	    $this->form_validation->set_rules('mdpPremierAcheteur', '"Le Mot de passe"', 'trim|required');
	    $this->form_validation->set_rules('mdpConfirmeAcheteur', '"Le Mot de passe"', 'trim|required'); 
	    $this->form_validation->set_rules('raisonSocialEntreprise', '"La raison social de l\'entreprise "', 'trim|required');
	    $this->form_validation->set_rules('villeAcheteur', '"La ville de l\'acheteur "', 'trim|required');
	    $this->form_validation->set_rules('codePostalAcheteur', '"Le code postal de l\'acheteur "', 'trim|required'); 
	    $this->form_validation->set_rules('numHabilitation', '"Le numero d\'habilitation de l\'acheteur "', 'trim|required');
	    $this->form_validation->set_rules('numRueAcheteur', '"Le numero de la rue de l\'acheteur "', 'trim|required');
	    $this->form_validation->set_rules('nomRueAcheteur', '"Le nom de la rue de l\'acheteur "', 'trim|required');

	   /*
	Supprime les espaces au début et à la fin de la chaîne
	Vérifie que la chaîne résultante n'est pas vide
	Vérifie qu'il s'agit d'une adresse e-mail valide
	*/	
		if ($this->form_validation->run() == FALSE) // on demarre la verification de tout ce qu'on a fait en haut si c'est faux elle va pas faire les insertions car il y a rien dans les champs 
		{ 
			$this->session->set_flashdata('error','Données non enregistré rien a été saisie...'); //set_flashdata appartient a codeigniter et sert à afficher des messges lors d'une action 
			redirect(base_url('inscription')); // pour se diriger vers la page inscription tout en gardant l'url de base grace a base_url
        } 
        else
		{ 

		$mailAcheteur = strip_tags($this->input->post('mailAcheteur')); // ici on recupere avec la methode post et le stip_tags sert a supprimer les balises HTML et PHP d'une chaîne pour eviter l'injection sql ou l'ajout d'une page en html du genre <p> .. ou autre

		$mdpAChiffre = strip_tags($this->input->post('mdpPremierAcheteur'));
		$mdpAcheteur = password_hash($mdpAChiffre, PASSWORD_DEFAULT); //pour crypter les mdps pour l'instant je crypte le mdp de cette variable car le jscript pas encore fait
		$loginAcheteur = strip_tags($this->input->post('loginAcheteur'));
		$raisonSocialEntrepriseAcheteur = strip_tags($this->input->post('raisonSocialEntreprise'));
		$villeAcheteur = strip_tags($this->input->post('villeAcheteur'));
		$numRueAcheteur = strip_tags($this->input->post('numRueAcheteur'));
		$nomRueAcheteur = strip_tags($this->input->post('nomRueAcheteur'));
		$codePostalAcheteur = strip_tags($this->input->post('codePostalAcheteur'));
		$numHabilitation = strip_tags($this->input->post('numHabilitation'));
		
		$utilisateurExistant = $this->requetes->afficheMailExistant($mailAcheteur); // ici on va tout de suite verifier si le mail saisie existe ou pas car c'est avec ça que les acheteurs vont se connecter..!!

		if($utilisateurExistant!=false) // puis la variable va retourner quelque chose si c'est différent de faux (raisonnement un peu inverse) elle va pas executer l'insertion car le mail existe déjà
		{
			$this->session->set_flashdata('error','Le mail est déjà existant');
			redirect(base_url('inscription'));
		}
		else
		{
			$insertionAcheteur=$this->requetes->insertAcheteur($mailAcheteur,$loginAcheteur,$mdpAcheteur,$raisonSocialEntrepriseAcheteur,$numRueAcheteur, $nomRueAcheteur, $codePostalAcheteur, $villeAcheteur, $numHabilitation);
		    //ici on va tout inserer dans la base de donnée (on le fait en une seule fois) 
			$this->session->set_flashdata('reussi','Données enregistrées, merci ! Vous pouvez désormais vous connecter'); 
			redirect(base_url('inscription'));
		}


        }	 
 	 
	}	

public function connexion()
{

$role = strip_tags($this->input->post('role'));

if($role == 'Acheteur'){
	$this->utilitaire->connexionUsers('afficheInformationConnexionAcheteur', 'Acheteur', 'login', 'mailAcheteur' , 'helpAcheteur');
}
elseif($role == 'Admin'){
	$this->utilitaire->connexionUsers('afficheInformationConnexionAdmin', 'Admin', 'login', 'mailAdmin', 'profilAdmin');
}
elseif($role == 'Directeur')
{
	$this->utilitaire->connexionUsers('afficheInformationConnexionDirecteurVente', 'Directeur', 'login', 'mailDirecteur','profilDirecteurVente');
}

}





}// pas supprimer sinon probleme