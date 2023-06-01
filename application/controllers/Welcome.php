<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * CodeIgniter est un framework qui va répondre à nos besoins 
	 * commentaire fait par wassim. de rien les frères si vous arrivez pas à comprendre dmd moi.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); // on charge la base de donnée du fichier config->database
		$this->load->helper('url_helper'); // Charger des fonctions de bases pour gérer les URL
		$this->load->model('lesFonctions', 'requetes');	// on renomme lesFonctions par requetes
		$this->load->model('utilitaire');
		$this->load->library('form_validation'); // form_validation sert à voir si on complete tout les champs d'un formulaire et voir si on respecte le champ mail
		$this->load->helper('form');	//comme form validation
		$this->load->library('session'); //mettre des messages grace à la session

	}


	public function index() //la premiere page du projet qui va être chargé "context_criee"
	{
		session_destroy(); // nécessaire si la personne se déconnecte pas 
		// $this->load->view('menu');
		$this->load->view('ecranAccueil');
		$this->load->view('piedPage');
	}
	
	public function url($id)
	{ // on va gerer l'url avec cette fonction
		
		if ($id == "erreur") {
			$this->load->view('erreur');
		}
		elseif ($id == "mentions-legale") {
			$this->load->view('menu');
			$this->load->view('mentions-legale');
			$this->load->view('piedPage');
		}
	}


} //pas supprimer sinon probleme
