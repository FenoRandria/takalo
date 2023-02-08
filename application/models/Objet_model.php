<?php
    if(! defined('BASEPATH')) exit('No direct script access allowed');
    class Objet_model extends CI_Model
    {
        public function detail_objet($id_objet)
        {
            $sql = "SELECT * FROM objet WHERE objet_id = %d";
            $sql= sprintf($sql,$this->db->escape($id_objet));
            $query = $this->db->query($sql);
            $row = $query->row_array(); 
            return $row;
        }

        public function get_objet_utilisateur($id)
        {
            $sql = "SELECT * FROM publication where pub_objet_id1 = %d and  pub_date_acceptation is null";
            $sql = sprintf($sql,$this->db->escape($id));
            $list = array();
            $query = $this->db->query($sql);
            foreach ($query->result_array() as $row); 
            {
                $list[] = $row;
            }
            return $list;
        }

        public function add_object($description,$prix,$categorie_id,$utilisateur_id)
        {
            $sql1 = "INSERT into objet VALUES (NULL,'%s',%d,%d,%d)";
            $sql1 = sprintf($sql1,$this->db->escape($description,$prix,$categorie_id,$utilisateur_id));
            $query1 = $this->db->query($sql1);
            $sql2 = "SELECT objet_id FROM WHERE objet_description = '%s' and objet_prix = %d and objet_categorie_id = '%s' and objet_utilisateur_id = %d";
            $sql2 = sprintf($sql2,$this->db->escape($description,$prix,$categorie_id,$utilisateur_id));
            $query2 = $this->query($sql2);
            $result = $query2->row_array();
            return $result;
        }

        public function add_photos_objet($photos,$objet_id)
        {

            if(isset($photos) && $photos != null)
            {
                $countfiles = count($photos['name']);
                $dossier = '../photo publication/';
                $count = 0;
                for ($i=0; $i < $countfiles ; $i++) 
                { 
                    $fichier = basename($photos['name'][$i]);
                    $taille_maxi = 3000000;
                    $taille = filesize($photos['tmp_name'][$i]);
            
                    $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                    $extension = strrchr($photos['name'][$i], '.');
                    
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
                        echo $photos['tmp_name'][$i];
                        if(move_uploaded_file($photos['tmp_name'][$i], $dossier . $fichier))
                        {
                            echo 'Upload effectué avec succès !';
                            $sql = "INSERT photobjet VALUES(null,'%s',%d)";
                            $sql = sprintf($sql,$this->db->escape($photo,$objet_id));
                            $query = $this->db->query($sql);  
                            if ($query==1) $count++;
                        }
                        else
                        {
                            echo 'Echec de l\'upload !';
                        }
                    }
                    else
                    {
                        echo $erreur;
                        return 0;
                    }
                }
            }
            return $count;
        }

        public function add_publication($id_objet)
        {
            $sql = "INSERT into publication (null,%d,NULL,NULL,NULL);";
            $sql = sprintf($sql,$this->db->escape($id_objet));
            $query = $this->db->query($sql);
            if ($query==0) return false;
            return true;
        }

        public function envoye_demande_echange($id_objet2,$pub_id)
        {
            $sql = "UPDATE publication set pub_date_demande = now(),pub_objet_id2 = %d WHERE pub_id = %d";
            $sql = sprintf($sql,$this->db->escape($id_objet2,$pub_id));
            $query = $this->db->query($sql);
            if ($query==0) return false;
            return true;
        }

        public function refus_demande_echange($pub_id)
        {
            $sql = "UPDATE publication set pub_date_demande = null, pub_objet_id2 = null WHERE pub_id = %d";
            $sql = sprintf($sql,$this->db->escape($id_objet2,$pub_id));
            $query = $this->db->query($sql);
            if ($query==0) return false;
            return true;
        }

        // public function change_proprietaire($id_utilisateur)
        // {
        //     $sql = "select * publication WHERE pub_date_acceptation is not null and (pub_objet_id1 in (select object_id from objet where objet_utilisateur_id = %d) or pub_objet_id2 in (select object_id from objet where objet_utilisateur_id = %d))";
        //     $sql = sprintf($sql,$this->db->escape($id_objet2,$pub_id));
        //     $query = $this->db->query($sql);
        //     if ($query==0) return false;
        //     return true;
        // }

        public function acceptation_demande_echange($pub_id)
        {
            $sql = "UPDATE publication set pub_date_acceptation = now() WHERE pub_id = %d";
            $sql = sprintf($sql,$this->db->escape($id_objet2,$pub_id));
            $query = $this->db->query($sql);
            if ($query==0) return false;
            return true;
        }

        public function get_echange_effectue($id_utilisateur)
        {
            $sql = "select * publication WHERE pub_date_acceptation is not null and (pub_objet_id1 in (select object_id from objet where objet_utilisateur_id = %d) or pub_objet_id2 in (select object_id from objet where objet_utilisateur_id = %d))";
            $sql = sprintf($sql,$this->db->escape($id_objet2,$pub_id));
            $query = $this->db->query($sql);
            if ($query==0) return false;
            return true;
        }
        
        



   }
?>