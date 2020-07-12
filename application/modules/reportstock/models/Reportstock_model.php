<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportstock_model extends CI_Model{

	function ViewGetReportStock(){
		return $this->db->get('M_MasterItem');
	}	
}

?>