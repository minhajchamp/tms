<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends General_controller
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('department_model');	
		$this->load->model('user_model');	
		$this->load->model('school_model');
		$this->load->model('campus_model');	
		$this->load->model('product_model');
		$this->load->model('module_model');
		$this->load->model('ticketing_model');
		$this->load->model('ticketing_media_model');
		$this->load->model('ticketing_comment_model');
		$this->load->library('encryption');
	}



	public function sendmail(){
		$section['subject'] = 'Test email';
		$section['body'] = '<strong>Testing email:</strong> <a href="asdasd">This was test email</a>';
		$body = $this->load->view('default/include/email/template',$section, TRUE);

		print_r(send_email('minhajchamp@gmail.com',$section['subject'],$body));
	}


	public function index()
	{
		$data['deptrecords'] = $this->department_model->get_all();
		$data['userrecords'] = $this->user_model->get_all();
		$data['productrecords'] = $this->product_model->get_all();
		$data['modulerecords'] = $this->module_model->get_all();
		$data['schoolrecords'] = $this->school_model->get_all();
		$data['userschoolrecords'] = $this->user_model->get_all_school_users();
		$data['campusrecords'] = $this->campus_model->get_all();
		$data['total_count'] = count($this->ticketing_model->total_count());
		$data['total_count_today'] = count($this->ticketing_model->total_count_today());
		$data['total_completed_count_today'] = count($this->ticketing_model->total_completed_count_today());		
		$data['get_dropdowns'] = $this->ticketing_model->get_dropdowns();

		$data['view'] = 'dashboard/dashboard';
		$this->load->view('default',$data);
		
	}


	public function submit_ticket(){
		if($_POST){
			$user_id = $this->userdata->user_id;
			$data = array(
				'generated_by_user_id' => $user_id,
				'ticketing_titile' => $this->input->post('ticketing_titile'),
				'preferred_user_id' => $this->input->post('preferred_user_id'),
				'generated_by_department_id' => $this->userdata->department_id,
				'assigned_to_department_id' => $this->input->post('assigned_to_department_id'),
				'school_id' => $this->input->post('school_id'),
				'campus_id' => $this->input->post('campus_id'),	
				'product_id' => $this->input->post('product_id'),	
				'module_id' => $this->input->post('module_id'),	
				'priority_id' => $this->input->post('priority_id'),	
				'user_school_id' => $this->input->post('user_school_id'),
				'ticketing_min_resolve_time' => get_db_timestamp($this->input->post('ticketing_min_resolve_time')),	
				'ticketing_max_resolve_time' => get_db_timestamp($this->input->post('ticketing_max_resolve_time')),	
				'ticketing_query' => $this->input->post('ticketing_query'),	
				'query_type_id' => $this->input->post('query_type_id'),	
				'ticketing_current_status' => 1,	
				'query_generated_by_id' => $this->input->post('query_generated_by_id'),
				'ticketing_status' => 'active'
			);

			if($this->userdata->department_id == $this->input->post('assigned_to_department_id') && $this->userdata->user_type == 'user'){
				$data['assigned_to_user_id'] = $this->input->post('preferred_user_id');
				$data['assigned_to_user_at'] = date('Y-m-d H:i:s');
				$data['assigned_by_user_id'] = $user_id;
				$data['ticketing_current_status'] = 2;
			}	 

			$last_id = $this->ticketing_model->insert($data);
			if($last_id){
				if(!empty($this->input->post('filename'))){

					$data2 = array();
					$data2['filename'] = $this->input->post('filename');
					$data2['ticketing_media_status'] = 'active';
					$data2['ticketing_id'] = $last_id;
					$data2['user_id'] = $user_id;
					$data2['file_short_url'] = random_char_gen(10);
					$this->ticketing_media_model->insert($data2);
				}

				$notification_users = $this->notification->get_notification_users_by_ticket($last_id);
				if(!empty($notification_users)){
					$notification_data = array(
						'users' => $notification_users,
						'notification_type' => 'ticket',
						'notification_text' => 'New ticket created by '.$this->userdata->user_firstname.' '.$this->userdata->user_lastname,
						'ticketing_id'		=> $last_id,
					);
					$this->notification->insert($notification_data);

					if(!empty($data['assigned_to_user_id'])){
						$notification_data = array(
							'users' => array($data['assigned_to_user_id']),
							'notification_type' => 'ticket',
							'notification_text' => 'Ticket assigned to you',
							'ticketing_id'		=> $last_id,
						);
						$this->notification->insert($notification_data);
					}

				}
						
				echo "true";
			}else{
				echo "false";
			}

		}
	}

	public function submit_ticketing_comment(){
		if($_POST){
			$user_id = $this->userdata->user_id;
			$ticketing_id = $this->input->post('ticketing_id');

			if(!empty($this->input->post('filename2'))){
				$data2 = array();
				$data2['filename'] = $this->input->post('filename2');
				$data2['ticketing_media_status'] = 'active';
				$data2['ticketing_id'] = $ticketing_id;
				$data2['user_id'] = $user_id;
				$data2['file_short_url'] = random_char_gen(10);
				$last_ticketing_media_id = $this->ticketing_media_model->insert($data2);
			}

			$data = array(
				'comments_type' => 'comment',
				'ticketing_comment_text' => $this->input->post('ticketing_comment_text'),
				'ticketing_comment_status' => 'active',
				'user_id' => $user_id,	
				'ticketing_id' => $ticketing_id
			);

			if(!empty($last_ticketing_media_id)){
				$data['ticketing_media_id'] = $last_ticketing_media_id;
			}

			$ticketing_comment_id = $this->ticketing_comment_model->insert($data);

			$ticketing_comment_data = $this->ticketing_comment_model->show_ticketing_comment_data($ticketing_comment_id);

			$notification_users = $this->notification->get_notification_users_by_ticket($ticketing_id);
			if(!empty($notification_users)){
				$notification_data = array(
					'users' => $notification_users,
					'notification_type' => 'ticketing_comment',
					'notification_text' => 'New comment by '.$this->userdata->user_firstname.' '.$this->userdata->user_lastname,
					'ticketing_id'		=> $ticketing_id,
				);
				$this->notification->insert($notification_data);	
			}

			echo json_encode($ticketing_comment_data);

		}else{
			echo "false";
		}
	}
	

	function get_tickets(){
		$data = array();
		$data['limit']  = !empty($this->input->post('limit'))?$this->input->post('limit'):10;
		$data['offset'] = !empty($this->input->post('offset'))?$this->input->post('offset'):0;
		$data['id'] = !empty($this->input->post('id'))?$this->input->post('id'):NULL;
		$data['search'] = !empty($this->input->post('search'))?$this->input->post('search'):NULL;
		$data['ticketing_current_status'] = !empty($this->input->post('ticketing_current_status'))?$this->input->post('ticketing_current_status'):NULL;

		if(!empty($this->input->post('encryption')) && $this->input->post('encryption') == true){
			$data['id'] = $this->encryption->decrypt($this->input->post('id'));
		}

		//echo $data['id'];

		$content['ticketing_data'] = $this->ticketing_model->get_all($data);
		if($this->input->post('ticketing_media')){
			$content['ticketing_media'] = $this->ticketing_media_model->get_all_by_ticket($data['id']);
		}

		if($this->input->post('ticketing_comment')){
			$content['ticketing_comment'] = $this->ticketing_comment_model->get_all_by_ticket($data['id']);
		}	

		if($this->input->post('department_users')){
			$content['department_users'] = $this->user_model->get_all_by_department_id($content['ticketing_data']->assigned_to_department_id);
		}	

		echo json_encode($content);
	}

	function ticket_assigned_to_user(){
		$assigned_to_user_id = $this->input->post('assigned_to_user_id');
		$ticketing_id = $this->input->post('ticketing_id');

		$data = array(
			'assigned_to_user_id' => $assigned_to_user_id,
			'assigned_to_user_at' => date('Y-m-d H:i:s'),
			'ticketing_current_status' => 2,
		);	

		if($this->ticketing_model->update($data,$ticketing_id)){
			if($assigned_to_user_id != $this->userdata->user_id){
				$notification_data = array(
					'users' => array($assigned_to_user_id),
					'notification_type' => 'ticket',
					'notification_text' => 'Ticket assigned to you',
					'ticketing_id'		=> $ticketing_id,
				);
				$this->notification->insert($notification_data);	
			}

			echo "true";
		}
		else{
			echo "false";
		}

	}

	function ticket_status_change(){
		$ticketing_current_status = $this->input->post('ticketing_current_status');
		$ticketing_id = $this->input->post('ticketing_id');

		$data = array(
			'ticketing_current_status' => $ticketing_current_status
		);	

		if($this->ticketing_model->update($data,$ticketing_id)){

			$notification_users = $this->notification->get_notification_users_by_ticket($ticketing_id);
			if(!empty($notification_users)){
				$notification_data = array(
					'users' => $notification_users,
					'notification_type' => 'ticket',
					'notification_text' => 'Status changed by '.$this->userdata->user_firstname.' '.$this->userdata->user_lastname,
					'ticketing_id'		=> $ticketing_id,
				);
				$this->notification->insert($notification_data);
			}	

			echo "true";
		}
		else{
			echo "false";
		}

	}


	function get_tickets_media(){
		$id = !empty($this->input->post('id'))?$this->input->post('id'):NULL;
		
		$content = $this->ticketing_media_model->get_all($id);
		echo json_encode($content);
	}



	function file_upload(){
		if($_FILES['file']['size'] > 0){
			$image = single_file_upload($_FILES['file'],'./uploads/ticket','zip|rar|png|jpg|jpeg|xls|xlsx|doc|docx|pdf|exe|mp3');
			if(is_array($image)){            
				$this->session->set_flashdata('error', $image);
			}else{
				echo $data['file'] = $image;
			}
		}
	}



	function servertime(){
		$now = new DateTime(); 
		echo $now->format("M j, Y h:i:s O")."\n"; 
	}


 	public function sendMessage(){
 		$this->notification->send_desktop_notification();
 	}	
		
}

?>
