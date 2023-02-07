<?php
    require('../data/connexion.php');
    $idAlbum = (isset($_GET['idA']) && $_GET['idA'] != null ) ? $_GET['idA'] : 1;
    $sql = "select * from photoalbum where id_album = %d ";
    $sql1 = "select * from albums where id_album = %d ";
    $req = sprintf($sql,$idAlbum);
    $req1 = sprintf($sql1,$idAlbum);
    echo $req1;
    $data = mysqli_query($bdd,$req);
    $data1 = mysqli_query($bdd,$req1);
    $result1 = mysqli_fetch_assoc($data1);
    echo $req;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $result1['titreAlbum'] ?></title>
</head>
<body>
     <div class="ajoutphoto">
         <form action = "traiteUpload.php?idAlbum=<?php echo $idAlbum ?>" method = "post" enctype = "multipart/form-data">
            <p>add photo to album <input type="file" name="photos[]" id="file" multiple></p>
            <input type="submit" value="Upload">
         </form>
     </div>
    <?php
    while ($result = mysqli_fetch_assoc($data)) { ?>
        <div class="elements">
            <p>aona</p>
            <img src="../photo publication/<?php echo $result['photo'] ?>" alt="" srcset="">
        </div> 
    <?php } ?>
     
</body>
</html>