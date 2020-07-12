<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mastersupplier_model extends CI_Model{

	function ViewGetMastersupplier(){
		return $this->db->get('M_MasterSupplier');
	}	
}

?>