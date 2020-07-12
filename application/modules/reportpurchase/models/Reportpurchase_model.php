<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportpurchase_model extends CI_Model{

	function ViewGetReportPurchase(){
		return $this->db->get('T_PurchaseOrder');
	}	
}

?>