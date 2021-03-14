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
		$data['view'] = 'product/list_product';
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
			
				$this->form_validation->set_rules('product_name','Product Name','required|min_length[4]|max_length[30]');
				$this->form_validation->set_rules('product_version','Product Version','required|min_length[3]|max_length[15]');
			
				if($this->form_validation->run() == FALSE)
				{
					$data['view'] = 'product/add_product';
					$this->load->view('default',$data);
				
			    }
			    else
			    {
				
					$data = array(
						'product_name'         => $this->input->post('product_name'),
						'product_version'      => $this->input->post('product_version'),
						'product_status'       => 'active',
						'product_activity_by'  => $this->session->userdata('user_id')
					);
						
					$this->product_model->insert($data);
					$this->session->set_flashdata('success', 'Sucessfully Inserted.');
					redirect('product');
				}
		}
	}
	
	public function update($id)
	{
		if(!empty($_POST))
		{     
			
			$this->form_validation->set_rules('product_name','Product Name','required|min_length[4]|max_length[30]');
			$this->form_validation->set_rules('product_version','Product Version','required|min_length[3]|max_length[15]');
			
				if($this->form_validation->run() == FALSE)
				{
		
					$data['view'] = 'product/update_product';
					$this->load->view('default',$data);
				
			    }
			    else
			    {	
			
					$data = array(
						'product_name'         => $this->input->post('product_name'),
						'product_version'      => $this->input->post('product_version'),
						'product_status'       => 'active',
						'product_activity_by'  => $this->session->userdata('user_id')
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
	}
}	
