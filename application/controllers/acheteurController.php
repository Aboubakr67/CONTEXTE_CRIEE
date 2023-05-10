<?php
defined('BASEPATH') or exit('No direct script access allowed');

class acheteurController extends CI_Controller
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
        $this->load->model('lesFonctions', 'requetes');    // on renomme lesFonctions par requetes
        $this->load->model('utilitaire');
        $this->load->library('form_validation'); // form_validation sert à voir si on complete tout les champs d'un formulaire et voir si on respecte le champ mail
        $this->load->helper('form');    //comme form validation
        $this->load->library('session'); //mettre des messages grace à la session

    }


    public function url($id)
    { // on va gerer l'url avec cette fonction

        if ($id == "helpAcheteur") {
            $this->load->view('menuAcheteur');
            $leLogin = $_SESSION['login'];
            $data['numAcheteur'] = $this->requetes->recupNumAcheteur($leLogin);

            $this->load->view('helpAcheteur', $data);
            $this->load->view('piedPage');
        } elseif ($id == "panier") {

            $data['affPanier'] = $this->requetes->affPanier($_SESSION['login']);

            $this->load->view('menuAcheteur');
            $this->load->view('panier', $data);
            $this->load->view('piedPage');
        } elseif ($id == "liste_lots_enchere") {
            $data['affToutLesLotsAjd'] = $this->requetes->affToutLesLotsAjd();

            $this->load->view('menuAcheteur');
            $this->load->view('liste_lots_enchere', $data);
            $this->load->view('piedPage');
        }
    }

    public function deleteLotPanier()
	{
		$loginAch = $this->input->post('loginAch');
		$idLot = $this->input->post('idLot');

		// Appel à la méthode de votre modèle pour exécuter la procédure stockée
		$resultat = $this->requetes->deleteLotPanier($loginAch, $idLot);

		// Retourner le résultat sous forme de réponse JSON
		echo json_encode($resultat);
	}


	public function affPanier()
	{
		$loginAch = $this->input->post('loginAch');

		// Appel à la méthode de votre modèle pour exécuter la procédure stockée
		$resultat = $this->requetes->affPanier($loginAch);

		// Retourner le résultat sous forme de réponse JSON
		echo json_encode($resultat);
	}

	// Retourner le contenu HTML de la table


	public function verifDeleteLot()
	{
		$paramIdLot = $this->input->post('idLot');

		// Appel à la méthode de votre modèle pour exécuter la procédure stockée
		$resultat = $this->requetes->affPanier($paramIdLot);

		// Retourner le résultat sous forme de réponse JSON
		echo json_encode($resultat);
	}
}
