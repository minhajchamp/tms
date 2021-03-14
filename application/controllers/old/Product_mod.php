<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_mod extends General_controller
{
	public function __construct()
	{
		parent::__construct();	
	   $this->load->model('product_mod_model');
 		
	}
	
	public function index()
	{   
		$data['records'] = $this->product_mod_model->get_all();
		$data['view'] = 'product_module/list_product_mod';
		$this->load->view('default',$data);	
		
	}
	public function add()
	{
		$data['products'] = $this->product_mod_model->get_product_name();	
		$data['view'] = 'product_module/add_product_mod';	
		$this->load->view('default',$data);	
		
	}
	
	public function edit($id)
	{
		$data['record'] = $this->product_mod_model->show_product_mod_data($id);	
		$data['view'] = 'product_module/update_product_mod';	
		$this->load->view('default',$data);	
	}
	
	public function insert()
	{
		if(!empty($_POST))
		{
			
				$this->form_validation->set_rules('product_mod_name','Product Module Name','required|min_length[4]|max_length[30]');
				$this->form_validation->set_rules('product_mod_details','Product Module Details','required|min_length[3]|max_length[15]');
			
				if($this->form_validation->run() == FALSE)
				{ 
					$data['view'] = 'product_module/add_product_mod';
					$this->load->view('default',$data);
				
			    }
			    else
			    {
				
					$data = array(
						'product_mod_name'         => $this->input->post('product_mod_name'),
						'product_mod_details'      => $this->input->post('product_mod_details'),
						'product_id'               => $this->input->post('product_id'), 
						'product_mod_status'       => 'active',
						'product_mod_activity_by'  => $this->session->userdata('user_id')
					);
						
					$this->product_mod_model->insert($data);
					$this->session->set_flashdata('success', 'Sucessfully Inserted.');
					redirect('product_mod');
				}
		}
	}
	
	public function update($id)
	{
		if(!empty($_POST))
		{     
			
			$this->form_validation->set_rules('product_mod_name','Product Module Name','required|min_length[4]|max_length[30]');
			$this->form_validation->set_rules('product_mod_details','Product Module Details','required|min_length[3]|max_length[15]');
			
				if($this->form_validation->run() == FALSE)
				{
		
					$data['view'] = 'product_mod/update_product_mod';
					$this->load->view('default',$data);
				
			    }
			    else
			    {	
			
					$data = array(
						'product_mod_name'      => $this->input->post('product_mod_name'),
						'product_mod_details'   => $this->input->post('product_mod_details'),
						'product_mod_status'        => 'active',
						'product_mod_activity_by'   => $this->session->userdata('user_id')
						);
						
					
					$this->product_mod_model->update($data,$id);
			    	$this->session->set_flashdata('success', 'Sucessfully updated.');
					redirect('product_mod');
 				}
	    }		
			
    }
    
    public function delete($id)
    {
		$this->product_mod_model->delete($id);
		$this->session->set_flashdata('Deleted', 'Record Sucessfully Deleted.');
		redirect('product_mod');
	}
}	
