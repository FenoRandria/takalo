  <!--header------------>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
  <?php $this->load->view("page/header");?>
  <!--header-------------->
  <!-- Page Content -->
    <?php $this->load->view($page);?>
  <!-- /.container -->
  <!-- Footer -->
    <?php $this->load->view("page/footer");?>
  <!-----Footer->
