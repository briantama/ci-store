<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale_model extends CI_Model{

	function ViewGetSale(){
		return $this->db->get('T_Sale');
	}	
}

?>