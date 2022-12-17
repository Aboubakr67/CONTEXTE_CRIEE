<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class utilitaire extends CI_Model
{
 public function __construct()
 {
	parent::__construct();
 }


 public function connexionUsers(string $path1, $path2, string $path3){


	$this->form_validation->set_rules('mail', '"Le mail"','trim|required|valid_email');
	$this->form_validation->set_rules('mdp', '"Le Mot de passe"', 'trim|required');
	
	if ($this->form_validation->run() == FALSE) // on demarre la verification de tout ce qu'on a fait en haut si c'est faux elle va pas faire les insertions car il y a rien dans les champs 
	{ 
		$this->session->set_flashdata('error','Saisissez les deux champs .'); //set_flashdata appartient a codeigniter et sert à afficher des messges lors d'une action 
		redirect(base_url('connexion')); // pour se diriger vers la page inscription tout en gardant l'url de base grace a base_url
	} 
	else
	{ 
		$role = strip_tags($this->input->post('role'));
		$mail = strip_tags($this->input->post('mail'));
		$mdp = strip_tags($this->input->post('mdp'));
		$hash = $this->requetes->afficheMdpHasheeAcheteur($mail);
		$hash = $this->requetes->afficheMdpHasheeAdmin($mail);
		$hash = $this->requetes->afficheMdpHashDirecteurVente($mail);
		foreach ($hash as $key)
		{
			echo $mdpHashAch = $key['pwd'];
		}
		if($role == 'Acheteur'){
			if (password_verify($mdp, $mdpHashAch)) 
			{
				redirect(base_url('helpAcheteur'));
			} 
			else 
			{
				$this->session->set_flashdata('error','Mot de passe incorrect');
				redirect(base_url('connexion'));
			}
		}
		elseif($role == 'Admin')
		{
			if (password_verify($mdp, $mdpHashAch)) 
			{
				redirect(base_url('profilAdmin'));
			} 
			else 
			{
				$this->session->set_flashdata('error','Mot de passe incorrect');
				redirect(base_url('connexion'));
			}
		}
		elseif($role == 'Directeur de vente')
		{
			if (password_verify($mdp, $mdpHashAch)) 
			{
				redirect(base_url('profilDirecteurVente'));
			} 
			else 
			{
				$this->session->set_flashdata('error','Mot de passe incorrect');
				redirect(base_url('connexion'));
			}
		}
	
	}


}




}
