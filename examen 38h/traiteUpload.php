<?php
require('../data/connexion.php');
session_start();
$profil = $_SESSION['membres'];
$idAlbum = $_GET['idAlbum'];
echo $idAlbum;
if(isset($_FILES['photos']) && $_FILES['photos'] != null)
{
    $countfiles = count($_FILES['photos']['name']);
    $dossier = '../photo publication/';
    for ($i=0; $i < $countfiles ; $i++) 
    { 
        $fichier = basename($_FILES['photos']['name'][$i]);
        $taille_maxi = 5000000;
        $taille = filesize($_FILES['photos']['tmp_name'][$i]);

        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
        $extension = strrchr($_FILES['photos']['name'][$i], '.');
        
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
            echo $_FILES['photos']['tmp_name'][$i];
            if(move_uploaded_file($_FILES['photos']['tmp_name'][$i], $dossier . $fichier))
            {
                echo 'Upload effectué avec succès !';
                $sql = "INSERT INTO photos(photo,date_photo,id_mbp,idAlbum) VALUE ('%s',now(),%d,%d)";
                $requet = sprintf($sql,$fichier,$profil,$idAlbum);
                $donne = mysqli_query($bdd,$requet);
                header('Location:welcome.php');
            }
            else
            {
                echo 'Echec de l\'upload !';
            }
        }
        else
        {
            echo $erreur;
        }
    }
}
?>