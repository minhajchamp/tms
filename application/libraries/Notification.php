<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification
{

	public function insert($data){
		$ci =& get_instance();		
		$ci->load->model('notification_model');		
		$user_id = $ci->session->userdata('user_id');
		
		$notification_data = array();

		foreach ($data['users'] as $assigned_user) {
			$notification_data[] = array(
				'ticketing_id' => $data['ticketing_id'],
				'notification_type' => $data['notification_type'],
				'notification_text' => $data['notification_text'],

				//HARD CODED FIELDS
				'user_id' => $assigned_user,
				'notification_activity_by' => $user_id,
				'notification_status' => 'active',
				'notification_read_status' => 'unread',
				'from_user_id' => $user_id,
			);
		}
		$ci->notification_model->insert_batch($notification_data);
		$this->send_desktop_notification($notification_data);
	}


	public function get($offset = 0,$id = ""){		
		$ci =& get_instance();				
		$ci->load->model('notification_model');

		$data = array(
			'limit' => 10,
			'offset' => $offset
		);

		if(empty($id)){
			$data['id'] = $ci->session->userdata('user_id');
		}
		else{
			$data['id'] = $id;
		}


        return $ci->notification_model->get_all($data);
	}

	public function read($id = ""){		
		$ci =& get_instance();				
		$ci->load->model('notification_model');

		$data = array(
			'notification_read_status' => 'read',
		);

        if($ci->notification_model->update($data,$id)){
        	return true;
        }
        else{
        	return false;
        }
	}

	public function read_by_ticket($ticket_id = ""){		
		$ci =& get_instance();				
		$ci->load->model('notification_model');

		$data = array(
			'notification_read_status' => 'read',
		);

        if($ci->notification_model->update_by_ticket($data,$ticket_id)){
        	return true;
        }
        else{
        	return false;
        }
	}


	public function count(){		
		$ci =& get_instance();		
		$ci->load->model('notification_model');
		$id = $ci->session->userdata('user_id');
		return $ci->notification_model->count($id)[0]->count;
	}

	public function get_notification_users_by_ticket($ticket_id = ""){		
		$ci =& get_instance();		
		$ci->load->model('notification_model');
		return $ci->notification_model->get_notification_users_by_ticket($ticket_id);
	}



	public function send_desktop_notification($notification_data =""){
		$ci =& get_instance();		
		$ci->load->library('encryption');

		if(!empty($notification_data)){
			foreach($notification_data as $notification_user){
				$content = array(
					"en" => $notification_user['notification_text']
					);
				
				$fields = array(
					'app_id' => "645c5fbe-f4c8-4438-8feb-c4e8e1b04f20",
					'filters' => array(array("field" => "tag", "key" => "user_id", "relation" => "=", "value" => $notification_user['user_id'])),
					'data' => array("foo" => "bar"),
					'contents' => $content,
					'url' => base_url('#').$ci->encryption->encrypt($notification_user['ticketing_id'])
				);
				
				$fields = json_encode($fields);
		    	//print("\nJSON sent:\n");
		    	//print($fields);
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
														   'Authorization: Basic YjBjNmY1YTMtYzJjYi00MjFiLWE2ZWMtZGVjNjU3NWJmMWFk'));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

				$response = curl_exec($ch);
				curl_close($ch);
			}
		}
	}

}






