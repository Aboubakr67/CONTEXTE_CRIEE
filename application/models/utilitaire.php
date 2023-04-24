<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class utilitaire extends CI_Model
{
 public function __construct()
 {
	parent::__construct();
 }

// ! Le code de base que j'ai pas toucher de (Wassim)
//  public function connexionUsers(string $path1, string $path2, string $path3, string $path4, string $path5){

public function connexionUsers(string $path1, string $path2, string $path3, string $path4, string $path5){


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
		$hashEtInformation = $this->requetes->$path1($mail); 
		
		if(!empty($hashEtInformation) && $role == $path2){ 

			foreach ($hashEtInformation as $key)
			{
				$mdpHashAch = $key['pwd'];
				$login = $key[$path3];
				$mail = $key[$path4];
			}

		
			if (password_verify($mdp, $mdpHashAch)) 
			{
				$_SESSION['login'] = $login;
				$_SESSION['mail'] = $mail;
				$_SESSION['role'] = $role;
				redirect(base_url($path5));
			} 
			else 
			{
				$this->session->set_flashdata('error','Mot de passe ou mail incorrect');
				redirect(base_url('connexion'));
			}
		} 
		else 
		{
			$this->session->set_flashdata('error','Mot de passe ou email incorrect');
			redirect(base_url('connexion'));
		}
		
	
	}


}


}
