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
            $sql = "SELECT * FROM objet where objet_utilisateur_id = %s and objet_id not in (select echange_objet_id1 from echange where echange_date_acceptation is not null) and objet_id not in (select echange_objet_id2 from echange where echange_date_acceptation is not null)";
            $sql = sprintf($sql,$this->db->escape($id));
            $query = $this->db->query($sql);
            return $query->result_array(); 
        }

        public function get_objets()
        {
            $sql = "SELECT * FROM objet where objet_id not in (select echange_objet_id1 from echange where echange_date_acceptation is not null) and objet_id not in (select echange_objet_id2 from echange where echange_date_acceptation is not null)";
            $query = $this->db->query($sql);
            return $query->result_array();
        }


        public function add_object($description,$prix,$categorie_id,$utilisateur_id)
        {
            $result = 0;
            if (isset($description) && isset($prix) && isset($categorie_id) && isset($utilisateur_id)) 
            {
                $sql1 = "INSERT into objet VALUES (NULL,%s,%s,%s,%s)";
                $sql1 = sprintf($sql1,$this->db->escape($description),$this->db->escape($prix),$this->db->escape($categorie_id),$this->db->escape($utilisateur_id));
                echo $sql1;
                $result = $this->db->query($sql1);
                $sql2 = "SELECT objet_id FROM objet WHERE objet_description = %s and objet_prix = %s and objet_categorie_id = %s and objet_utilisateur_id = %s";
                $sql2 = sprintf($sql2,$this->db->escape($description),$this->db->escape($prix),$this->db->escape($categorie_id),$this->db->escape($utilisateur_id));
                $result = $this->query($sql2);
                // foreach ($query2 as $row) {
                //     $result = $query2->result_array();
                // }
            }
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

        public function envoye_demande_echange($id_objet1,$id_objet2)
        {
            $sql = "INSERT into echange values (%s,%s,now(),null)";
            $sql = sprintf($sql,$this->db->escape($id_objet1),$this->db->escape($id_objet2));
            $query = $this->db->query($sql);
            if ($query==0) return false;
            return true;
        }
        public function list_demande_recu($id_utilisateur)
        {
            $sql = "SELECT * from objet where objet_id in (SELECT echange_objet_id1 FROM echange WHERE echange_objet_id1 in (SELECT objet_id FROM objet where objet_utilisateur_id = %s) and echange_objet_id2 is not null and echange_date_demande is not null and echange_date_acceptation is null)";
            $sql = sprintf($sql,$this->db->escape($id_utilisateur));
            $query = $this->db->query($sql);
            return $query->result_array();
        }
        public function list_demande_envoie($id_utilisateur)
        {
            $sql = "SELECT * from objet where objet_id in (SELECT echange_objet_id2 FROM echange WHERE echange_objet_id2 in (SELECT objet_id FROM objet where objet_utilisateur_id = %s) and echange_objet_id1 is not null and echange_date_demande is not null and echange_date_acceptation is null)";
            $sql = sprintf($sql,$this->db->escape($id_utilisateur));
            $query = $this->db->query($sql);
            return $query->result_array();
        }
        

        public function refus_demande_echange($obj2)
        {
            $sql = "UPDATE echange set pub_date_demande = null, change_objet_id2 = null where  change_objet_id2 = %s";
            $sql = sprintf($sql,$this->db->escape($obj2));
            
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

        public function acceptation_demande_echange($obj1,$obj2)
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