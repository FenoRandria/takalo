<?php
    if(! defined('BASEPATH')) exit('No direct script access allowed');
    class User_model extends CI_Model
    {
        public function checklogin($mail,$pwd)
        {
            $sql = "SELECT * from utilisateur where utilisateur_mail = %s and utilisateur_pwd = %s";
            $sql = sprintf($sql,$this->db->escape($mail),$this->db->escape($pwd));
            $query = $this->db->query($sql);
            $row = $query->row_array(); 
            return $row;
        }

        public function inscrire($mail,$name,$pwd)
        {
            $sql = "insert INTO utilisateur VALUES (null,%s,%s,%s)";
            $sql = sprintf($sql,$this->db->escape($mail),$this->db->escape($name),$this->db->escape($pwd));
            $query = $this->db->query($sql);
            if ($query == 0) 
            {
                return false;
            }
            return true;
        }
    
        public function add_pdp($photo,$id)
        {
            if(isset($photo) && $photo != null)
            {
                
                $dossier = '../photo publication/';
                
                $fichier = basename($photo['name']);
                $taille_maxi = 3000000;
                $taille = filesize($photo['tmp_name']);

                $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                $extension = strrchr($photo['name'], '.');
                
                if(!in_array($extension, $extensions)) 
                {
                    $erreur = "Vous devez uploader un fichier de type png, gif, jpg, jpeg";
                }    

                if($taille>$taille_maxi)
                {
                    $erreur = 'Le fichier est trop gros...';
                }

                if(!isset($erreur))
                {
                    $fichier = strtr($fichier,
                    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                    'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                    echo $photo['tmp_name'];
                    if(move_uploaded_file($photo['tmp_name'], $dossier . $fichier))
                    {
                        echo 'Upload effectué avec succès !';
                        $sql = "insert INTO photodeprofil VALUES(null,'%s',%d)";
                        $sql = sprintf($sql,$this->db->escape($photo),$this->db->escape($id));
                        $query = $this->db->query($sql);
                        if ($query != 0) 
                        {
                            return true;
                        }
                    }
                    else
                    {
                        echo 'Echec de l\'upload !';
                        return false;
                    }
                }
                else
                {
                    echo $erreur;
                    return $erreur;
                }
            }
        }
   }
?>