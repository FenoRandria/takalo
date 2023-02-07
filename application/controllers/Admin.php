<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Takalo 
{
    public function addCategorie()
    {
        $result = $this->User_Admin->add_categorie($categorie_id, $categorie_name);
        $this->load->view('page/accueil', $result);
    }

    public function updateCategorie()
    {
        $result = $this->User_Admin->update_categorie($categorie_id, $categorie_name);
        $this->load->view('page/accueil', $result);
    }

    public function insertCategorie()
    {
        $result = $this->User_Admin->insert_categorie($categorie_id, $categorie_name);
        if($result == true){
            redirect('page/accueil');
        }else{
            redirect('page/index');
        }
    }
}