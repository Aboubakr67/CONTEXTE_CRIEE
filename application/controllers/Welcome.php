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

		if ($id == "inscription") {
			$this->load->view('menu');
			$this->load->view('inscription');
			$this->load->view('piedPage');
		} elseif ($id == "connexion") {
			$this->load->view('menu');
			$this->load->view('connexion');
			$this->load->view('piedPage');
		} elseif ($id == "helpAcheteur") {
			$this->load->view('menuAcheteur');
			$leLogin = $_SESSION['login'];
			$data['numAcheteur'] = $this->requetes->recupNumAcheteur($leLogin);
			
			$this->load->view('helpAcheteur', $data);
			$this->load->view('piedPage');
		} elseif ($id == "enchere") {
			$data['affDeuxLotsPrecedents'] = $this->requetes->affDeuxLotsPrecedents();
			$data['affLotEnVente'] = $this->requetes->affLotEnVente();
			$data['affLotsSuivants'] = $this->requetes->affLotsSuivants();

			$this->load->view('menuAcheteur');
			$this->load->view('enchere', $data);
			$this->load->view('piedPage');
		} elseif ($id == "enc") {

			$data['affDeuxLotsPrecedents'] = $this->requetes->affDeuxLotsPrecedents();
			$data['affLotEnVente'] = $this->requetes->affLotEnVente();
			$data['affLotsSuivants'] = $this->requetes->affLotsSuivants();

			$this->load->view('menuAcheteur');
			$this->load->view('enc', $data);
			$this->load->view('piedPage');
		} elseif ($id == "panier") {

			$data['affPanier'] = $this->requetes->affPanier($_SESSION['login']);

			$this->load->view('menuAcheteur');
			$this->load->view('panier', $data);
			$this->load->view('piedPage');
		} elseif ($id == "liste_lots_admin") {
			$this->load->view('menuAdmin');
			$data['idAdmin'] = $this->requetes->recupNumAdmin($_SESSION['login']);
			$data['affToutLots'] = $this->requetes->affToutLesLots();
			$this->load->view('liste_lots_admin', $data);
		} elseif ($id == "ajoutLot") {

			$this->load->view('menuAdmin');
			$lesDonnees['nomEspece'] = $this->requetes->afficheToutEspece(); //pour envoyer plusieurs variables à une page on doit les mettres dans les [] et dans la prochaine page
			$lesDonnees['taille'] = $this->requetes->afficheTaille(); // elles seront sous la forme d'une variable par exemple 
			$lesDonnees['qualite'] = $this->requetes->afficheQualite();
			$lesDonnees['presentation'] = $this->requetes->affichePresentation();
			$lesDonnees['bateau'] = $this->requetes->afficheBateau();
			$lesDonnees['idAdmin'] = $this->requetes->recupNumAdmin($_SESSION['login']);



			$this->load->view('ajoutLot', $lesDonnees); // $lesDonnes aura deux variables //$nomEspece et $taille
			$this->load->view('piedPage'); // il faut biensur faire un foreach pour les parcouris héhé :) !!!!!!!! de rien les amis !!!
		} elseif ($id == "profilAdmin") {
			$this->load->view('menuAdmin');
			$data['idAdmin'] = $this->requetes->recupNumAdmin($_SESSION['login']);
			$this->load->view('profilAdmin', $data);
			$this->load->view('piedPage');
		} elseif ($id == "gestionAcheteur") {
			$this->load->view('menuAdmin');
			$lesDonnees['ToutLesAcheteurs'] = $this->requetes->affToutLesAcheteurs();
			$lesDonnees['idAdmin'] = $this->requetes->recupNumAdmin($_SESSION['login']);

			$this->load->view('gestionAcheteur', $lesDonnees);
			$this->load->view('piedPage');
		} elseif ($id == "modifieLot") {
			$this->load->view('menuAdmin');

			$lesDonnees['ToutEspece'] = $this->requetes->afficheToutEspece(); //pour envoyer plusieurs variables à une page on doit les mettres dans les [] et dans la prochaine page
			$lesDonnees['taille'] = $this->requetes->afficheTaille(); // elles seront sous la forme d'une variable par exemple 
			$lesDonnees['qualite'] = $this->requetes->afficheQualite();
			$lesDonnees['presentation'] = $this->requetes->affichePresentation();
			$lesDonnees['bateau'] = $this->requetes->afficheBateau();
			$lesDonnees['ToutLesAcheteurs'] = $this->requetes->afficheToutLesAcheteurs();
			$lesDonnees['affToutLesBac'] = $this->requetes->affToutLesBac();
			$lesDonnees['idAdmin'] = $this->requetes->recupNumAdmin($_SESSION['login']);

			$this->load->view('profilAdmin');
			$this->load->view('piedPage');
		} elseif ($id == "profilDirecteurVente") {

			$this->load->view('profilDirecteurVente');
			$this->load->view('piedPage');
		} elseif ($id == "listeLots") {
			$data['affLot'] = $this->requetes->affToutLesLots();
			$data['idAdmin'] = $this->requetes->recupNumAdmin($_SESSION['login']);
			$this->load->view('affLots', $data);
			$this->load->view('piedPage');
		} elseif ($id == "envoieLot") {
			$data['affLot'] = $this->requetes->affToutLesLots();

			$this->load->view('affLots', $data);
			$this->load->view('piedPage');
		} elseif ($id == "envoieLot") {
			$date = date('Y-m-d');
			$data['affLot'] = $this->requetes->affLotCodeADirecteurVente($date);
			$data['heuresUtilisees'] = $this->requetes->affHeureJourBloquee($date);
			$this->load->view('envoieLot', $data);
			$this->load->view('piedPage');
		} elseif ($id == "erreur") {
			$this->load->view('erreur');
		} elseif ($id == "deconnexion") {
			$this->session->sess_destroy();
			$this->session->set_flashdata('logout_message', 'Vous êtes maintenant déconnecté.');
			redirect('');
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

	public function recupePrixLotActuel()
	{
		$idLot = strip_tags($this->input->post('idLot'));
		$idBateau = strip_tags($this->input->post('idBateau'));
		$datePeche = strip_tags($this->input->post('datePeche'));
		

		$data = $this->requetes->recupePrixLotActuel($idLot, $idBateau, $datePeche);
		echo json_encode($data);
	}

	public function finEnchereLot()
	{
		$idLot = strip_tags($this->input->post('idLot'));
		$idBateau = strip_tags($this->input->post('idBateau'));
		$datePeche = strip_tags($this->input->post('datePeche'));
		$acheteurLotEnTete = strip_tags($this->input->post('acheteurLotEnTete'));


		if ($acheteurLotEnTete == "") {
			$idAcheteur = null;
		} else {
			$recupnumAcheteur = $this->requetes->recupNumAcheteur($acheteurLotEnTete);
			foreach ($recupnumAcheteur as $r) {
				$idAcheteur = isset($r['idAcheteur']) ? $r['idAcheteur'] : null;
			}
		}


		// ! Création d'un id facture afin d'identifier chaque lot et de l'associer à un acheteur.
		$createFacture = $this->requetes->createFacture();

		// ! On récupère l' id facture qu'on vient d'insérer.
		$recuperFactureCreate = $this->requetes->recuperFactureCreate();
		foreach ($recuperFactureCreate as $r) {
			$idFacture = $r['idFacture'];
		}

		$data = $this->requetes->finEnchereLot($idLot, $idBateau, $datePeche, $idAcheteur, $idFacture, 'C');

		// ! On récupère les lots suivants.
		$lesLotsSuivants = $this->requetes->affLotsSuivants();
		// Extraction du premier élément du tableau renvoyé
		$premierLot = array_shift($lesLotsSuivants);

		// Affichage des valeurs du premier lot
		// echo $premierLot['idLot'] . ' ' . $premierLot['idBateau']. ' ' . $premierLot['datePeche']. ' ' . $premierLot['nomEspece'] . ' ' . $premierLot['specification'] . ' ' . $premierLot['libellePr'] . ' ' . $premierLot['nomQualite'] . ' ' . $premierLot['(L.poidsBrutLot - BAC.tare)'] . ' ' . $premierLot['nomBateau'];

		// ! Changement du codeEtat du lot suivant de A vers B.
		$this->requetes->finEnchereLot($premierLot['idLot'], $premierLot['idBateau'], $premierLot['datePeche'], null, null, 'B');

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

			//  Ici on récupère le derniere lot de la base de données
			// Puis on ajout 1 au dernier lot
			$data['recupDernierLot'] = $this->requetes->RecupDernierLot();
			$dernierLot = $data['recupDernierLot'];
			foreach ($dernierLot as $r) {
				$dernierLot = $r['valeurMax'];
			}
			$idNewLot = $dernierLot + 1;


			// $datePeche = str_replace("T", " ", $datePeche);
			// $dateEnchere = str_replace("T", " ", $dateEnchere);



			echo "IdLot : $idNewLot (Dernier lot : $dernierLot) ";
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
			echo 'id acheteur : ';
			echo "<br>";
			echo "id qualite : " . $qualite;

			$idAdmin = "";
			$recupereIdAdmin = $this->requetes->recupNumAdmin("laurent");
			foreach ($recupereIdAdmin as $key) {
				$idAdmin = $key['idAdmin'];
			}
			echo "<br>";
			echo "id admin : $idAdmin (a recuperer dans la bdd)";


			$idDirecteurVente = "";
			$recupereIdDirecteurVente = $this->requetes->recupNumDirecteurVente("Marc");
			foreach ($recupereIdDirecteurVente as $key) {
				$idDirecteurVente = $key['idDirecteur'];
			}

			echo "<br>";
			echo "id directeur : $idDirecteurVente (a recuperer dans la bdd)";

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
			$codeEtat = "A";

			$insererDatePeche = $this->requetes->insertDatePeche($bateau, $datePeche);
			$insererLot = $this->requetes->insertLot($idNewLot, $bateau, $datePeche, $nomEspece, $taille, $presentation, $idBac, $qualite, $idAdmin, $idDirecteurVente, $poidsBrut, $prixPlancher, $prixDepart, $prixEnchereMax, $dateEnchere, $codeEtat);

			$this->session->set_flashdata('succes', 'Lot ajouter, merci ! Vous pouvez consulter l\'inventaire');
			redirect(base_url('profilAdmin'));
		}
	}

	public function modifiesLotAdmin()
	{


		$this->form_validation->set_rules('nomEspece', '"Nom espece"', 'trim|required');
		$this->form_validation->set_rules('taille', '"Taille"', 'trim|required');
		$this->form_validation->set_rules('bac', '"bac"', 'trim|required');
		$this->form_validation->set_rules('poidsBrut', '"Poids brut"', 'trim|required');
		$this->form_validation->set_rules('prixPlancher', '"Prix plancher"', 'trim|required');
		$this->form_validation->set_rules('prixDepart', '"Prix depart"', 'trim|required');
		$this->form_validation->set_rules('prixEnchereMax', '"Prix enchere max"', 'trim|required');
		$this->form_validation->set_rules('dateEnchere', '"Date enchere"', 'trim|required');
		$this->form_validation->set_rules('qualite', '"Qualite"', 'trim|required');
		$this->form_validation->set_rules('presentation', '"Presentation"', 'trim|required');
		$this->form_validation->set_rules('acheteur', '"Acheteur"', 'trim|required');
		$this->form_validation->set_rules('idLot', '"idLot"', 'trim|required');
		$this->form_validation->set_rules('codeEtat', '"codeEtat"', 'trim|required');


		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Lot non modifier');
			redirect(base_url('liste_lots_admin'));
		} else {


			$idLot = strip_tags($this->input->post('idLot'));
			$nomEspece = strip_tags($this->input->post('nomEspece'));
			$taille = strip_tags($this->input->post('taille'));


			$idBac = strip_tags($this->input->post('bac'));
			$poidsBrut = strip_tags($this->input->post('poidsBrut'));


			$prixPlancher = strip_tags($this->input->post('prixPlancher'));
			$prixDepart = strip_tags($this->input->post('prixDepart'));



			$prixEnchereMax = strip_tags($this->input->post('prixEnchereMax'));
			$dateEnchere = strip_tags($this->input->post('dateEnchere'));
			$qualite = strip_tags($this->input->post('qualite'));
			$presentation = strip_tags($this->input->post('presentation'));



			$acheteur = strip_tags($this->input->post('acheteur'));
			$codeEtat = strip_tags($this->input->post('codeEtat'));




			echo "IdLot :" . $idLot;
			echo "<br>";
			echo "id espece : " . $nomEspece;
			echo "<br>";
			echo "idtaille : " . $taille;
			echo "<br>";
			echo "id presentation : " . $presentation;
			echo "<br>";
			echo "id bac : " . $idBac;
			echo "<br>";
			echo 'id acheteur : ' . $acheteur;
			echo "<br>";
			echo "id qualite : " . $qualite;



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
			echo "codeEtat : " . $codeEtat;
			echo "<br>";



			$modifieLot = $this->requetes->modifieLotAdmin(
				$idLot,
				$nomEspece,
				$taille,
				$presentation,
				$idBac,
				$acheteur,
				$qualite,
				$poidsBrut,
				$prixPlancher,
				$prixDepart,
				$prixEnchereMax,
				$dateEnchere,
				$codeEtat
			);



			$this->session->set_flashdata('succes', 'Lot modifier, merci !');
			redirect(base_url('liste_lots_admin'));
		}
	}

	public function connexion()
	{

		$role = strip_tags($this->input->post('role'));

		if ($role == 'Acheteur') {
			$this->utilitaire->connexionUsers('afficheInformationConnexionAcheteur', 'Acheteur', 'login', 'mailAcheteur', 'idAcheteur' ,'helpAcheteur');
		} elseif ($role == 'Admin') {
			$this->utilitaire->connexionUsers('afficheInformationConnexionAdmin', 'Admin', 'login', 'mailAdmin', 'idAdmin' ,'profilAdmin');
		} elseif ($role == 'Directeur') {
			$this->utilitaire->connexionUsers('afficheInformationConnexionDirecteurVente', 'Directeur', 'login', 'mailDirecteur', 'idDirecteur' ,'profilDirecteurVente');
		}
	}

	public function traitementEnvoieLots()
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
	public function insertEnchere()
	{
		$this->form_validation->set_rules('montant', '"Le montant"', 'trim|required');


		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Enchère non enregistrée, veuillez réessayer');
			redirect(base_url('enchere'));
		} else {

			echo $montant = strip_tags($this->input->post('montant')); // ici on recupere le montant saisie avec la methode post et le stip_tags sert a supprimer les balises HTML et PHP d'une chaîne pour eviter l'injection sql ou l'ajout d'une page en html du genre <p> .. ou autre

			echo $idLot = strip_tags($this->input->post('idLot'));

			echo $idBateau = strip_tags($this->input->post('idBateau'));

			echo $datePeche = strip_tags($this->input->post('datePeche'));

			echo $idAcheteur = strip_tags($this->input->post('idAcheteur'));

			echo $prixDepart = strip_tags($this->input->post('prixDepart'));

			echo $prixEnchereMax = strip_tags($this->input->post('prixEnchereMax'));

			$data = $this->requetes->recupePrixLotActuel($idLot, $idBateau, $datePeche);

			foreach ($data as $r) {
				echo $dernierMontantEncheri = $r['prixEnchere'];
			}

			if ($montant <= $dernierMontantEncheri) {
				$this->session->set_flashdata('error', 'Enchère non enregistrée, montant inférieur au prix de l\'enchère actuelle.');
				redirect(base_url('enchere'));
			} elseif ($montant < $prixDepart) {
				$this->session->set_flashdata('error', 'Enchère non enregistrée, montant inférieur au prix de départ.');
				redirect(base_url('enchere'));
			} elseif ($montant == $prixEnchereMax) {
				// ! Insertion de l'enchere dans la table encherir et historique afin d'avoir l'historique des enchères. Ici c'est le prix max de l'enchere.
				$insertionEnchere = $this->requetes->insertHistoriqueEnchere($idLot, $idBateau, $datePeche, $idAcheteur, $montant);

				// ! Création d'un id facture afin d'identifier chaque lot et de l'associer à un acheteur.
				$createFacture = $this->requetes->createFacture();

				// ! On récupère l' id facture qu'on vient d'insérer.
				$recuperFactureCreate = $this->requetes->recuperFactureCreate();
				foreach ($recuperFactureCreate as $r) {
					$idFacture = $r['idFacture'];
				}


				$finEnchere = $this->requetes->finEnchereLot($idLot, $idBateau, $datePeche, $idAcheteur, $idFacture, 'C');

				// ! On récupère les lots suivants.
				$lesLotsSuivants = $this->requetes->affLotsSuivants();
				// Extraction du premier élément du tableau renvoyé
				$premierLot = array_shift($lesLotsSuivants);

				// Affichage des valeurs du premier lot
				// echo $premierLot['idLot'] . ' ' . $premierLot['idBateau']. ' ' . $premierLot['datePeche']. ' ' . $premierLot['nomEspece'] . ' ' . $premierLot['specification'] . ' ' . $premierLot['libellePr'] . ' ' . $premierLot['nomQualite'] . ' ' . $premierLot['(L.poidsBrutLot - BAC.tare)'] . ' ' . $premierLot['nomBateau'];

				// ! Changement du codeEtat du lot suivant de A vers B.
				$this->requetes->finEnchereLot($premierLot['idLot'], $premierLot['idBateau'], $premierLot['datePeche'], null, null, 'C');


				$this->session->set_flashdata('succes', 'Enchère enregistrée, vous avez gagner l\'enchère.');
				redirect(base_url('enchere'));
			} else if ($montant > $prixEnchereMax) {
				$this->session->set_flashdata('error', 'Enchère non enregistrée, montant supérieur au prix de l\'enchère maximal.');
				redirect(base_url('enchere'));
			} else {
				$insertionEnchere = $this->requetes->insertHistoriqueEnchere($idLot, $idBateau, $datePeche, $idAcheteur, $montant);
				$this->session->set_flashdata('succes', 'Enchère enregistrée, vous avez enchéri sur un lot.');
				redirect(base_url('enchere'));

			}
		}
	}
} //pas supprimer sinon probleme
