<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller 
{
    public function index()
	{
		$this->load->view('page/login');
	}

    public function	login()
	{
		$utilisateur_mail = $this->input->post("utilisateur_mail");
		$utilisateur_pwd = $this->input->post("utilisateur_pwd");

		$this->load->model('Model');
		if($this->Model->checkLogin($utilisateur_mail,$utilisateur_pwd))
		{
			$this->session->set_userdata('utilisateur_mail', $utilisateur_mail);
			redirect('page/accueil');
		}else{
			redirect('page/index');
		}
	}

    public function analys_login()
	{
		$utilisateur_mail = $_POST['utilisateur_mail'];
		$utilisateur_pwd = $_POST['utilisateur_pwd'];

		if(strcmp($utilisateur_mail, "")==0 ||  strcmp($utilisateur_pwd, "")==0)
		{
			header('location:login.php?error=0');
		}

		$req = "SELECT utilisateur_id FROM utilisateur WHERE utilisateur_mail='%s' AND utilisateur_pwd='%s'";
		$req = sprintf($req, $utilisateur_mail, $utilisateur_pwd);
		
		$result = mysqli_query($bdd, $req);
		$data = mysqli_fetch_assoc($result);

		if(count($data)==1)
		{
			session_start();
			$_SESSION['utilisateur_id'] = $data['utilisateur_id'];
			$_SESSION['utilisateur_utilisateur_name'] = $data['utilisateur_utilisateur_name'];
			header('location:dash/accuiel.php');

		}
		else
		{
			header('location:index.php?error=41');
		}
	}

    public function analys_inscription()
	{
		$utilisateur_name = $_GET['utilisateur_name'];
		$utilisateur_mail = $_GET['utilisateur_mail'];
		$utilisateur_pwd = $_GET['utilisateur_pwd'];
		$confirmation = $_GET['confirmation'];
	 
		count($utilisateur_pwd);
		  	
		if(strcmp($utilisateur_name, "")==0 || strcmp($utilisateur_mail, "")==0 || strcmp($utilisateur_pwd, "")==0 || strcmp($confirmation, "")==0)
		{
		   header('location:index.php?error=0');
		}
			
		//filter utilisateur_mail;
		$requete = "SELECT * FROM utilisateur WHERE utilisateur_mail LIKE '%s'";
		$requete = sprintf($requete, $utilisateur_mail);
		$result = mysqli_query($bdd, $requete);
	
		while($data = mysqli_fetch_assoc($result))
		{
			if(strcmp($data['utilisateur_mail'], $utilisateur_mail) == 0)
			{
				header('Location:index.php?error=3');
			}
		}

		//utilisateur_pwd Confirm
		if(strcmp($utilisateur_pwd, $confirmation)!=0)
		{
			header('Location:index.php?error=4');
		}
        else{
		$counter = "SELECT COUNT(*) as total FROM utilisateur";
		$count_data = mysqli_query($bdd, $counter);
		$result = mysqli_fetch_assoc($count_data);
		$request_insertion = "INSERT INTO utilisateur VALUE(%d, '%s', '%s' , '%s')";
		$request_insertion = sprintf($request_insertion, $result['total']+1, $utilisateur_name, $utilisateur_mail, $utilisateur_pwd);
	
	
		if(mysqli_query($bdd, $request_insertion))
		{
			echo "Reussi";
		}
		else
		{
			echo "Erreur!";
		}
	    }
    }

    public function inscription()
    {
        $this->load->model('User_Model');
        $result = $this->User_Model->inscrire($utilisateur_name, $utilisateur_mail, $utilisateur_pwd);
        if($result == true)
        {
            redirect('page/accueil');
        }else{
            redirect('page/index');
        }
    }


    public function profil()
    {
        $pdp_photo = $_FILE['pdp_photo'];
        $result = $this->add_pdp($pdp_photo);
        $this->load->view('page/accueil', $result);
    }
}