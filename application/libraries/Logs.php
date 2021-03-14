<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs
{
	public function create($str = ""){

		$ci =& get_instance();	
		$ci->load->model('notification_model');		
		$user_id = $ci->session->userdata('user_id');
		$path = APPPATH.'tms_logs/';
		$file_name = date('d-m-Y').'.txt';	

		$datetime = date('d-m-Y h:i:s A');

		$file_path = $path.$file_name;

		$line_break = "\n\n"."---------------------------------------------------------------------"."\n\n";

		if(!file_exists($file_path)){
			$file = fopen($file_path,'w');
			$first_line = 'Log file created at '.$datetime;
			fwrite($file, $first_line.$line_break.$datetime.' user_id('.$user_id.') : '.$str);
		}
		else{
			$file_text = file_get_contents($file_path);
			$file = fopen($file_path,'w');
			fwrite($file, $file_text.$line_break.$datetime.' user_id('.$user_id.') : '.$str);			
		}
	}

}






