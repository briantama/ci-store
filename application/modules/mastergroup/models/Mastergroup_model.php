<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mastergroup_model extends CI_Model{

	function ViewGetMastergroup(){
		return $this->db->get('M_MasterGroup');
	}	
}

?>