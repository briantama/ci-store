<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Masteritem_model extends CI_Model{

	function ViewGetMasteritem(){
		return $this->db->get('M_MasterItem');
	}	
}

?>