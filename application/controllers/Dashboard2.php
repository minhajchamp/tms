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
		$data['campusrecords'] = $this->campus_model->get_all();
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
				'priority' => $this->input->post('priority'),	
				'ticketing_min_resolve_time' => $this->input->post('ticketing_min_resolve_time'),	
				'ticketing_max_resolve_time' => $this->input->post('ticketing_max_resolve_time'),	
				'ticketing_query' => $this->input->post('ticketing_query'),	
				'ticketing_query_type' => $this->input->post('ticketing_query_type'),	
				'ticketing_current_status' => 'pending',	
				'query_generated_by' => $this->input->post('query_generated_by'),
				'ticketing_status' => 'active'
			);

			if($this->userdata->department_id == $this->input->post('assigned_to_department_id') && $this->userdata->user_type == 'user'){
				$data['assigned_to_user_id'] = $this->input->post('preferred_user_id');
				$data['assigned_by_user_id'] = $user_id;
				$data['ticketing_current_status'] = 'in_proccess';
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

				if(!empty($data['assigned_to_user_id'])){
					$notification_data = array(
						'users' => array($data['assigned_to_user_id']),
						'notification_type' => 'ticket',
						'notification_text' => 'Ticket assigned to you',
						'ticketing_id'		=> $last_id,
					);
					$this->notification->insert($notification_data);		
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
			
			//$ticketing_comment_data = $this->ticketing_comment_model->get_all_by_ticket($ticketing_id);
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


	function get_tickets_media(){
		$id = !empty($this->input->post('id'))?$this->input->post('id'):NULL;
		
		$content = $this->ticketing_media_model->get_all($id);
		echo json_encode($content);
	}



	function file_upload(){
		if($_FILES['file']['size'] > 0){
			$image = single_file_upload($_FILES['file'],'./uploads/ticket','zip|rar|png|jpg|jpeg|xls|xlsx|doc|docx|pdf|exe');
			if(is_array($image)){            
				$this->session->set_flashdata('error', $image);
			}else{
				echo $data['file'] = $image;
			}
		}
	}		
}

?>
