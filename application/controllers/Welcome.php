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
		$this->load->view('menu');
		$this->load->view('ecranAccueil');
		$this->load->view('piedPage');
	}

	public function url($id)
	{ // on va gerer l'url avec cette fonction

		if ($id == "inscription") // si l'id de la page est égale a inscription on va faire ce qui suis
		{
			$this->load->view('menu');
			$this->load->view('inscription');
			$this->load->view('piedPage');
		} elseif ($id == "connexion") {  // sinon si l'url est egale a connexion on charge connexion ... un peu logique 
			$this->load->view('menu');
			$this->load->view('connexion');
			$this->load->view('piedPage');
		} elseif ($id == "helpAcheteur") {

			$this->load->view('helpAcheteur');
			$this->load->view('piedPage');
		} elseif ($id == "enchere") {

			$this->load->view('enchere');
			$this->load->view('piedPage');
		} elseif ($id == "ajoutLot") {
			$lesDonnees['nomEspece'] = $this->requetes->afficheToutEspece(); //pour envoyer plusieurs variables à une page on doit les mettres dans les [] et dans la prochaine page
			$lesDonnees['taille'] = $this->requetes->afficheTaille(); // elles seront sous la forme d'une variable par exemple 
			$lesDonnees['qualite'] = $this->requetes->afficheQualite();
			$lesDonnees['presentation'] = $this->requetes->affichePresentation();
			$lesDonnees['bateau'] = $this->requetes->afficheBateau();
			$this->load->view('ajoutLot', $lesDonnees); // $lesDonnes aura deux variables //$nomEspece et $taille
			$this->load->view('piedPage'); // il faut biensur faire un foreach pour les parcouris héhé :) !!!!!!!! de rien les amis !!!
		} elseif ($id == "profilAdmin") {
			$this->load->view('profilAdmin');
			$this->load->view('piedPage');
		} elseif ($id == "profilDirecteurVente") {
			$this->load->view('profilDirecteurVente');
			$this->load->view('piedPage');
		} elseif ($id == "listeLots") {
			$data['affLot'] = $this->requetes->affToutLesLots();
			$this->load->view('affLots', $data);
			$this->load->view('piedPage');
		} elseif ($id == "envoieLot") {
			$DateAndTime = date('Y-m-d');
			$data['affLot'] = $this->requetes->affLotCodeADirecteurVente($DateAndTime);
			$this->load->view('envoieLot', $data);
			$this->load->view('piedPage');
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


		if ($this->form_validation->run() == FALSE) // on demarre la verification de tout ce qu'on a fait en haut si c'est faux elle va pas faire les insertions car il y a rien dans les champs 
		{
			$this->session->set_flashdata('error', 'Données non enregistré rien a été saisie...'); //set_flashdata appartient a codeigniter et sert à afficher des messges lors d'une action 
			redirect(base_url('inscription')); // pour se diriger vers la page inscription tout en gardant l'url de base grace a base_url
			// var_dump(password_hash("paul.marc@gmail.com", PASSWORD_DEFAULT));
		} else {
			// var_dump(password_hash("paul.marc@gmail.com", PASSWORD_DEFAULT));
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
			//$data['resultat']=$this->requetes->setUtilisateur($nomU,$prenomU,$mdpU,$mailU,$numStatut);

			$utilisateurExistant = $this->requetes->afficheMailExistant($mailAcheteur); // ici on va tout de suite verifier si le mail saisie existe ou pas car c'est avec ça que les acheteurs vont se connecter..!!

			if ($utilisateurExistant != false) // puis la variable va retourner quelque chose si c'est différent de faux (raisonnement un peu inverse) elle va pas executer l'insertion car le mail existe déjà
			{
				$this->session->set_flashdata('error', 'Le mail est déjà existant');
				redirect(base_url('inscription'));
			} else {
				$insertionAcheteur = $this->requetes->insertAcheteur($mailAcheteur, $loginAcheteur, $mdpAcheteur, $raisonSocialEntrepriseAcheteur, $numRueAcheteur, $nomRueAcheteur, $codePostalAcheteur, $villeAcheteur, $numHabilitation);
				//ici on va tout inserer dans la base de donnée (on le fait en une seule fois) 
				$this->session->set_flashdata('reussi', 'Données enregistrées, merci ! Vous pouvez désormais vous connecter');
				redirect(base_url('inscription'));
			}
		}
	}

	public function especeDetails()
	{
		// POST data
		$postData = $this->input->post();

		// get data
		$data = $this->requetes->afficheInfoEspece($postData);

		echo json_encode($data);
	}


	public function affTare()
	{
		// POST data
		$postData = $this->input->post();

		// get data
		$data = $this->requetes->afficheTare($postData);

		echo json_encode($data);
	}



	public function ajouterLot()
	{
		$this->form_validation->set_rules('nomEspece', '"Nom espece"', 'trim|required');
		$this->form_validation->set_rules('taille', '"Taille"', 'trim|required');
		$this->form_validation->set_rules('idBac', '"Bac"', 'trim|required');
		$this->form_validation->set_rules('poidsBrut', '"Poids brut"', 'trim|required');
		$this->form_validation->set_rules('prixPlancher', '"Prix plancher"', 'trim|required');
		$this->form_validation->set_rules('prixDepart', '"Prix depart"', 'trim|required');
		$this->form_validation->set_rules('prixEnchereMax', '"Prix enchere max"', 'trim|required');
		$this->form_validation->set_rules('dateEnchere', '"Date enchere"', 'trim|required');
		$this->form_validation->set_rules('qualite', '"Qualite"', 'trim|required');
		$this->form_validation->set_rules('presentation', '"Presentation"', 'trim|required');
		$this->form_validation->set_rules('bateau', '"Bateau"', 'trim|required');
		$this->form_validation->set_rules('datePeche', '"Date peche"', 'trim|required');


		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Lot non ajouter');
			redirect(base_url('ajoutLot'));
		} elseif (
			$this->input->post('nomEspece') == "default" or $this->input->post('taille') == "default"
			or $this->input->post('qualite') == "default" or $this->input->post('presentation') == "default"
			or $this->input->post('bateau') == "default"
		) {

			$this->session->set_flashdata('error', 'Lot non ajouter, selectionner une valeur');
			redirect(base_url('ajoutLot'));
		} else {

			$nomEspece = strip_tags($this->input->post('nomEspece'));
			$taille = strip_tags($this->input->post('taille'));


			$idBac = strip_tags($this->input->post('idBac'));
			$poidsBrut = strip_tags($this->input->post('poidsBrut'));


			$prixPlancher = strip_tags($this->input->post('prixPlancher'));
			$prixDepart = strip_tags($this->input->post('prixDepart'));



			$prixEnchereMax = strip_tags($this->input->post('prixEnchereMax'));
			$dateEnchere = strip_tags($this->input->post('dateEnchere'));
			$qualite = strip_tags($this->input->post('qualite'));
			$presentation = strip_tags($this->input->post('presentation'));



			$bateau = strip_tags($this->input->post('bateau'));
			$datePeche = strip_tags($this->input->post('datePeche'));


			$data['recupDernierLot'] = $this->requetes->RecupDernierLot();
			$dernierLot = $data['recupDernierLot'];
			foreach ($dernierLot as $r) {
				$dernierLot = $r['valeurMax'];
			}

			echo "IdLot : (Dernier lot : $dernierLot) ";
			echo "<br>";
			echo "id bateau : " . $bateau;
			echo "<br>";
			echo "DatePeche : " . $datePeche;
			echo " -- Requete insert dans peche";
			echo "<br>";
			echo "id espece : " . $nomEspece;
			echo "<br>";
			echo "idtaille : " . $taille;
			echo "<br>";
			echo "id presentation : " . $presentation;
			echo "<br>";
			echo "id bac : " . $idBac;
			echo "<br>";
			echo 'id acheteur : ' . $_SESSION['login'];
			echo "<br>";
			echo "id qualite : " . $qualite;
			echo "<br>";
			echo "id admin : (a recuperer dans la bdd)";
			echo "<br>";
			echo "id directeur : (a recuperer dans la bdd)";
			echo "<br>";
			echo "Nom poids brut : " . $poidsBrut;
			echo "<br>";
			echo "Nom prix plancher : " . $prixPlancher;
			echo "<br>";
			echo "Nom prix depart : " . $prixDepart;
			echo "<br>";
			echo "Nom prix enchere max : " . $prixEnchereMax;
			echo "<br>";
			echo "Nom date enchere : " . $dateEnchere;
			echo "<br>";

			//$this->session->set_flashdata('succes','Lot ajouter, merci ! Vous pouvez consulter l\'inventaire');
			//redirect(base_url('connexion'));

		}
	}


	public function connexion()
	{

		$role = strip_tags($this->input->post('role'));

		if ($role == 'Acheteur') {
			$this->utilitaire->connexionUsers('afficheInformationConnexionAcheteur', 'Acheteur', 'login', 'mailAcheteur', 'helpAcheteur');
		} elseif ($role == 'Admin') {
			$this->utilitaire->connexionUsers('afficheInformationConnexionAdmin', 'Admin', 'login', 'mailAdmin', 'profilAdmin');
		} elseif ($role == 'Directeur') {
			$this->utilitaire->connexionUsers('afficheInformationConnexionDirecteurVente', 'Directeur', 'login', 'mailDirecteur', 'profilDirecteurVente');
		}
	}

	public function traitementEnvoieLots()
	{

		print_r($_POST);
		$time = strip_tags($this->input->post('time'));
		$idLotForm = strip_tags($this->input->post('idLot'));
		$idBateauForm = strip_tags($this->input->post('idBateau'));
		$datePecheForm = strip_tags($this->input->post('datePeche'));
		$codeEtatForm = "B";
		$modificationDuCodeEtat = $this->requetes->modifieCodeEtatLot($codeEtatForm,$idLotForm,$idBateauForm,$datePecheForm);

	}
} //pas supprimer sinon probleme
