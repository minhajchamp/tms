<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends General_controller
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('module_model');	
		$this->load->model('product_model');	
		
	}
	
	public function index($product_id = "")
	{
		$data['productsrecords'] = $this->product_model->show_product_data($product_id);
		$data['records'] = $this->module_model->get_all_by_product_id($product_id);
		$data['view'] = 'module/list';
		$this->load->view('default',$data);	
		
	}
	
	public function add($product_id = "")
	{
		$data['productsrecords'] = $this->product_model->show_product_data($product_id);	
		$data['view'] = 'module/add_module';	
		$this->load->view('default',$data);	
		
	}
	
	public function edit($id)
	{
		$data['record'] = $this->module_model->show_module_data($id);	
		$data['view'] = 'module/update_module';	
		$this->load->view('default',$data);	
	}
	
	public function insert($product_id = "")
	{
		if(!empty($_POST))
		{			

			$this->form_validation->set_rules('moduledata[]','Module Name','required|min_length[1]|max_length[100]');
			
			if($this->form_validation->run() == FALSE)
			{
				$data['view'] = 'module/add_module';
				$this->load->view('default',$data);
				
			}
			else
			{
				$data = array();

				foreach ($this->input->post('moduledata') as $module) {
					$data[] = array(
						'product_id' => $product_id,
						'module_name' => $module['module_name'],
						'module_status'          => 'active',
						'module_activity_by'     => $this->session->userdata('user_id')
					);
				}
				
				$this->module_model->insert_batch($data);
				$this->session->set_flashdata('success', 'Sucessfully Inserted.');
				redirect('module/'.$product_id);
			}
		}
	}
	
	public function update($id, $product_id = "")
	{
		if(!empty($_POST))
		{     
			
			$this->form_validation->set_rules('module_name','Module Name','required|min_length[1]|max_length[100]');
			
			if($this->form_validation->run() == FALSE)
			{
				$data['view'] = 'module/update_module';
				$this->load->view('default',$data);
				
			}
			else
			{	

				$data = array(
					'module_name' => $this->input->post('module_name'),
					'module_status'          => 'active',
					'module_activity_by'     => $this->session->userdata('user_id')
				);


				$this->module_model->update($data,$id);
				$this->session->set_flashdata('success', 'Sucessfully Updated.');
				redirect('module/'.$product_id);
			}
		}		

	}

	public function delete($id, $product_id ="")
	{
		$this->module_model->delete($id);
		$this->session->set_flashdata('Deleted', 'Record Sucessfully Deleted.');
		redirect('module/'.$product_id);
	}



	function file_upload(){
		if($_FILES['file']['size'] > 0){
			$image = single_image_upload($_FILES['file'],'./uploads/module');
			if(is_array($image)){            
				$this->session->set_flashdata('error', $image);
			}else{
				echo $data['file'] = $image;
			}
		}
	}	
}
?>
