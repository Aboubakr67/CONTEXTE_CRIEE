<?php
defined('BASEPATH') or exit('No direct script access allowed');

class adminController extends CI_Controller
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

        if ($id == "liste_lots_admin") {
            $this->load->view('menuAdmin');
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
            $this->load->view('piedPage');
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
            $lesDonnees['ToutLesAcheteurs'] = $this->requetes->affToutLesAcheteurs();
            $lesDonnees['affToutLesBac'] = $this->requetes->affToutLesBac();
            $lesDonnees['idAdmin'] = $this->requetes->recupNumAdmin($_SESSION['login']);

            $this->load->view('modifieLot', $lesDonnees);
            $this->load->view('piedPage');
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


    public function ajouterLot() // admin
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
}
