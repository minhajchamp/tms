<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 $this->load->view('default/include/start');
 $this->load->view('default/include/header');  
 !empty($view)?$this->load->view('default/'.$view):'';
 $this->load->view('default/include/end');
 
 
// !empty($view)?$this->load->view('default/'.$view):'';
 
?>
