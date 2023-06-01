<?php
defined('BASEPATH') or exit('No direct script access allowed');

class enchereController extends CI_Controller
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

        if ($id == "enchere") {
            $data['affDeuxLotsPrecedents'] = $this->requetes->affDeuxLotsPrecedents();
            $data['affLotEnVente'] = $this->requetes->affLotEnVente();
            $data['affLotsSuivants'] = $this->requetes->affLotsSuivants();

            $this->load->view('menuAcheteur');
            $this->load->view('enchere', $data);
            $this->load->view('piedPage');
        }
    }


    public function recupePrixLotActuel()  // enchere
    {
        $idLot = strip_tags($this->input->post('idLot'));
        $idBateau = strip_tags($this->input->post('idBateau'));
        $datePeche = strip_tags($this->input->post('datePeche'));


        $data = $this->requetes->recupePrixLotActuel($idLot, $idBateau, $datePeche);
        echo json_encode($data);
    }

    public function finEnchereLot() // enchere
    {
        $idLot = strip_tags($this->input->post('idLot'));
        $idBateau = strip_tags($this->input->post('idBateau'));
        $datePeche = strip_tags($this->input->post('datePeche'));
       // $acheteurLotEnTete = strip_tags($this->input->post('acheteurLotEnTete'));
        $idAcheteurEnTete = strip_tags($this->input->post('idAcheteurEnTete'));
       // echo "<br>";

        // if ($acheteurLotEnTete == "") {
        //     $idAcheteur = null;
        // } else {
        //     $recupnumAcheteur = $this->requetes->recupNumAcheteur($acheteurLotEnTete);
        //     foreach ($recupnumAcheteur as $r) {
        //         $idAcheteur = isset($r['idAcheteur']) ? $r['idAcheteur'] : null;
        //     }
        // }

        // ! Création d'un id facture afin d'identifier chaque lot et de l'associer à un acheteur.
        $createFacture = $this->requetes->createFacture();

        // ! On récupère l' id facture qu'on vient d'insérer.
        $recuperFactureCreate = $this->requetes->recuperFactureCreate();
        foreach ($recuperFactureCreate as $r) {
            $idFacture = $r['idFacture'];
        }

        $data = $this->requetes->finEnchereLot($idLot, $idBateau, $datePeche, $idAcheteurEnTete, $idFacture, 'C');

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


    public function insertEnchere()  // enchere
    {
        $this->form_validation->set_rules('montant', '"Le montant"', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Enchère non enregistrée, veuillez réessayer');
            redirect(base_url('enchere'));
        } else {

            echo $montant = strip_tags($this->input->post('montant')); // ici on recupere le montant saisie avec la methode post et le stip_tags sert a supprimer les balises HTML et PHP d'une chaîne pour eviter l'injection sql ou l'ajout d'une page en html du genre <p> .. ou autre
echo "<br>";
            echo $idLot = strip_tags($this->input->post('idLot'));
            echo "<br>";

            echo $idBateau = strip_tags($this->input->post('idBateau'));
            echo "<br>";

            echo $datePeche = strip_tags($this->input->post('datePeche'));
            echo "<br>";

            echo $idAcheteur = strip_tags($this->input->post('idAcheteur'));
            echo "<br>";

            echo $prixDepart = strip_tags($this->input->post('prixDepart'));
            echo "<br>";

            echo $prixEnchereMax = strip_tags($this->input->post('prixEnchereMax'));
            echo "<br>";

            $data = $this->requetes->recupePrixLotActuel($idLot, $idBateau, $datePeche);
            echo "<br>";

            foreach ($data as $r) {
                // echo $dernierMontantEncheri = $r['prixEnchere'];
                echo $dernierMontantEncheri = isset($r['prixEnchere']) ? $r['prixEnchere'] : 0;
            }
            echo "<br>";

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
                // $lesLotsSuivants = $this->requetes->affLotsSuivants();
                // Extraction du premier élément du tableau renvoyé
                // $premierLot = array_shift($lesLotsSuivants);

                // Affichage des valeurs du premier lot
                // echo $premierLot['idLot'] . ' ' . $premierLot['idBateau']. ' ' . $premierLot['datePeche']. ' ' . $premierLot['nomEspece'] . ' ' . $premierLot['specification'] . ' ' . $premierLot['libellePr'] . ' ' . $premierLot['nomQualite'] . ' ' . $premierLot['(L.poidsBrutLot - BAC.tare)'] . ' ' . $premierLot['nomBateau'];

                // ! Changement du codeEtat du lot suivant de A vers B.
                // $this->requetes->finEnchereLot($premierLot['idLot'], $premierLot['idBateau'], $premierLot['datePeche'], null, null, 'C');


                $this->session->set_flashdata('succes', 'Enchère enregistrée, vous avez gagner l\'enchère.');
                redirect(base_url('enchere'));
            } elseif ($montant > $prixEnchereMax) {
                $this->session->set_flashdata('error', 'Enchère non enregistrée, montant supérieur au prix de l\'enchère maximal.');
                redirect(base_url('enchere'));
            } else {

                $insertionEnchere = $this->requetes->insertHistoriqueEnchere($idLot, $idBateau, $datePeche, $idAcheteur, $montant);
                $this->session->set_flashdata('succes', 'Enchère enregistrée, vous avez enchéri sur un lot.');
                redirect(base_url('enchere'));
            }
        }
    }
}
