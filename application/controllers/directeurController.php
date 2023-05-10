<?php
defined('BASEPATH') or exit('No direct script access allowed');

class directeurController extends CI_Controller
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

	public function url($id)
	{ // on va gerer l'url avec cette fonction

		if ($id == "profilDirecteurVente") {

			$this->load->view('profilDirecteurVente');
			$this->load->view('piedPage');
		} elseif ($id == "listeLots") {  // directeur

			$data['affLot'] = $this->requetes->affToutLesLots();
			$data['idAdmin'] = $this->requetes->recupNumAdmin($_SESSION['login']);
			$this->load->view('affLots', $data);
			$this->load->view('piedPage');
		} elseif ($id == "envoieLot") {
			$date = date('Y-m-d');
			$data['affLot'] = $this->requetes->affLotCodeADirecteurVente($date);
			$data['heuresUtilisees'] = $this->requetes->affHeureJourBloquee($date);
			$this->load->view('envoieLot', $data);
			$this->load->view('piedPage');
		}
	}


	public function traitementEnvoieLots() // directeur
	{
		$this->form_validation->set_rules('idLot', '"Lid du Lot"', 'trim|required');
		$this->form_validation->set_rules('idBateau', '"Lid du bateau"', 'trim|required');
		$this->form_validation->set_rules('datePeche', '"Le Mot de passe"', 'trim|required');

		if ($this->form_validation->run() == FALSE) // on demarre la verification de tout ce qu'on a fait en haut si c'est faux elle va pas faire les insertions car il y a rien dans les champs 
		{
			$this->session->set_flashdata('error', 'Données non enregistré rien a été saisie...'); //set_flashdata appartient a codeigniter et sert à afficher des messges lors d'une action 
			redirect(base_url('envoieLot')); // pour se diriger vers la page inscription tout en gardant l'url de base grace a base_url
			// var_dump(password_hash("paul.marc@gmail.com", PASSWORD_DEFAULT));
		} else {
			$time = strip_tags($this->input->post('time'));
			$hTime = $time . ":00";
			$idLotForm = strip_tags($this->input->post('idLot'));
			$dateJour = strip_tags($this->input->post('dateJour'));
			$idBateauForm = strip_tags($this->input->post('idBateau'));
			$datePecheForm = strip_tags($this->input->post('datePeche'));
			$codeEtatForm = "B";
			$verificationHeure = $this->requetes->affHeureUtiliseDuJour($hTime, $dateJour);
			print_r($verificationHeure);
			foreach ($verificationHeure as $key) {
				$heureExiste = $key['verificationHeure'];
			}

			// Vérifie si l'heure existe déjà
			if ($heureExiste != 0) {
				// Si l'heure existe déjà, définit un message d'erreur et redirige vers la page 'envoieLot'
				$this->session->set_flashdata('error', 'L\'heure est déjà existante');
				redirect(base_url('envoieLot'));
			} else {
				// Si l'heure n'existe pas encore, tente de modifier le code d'état du lot dans la base de données
				$modificationDuCodeEtat = $this->requetes->modifieCodeEtatLot($hTime, $codeEtatForm, $idLotForm, $idBateauForm, $datePecheForm);
				if ($modificationDuCodeEtat === false) {
					// Si la modification du code d'état ne fonctionne pas, définit un message d'erreur et redirige vers la page 'envoieLot'
					$this->session->set_flashdata('error', 'L\'insertion ne fonctionne pas');
					redirect(base_url('envoieLot'));
				} else {
					// Si la modification du code d'état fonctionne, définit un message de réussite et redirige vers la page 'envoieLot'
					$this->session->set_flashdata('reussi', 'Données enregistrées, merci !');
					redirect(base_url('envoieLot'));
				}
			}
		}
	}
}
