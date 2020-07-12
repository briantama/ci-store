<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mastersupplier extends CI_Controller {

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	public function index() {
		$data=array('title'=>'Bryn Rentcar - Halaman Administrator',
					 'isi' =>'dasbor/dasbor_view'
						);
		$this->load->view('layout/wrapper',$data);	
	}


	//group widget
	function viewMastersupplier(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if(trim($uri) == "view"){
      $qry = $this->db->query("SELECT * FROM M_MasterSupplier WHERE SupplierID = '$uri1'");
      if ($qry->num_rows() > 0) {
        $res = $qry->row();
        $this->jcode($res);
      }
      else
      {
        $str["SupplierID"]     = "";
        $str["SupplierName"]   = "";
        $str["Description"]    = "";
        $str["IsActive"]       = "";
        $this->jcode($str);
      }
      exit();
    }
    //show data master supplier
    else if(trim($uri) == "view-ang"){
      $qry = $this->db->query("SELECT * FROM M_MasterSupplier");
      if ($qry->num_rows() > 0) {
        $res = $qry->result();
        $this->jcode($res);
      }
      else
      {
        $str  = "";
        $this->jcode($str);
      }
      exit();
    }
    //get number id supplier
    else if(trim($uri) == "getnumber"){
      $qry = $this->db->query("SELECT  CONCAT('SUP-',LPAD(COALESCE(MAX(RIGHT(SupplierID, 6)), '000000')+1,6,0)) AS GetID
                               FROM    M_MasterSupplier");
      if ($qry->num_rows() > 0) {
        $res = $qry->row();
        echo json_encode($res);
      }
      else{
        $str["GetID"]  = "";
        $this->jcode($str);
      }
      exit();
    }
    else if (trim($uri) == "save") {

      //post file
      $groupcd   = $jdeco->supplier_id;
      $groupnm   = $jdeco->supplier_name;
      $desc      = (empty($jdeco->desc)) ? "" : ucwords(strtolower($jdeco->desc));

      $res = $this->db->query("SELECT SupplierID FROM M_MasterSupplier WHERE SupplierID = '".$groupcd."'");
          if ($res->num_rows() == 0) {
						
            $this->db->query("INSERT INTO M_MasterSupplier
																		( SupplierID, SupplierName, Description, 
                                      IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate  ) 
															VALUES 
																		('".$groupcd."', '".$groupnm."', '".$desc."', 
                                     'Y', '".$usernm."', '".$datetm."', '".$usernm."' , '".$datetm."')	
														");
						$msg = "Save";
          }
					else {
						$this->db->query("UPDATE 	M_MasterSupplier
																			SET			SupplierName		    	  = '".$groupnm."',
                                              Description             = '".$desc."',
																							IsActive 								= 'Y',
																							LastUpdateDate      		= '".$datetm."',
																							LastUpdateBy        		= '".$usernm."'
																			WHERE 	SupplierID         			= '".$groupcd."'
														");
						$msg = "Update";
          }
        
      
      $jeson['status']   = "ok";
      $jeson['id']       = $groupcd;
      $jeson['msg']      = "Successfuly ".$msg;
      $jeson['notif']    = "Successfuly ".$msg;
      header('Content-Type: text/html');
      echo json_encode($jeson);
      exit;
    }
    else if(trim($uri) == "print"){
      $this->load->model('Mastersupplier_model');
      $data['title']        = 'Print Data Supplier';
      $data['isi']          = 'mastersupplier/Mastersupplier_print';
      $data['merkdata']     = $this->Mastersupplier_model->ViewGetMastersupplier()->result();
      $this->load->view('mastersupplier/Mastersupplier_print',$data);
    }
     else if(trim($uri) == "export"){
      $this->load->model('Mastersupplier_model');
      $data['title']        = 'Export Data Supplier';
      $data['isi']          = 'mastersupplier/Mastersupplier_export';
      $data['filenm']       = "master-supplier";
      $data['merkdata']     = $this->Mastersupplier_model->ViewGetMastersupplier()->result();
      $this->load->view('mastersupplier/Mastersupplier_export',$data);
    }
    else if (trim($uri) == "delete") {
        $this->db->query("UPDATE  M_MasterSupplier
                          SET     IsActive        = 'N',
                                  LastUpdateDate  = '".$datetm."',
                                  LastUpdateBy    = '".$usernm."' 
                          WHERE   SupplierID      = '".$uri1."'
                        ");

        $ret_arr['status']  = "ok";
        $ret_arr['caption'] = "Delete Success !!!";
        $this->jcode($ret_arr);
        exit();
    }
    else{
      $this->load->model('Mastersupplier_model');
      $data['title']        = 'Data Supplier';
      $data['isi']          = 'mastersupplier/Mastersupplier_view';
      $data['suppdata']     = $this->Mastersupplier_model->ViewGetMastersupplier()->result();
      $this->load->view('mastersupplier/Mastersupplier_view',$data);
      //$this->load->view('layout/wrapper',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }


  public function pagesecond(){
   $this->load->view('second_view'); 
  }

  public function pagethird(){
   $this->load->view('third_view'); 
  }
  

}