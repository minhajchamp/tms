<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model
{
	public function insert($data)
	{
		$this->db->insert('product',$data);
	}
	
	public function get_all()
    {
	      $this->db->select('*');
	      $this->db->where('product_status','active');
          $this->db->from('product');
          $query = $this->db->get();
          $result = $query->result();
          return $result;
	 
    }
	public function update($data,$id)
	{    
		$this->db->where('product_id',$id);
		$this->db->update('product',$data);
	}
	
	public function show_product_data($id)
    {
	      $this->db->select('*');
	      $this->db->where('product_id',$id);
          $this->db->from('product');
          $query  = $this->db->get();
          $result = $query->row();
          return $result;
    }
	public function delete($id)
	{
	    $this->db->where('product_id', $id);
		$this->db->update('product',array('product_status' => 'inactive'));
	}

}
?>
