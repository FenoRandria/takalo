<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Objet extends CI_Controller
{
    public function detailsObjet()
    {
        $this->load->model('Objet_Model');
        $result = $this->Objet_Model->detail_objet($this->input->post("email"));
        $this->load->view('page/details', $result);

    }

    // function maka liste objet olona connecte
    public function getAllObjet()
    {
        $this->load->model('Objet_Model');
        $data['listobjets'] = $this->Objet_Model->get_objets();
        $data['title'] = "accueil"; 
		$data['page'] = "page/accueil"; 
		$this->load->view('page/generale',$data);
        
    }
///////////////////////////////////////////////////////////////////
    public function echange()
    {
        $this->load->model('objet_model');
        $data['utilisateur_id'] = $this->input->get('u');
        $data['listobjets'] = $this->objet_model->get_objet_utilisateur($this->input->get('u'));
        $data['title'] = "exchange";
        $data['page'] = "page/exchange";
        $data['objet1']=$this->input->get('o1');
        $this->load->view('page/generale',$data);
    }

    public function demande()
    {
        $this->load->model('objet_model');
        if($this->objet_model->envoye_demande_echange($this->input->get('o1'),$this->input->get('o2')));
        $data['title'] = "profile";
        $data['page'] = "page/profile";
        $data['list_demande_recu'] = $this->objet_model->list_demande_recu($this->input->get('u'));
        $data['list_demande_envoie'] = $this->objet_model->list_demande_envoie($this->input->get('u'));
        $data['listobjet'] = $this->objet_model->get_objet_utilisateur($this->input->get('u'));
        $this->load->view('page/generale',$data);
    }

    public function addformulaire()
    {
        $data['title'] = "add objet";
        $data['page'] = "page/add";
        $data['utilisateur_id'] = $this->input->get('u');
        $this->load->view('page/generale',$data);
    }

   
    public function uploadImage() 
    {   
    
        $data = [];  
        
        $countcount = count($_FILES['files']['name']);  
        
        for($i=0;$i<$count;$i++){  
        
            if(!empty($_FILES['files']['name'][$i]))
            {  
                $_FILES['file']['name'] = $_FILES['files']['name'][$i];  
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];  
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];  
                $_FILES['file']['error'] = $_FILES['files']['error'][$i];  
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];  
            
                $config['upload_path'] = 'uploads/';   
                $config['allowed_types'] = 'jpg|jpeg|png|gif';  
                $config['max_size'] = '5000';  
                $config['file_name'] = $_FILES['files']['name'][$i];  
            
                $this->load->library('upload',$config);   
            
                if($this->upload->do_upload('file')){  
                    $uploadData = $this->upload->data();  
                    $filename = $uploadData['file_name'];  
            
                    $data['totalFiles'][] = $filename;  
                }  
            }  
        }  
        $this->load->view('imageUploadForm', $data);   
    }  
          

    public function add_objet()
    {
        $this->load->model('objet_model');
        $res = $this->objet_model->add_object($this->input->post('description'),$this->input->post('price'),$this->input->post('categorie'),$this->input->post('u'));
        if ($res == 0 || $res == false) {
            redirect();
        } else {
            $data['listobjets'] = $this->Objet_Model->get_objets();
            $data['title'] = "accueil"; 
            $data['page'] = "page/accueil"; 
            $this->load->view('page/generale',$data);
        }
    }

}
