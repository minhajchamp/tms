<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends General_controller
{
	public function get($offset = 0, $data_type = 'php_array')
	{	
		$data = $this->notification->get($offset);
		if($data_type == 'json'){
			echo json_encode($data);
		}
		else{
			return $data;
		}
	}

	public function read()
	{	
		if($_POST){
			$id = $this->input->post('id');
			$this->notification->read($id);
		}
	}	
	
	public function read_by_ticket()
	{	
		if($_POST){
			$ticket_id = $this->input->post('ticket_id');
			$this->notification->read_by_ticket($ticket_id);
		}
	}	


	public function count(){
		echo json_encode($this->notification->count());
	}

}

?>
