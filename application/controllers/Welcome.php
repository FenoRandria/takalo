<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		$this->load->view('login');
	}
	public function home()
	{
		$this->load->model('Objet_Model');
        $data['listobjets'] = $this->Objet_Model->get_objets();
        $data['title'] = "accueil"; 
		$data['page'] = "page/accueil"; 
		$this->load->view('page/generale',$data);
	}	

	public function listcategory()
	{
		$data['title'] = "list category"; 
		$data['page'] = "page/listcategory"; 
		$this->load->view('page/generale',$data);
	}

	public function addcategory()
	{
		$this->load->view('page/addcategory');
		$data['title'] = "add category"; 
		$data['page'] = "page/addcategory"; 
		$this->load->view('page/generale',$data);
	}	

	public function profile()
	{

        if($this->objet_model->envoye_demande_echange($this->input->get('o1'),$this->input->get('o2')));
        $data['title'] = "profile";
        $data['page'] = "page/profile";
        $data['list_demande_recu'] = $this->objet_model->list_demande_recu($this->input->get('u'));
        $data['list_demande_envoie'] = $this->objet_model->list_demande_envoie($this->input->get('u'));
        $data['listobjet'] = $this->objet_model->get_objet_utilisateur($this->input->get('u'));
        $this->load->view('page/generale',$data);

	}
}
