<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Setuplogo_model extends CI_Model{

	function ViewGetSetuplogo(){		
		return $this->db->get("M_Setupprofile");
	}
}

?>