<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
    if(isset($error))
    {
        switch($error)
        {
            case 0:
            echo '<p style="color: white">You Must fill all field!</p>';
            break;

            case 3:
            echo '<p style="color: white">This Email is already exist</p>';
            break;

            case 4:
            echo '<p style="color: white">Password not same!</p>';
            break;

            case 41:
            echo '<p style="color: white">Authentification Error</p>';
            break;

            case 51:
            echo '<p style="color: white">inscription invalide</p>';
            break;
        }
    }
    if (isset($succes)) {
        echo '<h1 style="color: green">successfully !</h1>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/all.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style1.css')?>">
    <title>Acceuil</title>
</head>
<body>
<div class="cotn_principal">
  <div class="cont_centrar">
    <div class="cont_login">
      <div class="cont_info_log_sign_up">
        <div class="col_md_login">
          <div class="cont_ba_opcitiy">
            <h2>LOGIN</h2>
            <p>Vous avez déjà un compte ?</p>
            <button class="btn_login" onclick="cambiar_login()">LOGIN</button>
          </div>
        </div>
        <div class="col_md_sign_up">
          <div class="cont_ba_opcitiy">
            <h2>SIGN UP</h2>
            <p>Rejoignez E-Takalo dès aujourd'hui.</p>
            <button class="btn_sign_up" onclick="cambiar_sign_up()">SIGN UP</button>
          </div>
        </div>
      </div>
      <div class="cont_back_info">
        <div class="cont_img_back_grey">
          <img src="<?php echo base_url('assets/img/bg.jpg'); ?>" alt="" />
        </div>
      </div>
      <div class="cont_forms">
        <div class="cont_img_back_">
          <img src="<?php echo base_url('assets/img/bg.jpg'); ?>" alt="" />
        </div>
        <form action="<?php echo base_url('user/login');?>" method="post">
            <div class="cont_form_login">
            <a href="#" onclick="ocultar_login_sign_up()"><i class="fa-solid fa-arrow-left material-icons"></i></a>
            <h2>LOGIN</h2>    
            <input type="email" placeholder="Email" name="email"  />
            <input type="password" placeholder="Password" name="password" />
            <button class="btn_login" onclick="cambiar_login()">LOGIN</button>
            </div>
        </form>
        <form action="<?php echo base_url('user/inscription');?>" method="post">
            <div class="cont_form_sign_up">
              <a href="#" onclick="ocultar_login_sign_up()"><i class="fa-solid fa-arrow-left material-icons"></i></a>
              <h2>SIGN UP</h2>
              <input type="text" placeholder="Email" name="mail" />
              <input type="text" placeholder="Username" name="name" />
              <input type="password" placeholder="Password" name="pwd" />
              <input type="password" placeholder="Confirm Password" name="confirmation"/>
              <button class="btn_sign_up" onclick="cambiar_sign_up()">SIGN UP</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
<script src="<?php echo base_url('assets/js/all.js')?>"></script>
<script src="<?php echo base_url('assets/js/login.js')?>"></script>
</html>