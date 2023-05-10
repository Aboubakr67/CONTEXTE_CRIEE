<?php 
require FCPATH.'vendor\autoload.php';
class facturePdfController extends CI_Controller
{
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

    function print()
    {
        $idFacture = strip_tags($this->input->post('idFacture')); 
       
        $lesDonnees['affFactureAcheteur']=$this->requetes->affFactureAcheteur($idFacture);

		//$this->load->view('facture', $lesDonnees);
        $html = $this->load->view('facture',$lesDonnees,true);
        $mpdf = new \Mpdf\Mpdf([
            'format'=>'A4',
            'margin_top'=>0,
            'margin_right'=>0,
            'margin_left'=>0,
            'margin_bottom'=>0,
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}