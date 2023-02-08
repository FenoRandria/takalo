<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
    public function	login()
	{
		$this->load->model('user_model');
		$this->load->model('objet_model');
		$reponse = $this->user_model->checkLogin($this->input->post("email"),$this->input->post("password"));

		if($reponse!=null)
		{
			$utilisateur['utilisateur_id'] = $reponse['utilisateur_id'];
			$this->session->set_userdata('utilisateur',$utilisateur);
			$data['title'] = "accueil"; 
			$data['page'] = "page/accueil"; 
			$data['listobjets'] = $this->objet_model->get_objets();
			$this->load->view('page/generale',$data);
		} 
		else
		{
			$data['error'] = 41;
			$this->load->view('login',$data);
		}
	}
	public function addobjet()
	{
		$data['title'] = "add objet"; 
		$data['page'] = "page/add"; 
		$data['utilisateur_id']=$this->session->userdata('utilisateur');
		var_dump($this->session->userdata());
		$this->load->view('page/generale',$data);
	}

    public function inscription()
    {
        $this->load->model('User_Model');
		if(strcmp($this->input->post('name'), "")==0 || strcmp($this->input->post('mail'), "")==0 || strcmp($this->input->post('pwd'), "")==0 || strcmp($this->input->post('confirmation'), "")==0)
		{
			$data['error'] = 0;
			$this->load->view('login',$data);
		}
		if (strcmp($this->input->post('pwd'),$this->input->post('confirmation'))!=0) {
			$data['error'] = 4;
			$this->load->view('login',$data);
		}
        $result = $this->User_Model->inscrire($this->input->post('name'),$this->input->post('mail'), $this->input->post('pwd'));
        if($result == true)
        {
			$data['succes'] = 100;
			$this->load->view('login',$data);
        }else{
            $data['error'] = 51;
			$this->load->view('login',$data);
        }
    }

    public function profil()
    {
        $pdp_photo = $_FILE['pdp_photo'];
        $result = $this->add_pdp($pdp_photo);
        $this->load->view('page/accueil', $result);
    }
}