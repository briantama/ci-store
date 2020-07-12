<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportsale_model extends CI_Model{

	function ViewGetReportSale(){
		return $this->db->get('T_Sale');
	}	
}

?>