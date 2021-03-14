<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends General_controller
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('product_model');

	}
	
	public function index()
	{
		$data['records'] = $this->product_model->get_all();
		$data['view'] = 'product/list';
		$this->load->view('default',$data);	
		
	}
	
	public function add()
	{
		
		$data['view'] = 'product/add_product';	
		$this->load->view('default',$data);	
		
	}
	
	public function edit($id)
	{
		$data['record'] = $this->product_model->show_product_data($id);	
		$data['view'] = 'product/update_product';	
		$this->load->view('default',$data);	
	}
	
	public function insert()
	{
		if(!empty($_POST))
		{			


			$this->form_validation->set_rules('productdata[]','product Name','required|min_length[5]|max_length[100]');
			
			if($this->form_validation->run() == FALSE)
			{
				$data['view'] = 'product/add_product';
				$this->load->view('default',$data);
				
			}
			else
			{
				$data = array();

				foreach ($this->input->post('productdata') as $product) {
					$data[] = array(
						'product_name' => $product['product_name'],
						'product_version' => $product['product_version'],
						'product_logo' => $product['product_logo'],
						'product_status'          => 'active',
						'product_activity_by'     => $this->session->userdata('user_id')
					);
				}
				
				$this->product_model->insert_batch($data);
				$this->session->set_flashdata('success', 'Sucessfully Inserted.');
				redirect('product');
			}
		}
	}
	
	public function update($id)
	{
		if(!empty($_POST))
		{     
			
			$this->form_validation->set_rules('product_name','product Name','required|min_length[1]|max_length[100]');
			$this->form_validation->set_rules('product_version','Product Version','required|min_length[1]|max_length[40]');
			
			if($this->form_validation->run() == FALSE)
			{
				$data['view'] = 'product/update_product';
				$this->load->view('default',$data);
				
			}
			else
			{	

				$data = array(
					'product_name' => $this->input->post('product_name'),
					'product_version' => $this->input->post('product_version'),
					'product_logo' => $this->input->post('product_logo'),
					'product_status'          => 'active',
					'product_activity_by'     => $this->session->userdata('user_id')
				);


				$this->product_model->update($data,$id);
				$this->session->set_flashdata('success', 'Sucessfully Updated.');
				redirect('product');
			}
		}		

	}

	public function delete($id)
	{
		$this->product_model->delete($id);
		$this->session->set_flashdata('Deleted', 'Record Sucessfully Deleted.');
		redirect('product');
	}



	function file_upload(){
		if($_FILES['file']['size'] > 0){
			$image = single_image_upload($_FILES['file'],'./uploads/product');
			if(is_array($image)){            
				$this->session->set_flashdata('error', $image);
			}else{
				echo $data['file'] = $image;
			}
		}
	}	
}
?>
