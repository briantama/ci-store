<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchaseorder_model extends CI_Model{

	function ViewGetPurchaseOrder(){
		return $this->db->get('T_PurchaseOrder');
	}	
}

?>