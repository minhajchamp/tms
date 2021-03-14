<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_mod_model extends CI_Model
{
	public function insert($data)
	{
		$this->db->insert('product_module',$data);
	}
	
	public function get_all()
    {
	      $this->db->select('*');
	      $this->db->where('product_mod_status','active');
          $this->db->from('product_module');
          $query = $this->db->get();
          $result = $query->result();
          return $result;
	 
    }
	public function update($data,$id)
	{    
		$this->db->where('product_mod_id',$id);
		$this->db->update('product_module',$data);
	}
	
	public function show_product_mod_data($id)
    {
	      $this->db->select('*');
	      $this->db->where('product_mod_id',$id);
          $this->db->from('product_module');
          $query  = $this->db->get();
          $result = $query->row();
          return $result;
    }
	public function delete($id)
	{
	    $this->db->where('product_mod_id', $id);
		$this->db->update('product_module',array('product_mod_status' => 'inactive'));
	}
   
   public function get_product_name()
	{
		$this->db->select('product_id,product_name');
		$this->db->from('product');
		$query = $this->db->get();
		$result = $query->result();
        return $result;
		
	}
}
?>
