<?php

defined('BASEPATH') OR exit('No direct script access allowed');

  $this->load->view('default/include/start');
  $this->load->view('default/include/header'); 
  $this->load->view('default/include/topnav');
  $this->load->view('default/include/sidenav');
  !empty($view)?$this->load->view('default/'.$view):'';
 //$this->load->view('default/dashboard/dashboard');
  $this->load->view('default/include/footer');
  $this->load->view('default/include/end');
  
 
?>
