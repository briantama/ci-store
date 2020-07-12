<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Masteritem extends CI_Controller {

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	public function index() {
		$data=array('title'=>'Bryn Store - Halaman Administrator',
					 'isi' =>'dasbor/dasbor_view'
						);
		$this->load->view('layout/wrapper',$data);	
	}


	//group widget
	function viewMasteritem(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if(trim($uri) == "view"){
      $qry = $this->db->query("SELECT * FROM M_MasterItem WHERE ItemID = '$uri1'");
      if ($qry->num_rows() > 0) {
        $res = $qry->row();
        $this->jcode($res);
      }
      else{
        $str["ItemID"]      = "";
        $str["ItemName"]    = "";
        $str["GroupID"]     = "";
        $str["IsActive"]    = "";
        $this->jcode($str);
      }
      exit();
    }
    //show data master group
    else if(trim($uri) == "view-ang"){
      $qry = $this->db->query("SELECT * FROM M_MasterItem");
      if ($qry->num_rows() > 0) {
        $res = $qry->result();
        $this->jcode($res);
      }
      else{
        $str = "";
        $this->jcode($str);
      }
      exit();
    }
    //search group 
    else if(trim($uri) == "searchgroup"){
        $varbl =  $jdeco->searchText;
        if(trim($varbl))
        {
          $query = $this->db->query(" SELECT  CodeGroupID, GroupName, Description, 
                                              IsActive 
                                      FROM    M_MasterGroup
                                      WHERE   IsActive  = 'Y'
                                              AND (CodeGroupID LIKE '%".$varbl."%' OR GroupName LIKE '%".$varbl."%')
                                ");
           if ($query->num_rows() > 0) {
            $arr = $query->result();
            foreach($arr as $key){
              $data[] = ["group" => $key->CodeGroupID." - ".$key->GroupName, "keygroup" => $key->CodeGroupID, "groupame" => $key->GroupName];
            }
           }
           else{
            $data = array();
           }

           $this->jcode($data);
           exit;
        }
        else
        {
           $data = array();
           $this->jcode($data);
           exit;
        }

    }
    //get number id group
    else if(trim($uri) == "getnumber"){
      $qry = $this->db->query("SELECT  CONCAT('ITM-',LPAD(COALESCE(MAX(RIGHT(ItemID, 6)), '000000')+1,6,0)) AS GetID
                               FROM    M_MasterItem");
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
      $status    = "";
      $msg       = "";
      $file_element_name = 'photo';

      //code post 
      $itemid    = $_POST["itemid"];
      $itemnm    = $_POST["itemname"];
      $groupid   = $_POST["groupid"];
      $purprice  = $_POST["pulprice"];
      $shortitm  = $_POST["shortitem"];
      $selprice  = $_POST["selprice"];
      $stock     = $_POST["stock"];
      $desc      = $_POST["desc"];

      if ($status != "error") {
        $config['upload_path']   = './upload/item/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 1024;
        $config['encrypt_name']  = FALSE;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file_element_name)) {
          $status = 'ok';
          $msg = $this->upload->display_errors('', '');

          $res = $this->db->query("SELECT ItemID FROM M_MasterItem WHERE ItemID = '".$itemid."'");
          if ($res->num_rows() > 0) {

              $this->db->query("UPDATE  M_MasterItem
                                      SET     ItemName                = '".$itemnm."',
                                              GroupID                 = '".$groupid."',
                                              ShortItem               = '".$shortitm."',
                                              PurchasePrice           = '".$purprice."',
                                              SellingPrice            = '".$selprice."',
                                              Stock                   = '".$stock."',
                                              IsActive                = 'Y',
                                              LastUpdateDate          = '".$datetm."',
                                              LastUpdateBy            = '".$usernm."'
                                      WHERE   ItemID                  = '".$itemid."'
                              ");
          } 
          else {

            //notif save error uload image null
            $jeson['status']   = "failed";
            $jeson['msg']      = "Item Image, ".$msg;
            $jeson['focus']    = "photo";
            header('Content-Type: text/html');
            echo json_encode($jeson);
            exit;

            $this->db->query("INSERT INTO M_MasterItem
                                    ( ItemID, ItemName, GroupID, ShortItem, PurchasePrice, SellingPrice, Stock,  
                                      IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate  ) 
                              VALUES 
                                    ('".$itemid."', '".$itemnm."', '".$groupid."', '".$shortitm."', ".$purprice.",".$selprice.", ".$stock.", 
                                     'Y', '".$usernm."', '".$datetm."', '".$usernm."' , '".$datetm."')  
                            ");
          }
        } 
        else {
          $data = $this->upload->data();
          $image_path = $data['full_path'];
          if(file_exists($image_path)) {
            $status = "ok";
            $msg    = "Upload gambar berhasil";
          } else {
            $status = "ok";
            $msg    = "Terjadi kesalahan. Ulangi lagi.";
          }

          $ambil_gambar = $this->db->query("SELECT ItemImage, ItemID FROM M_MasterItem WHERE ItemID = '".$itemid."'");
          if ($ambil_gambar->num_rows() > 0) {

            $rowf = $ambil_gambar->row();
            if(trim($rowf->ItemImage) != ""){
              if(file_exists("./upload/item/".$rowf->ItemImage)){
                unlink("./upload/item/".$rowf->ItemImage);
              }
            }


            $this->db->query("UPDATE  M_MasterItem
                                      SET     ItemImage               = '".$data['file_name']."', 
                                              ItemName                = '".$itemnm."',
                                              GroupID                 = '".$groupid."',
                                              ShortItem               = '".$shortitm."',
                                              PurchasePrice           = '".$purprice."',
                                              SellingPrice            = '".$selprice."',
                                              Stock                   = '".$stock."',
                                              IsActive                = 'Y',
                                              LastUpdateDate          = '".$datetm."',
                                              LastUpdateBy            = '".$usernm."'
                                      WHERE   ItemID                  = '".$itemid."'
                            ");
          } 
          else {
            $this->db->query("INSERT INTO M_MasterItem
                                    ( ItemID, ItemName, GroupID, ShortItem, PurchasePrice, SellingPrice, Stock, 
                                      ItemImage, IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate  ) 
                              VALUES 
                                    ('".$itemid."', '".$itemnm."', '".$groupid."', '".$shortitm."',".$purprice.",".$selprice.", ".$stock.", 
                                     '".$data['file_name']."', 'Y', '".$usernm."', '".$datetm."', '".$usernm."' , '".$datetm."')  
                            ");
          }
        }
      }
      $jeson['status']   = $status;
      $jeson['id']       = $itemid;
      $jeson['msg']      = "Book Save ".$msg;
      $jeson['notif']    = "Successfuly Saved !!!" . $msg;
      header('Content-Type: text/html');
      echo json_encode($jeson);
      exit;
    }
    else if(trim($uri) == "print"){
      $this->load->model('Masteritem_model');
      $data['title']        = 'Print Data Item';
      $data['isi']          = 'masteritem/Masteritem_print';
      $data['itemdata']     = $this->Masteritem_model->ViewGetMasteritem()->result();
      $this->load->view('masteritem/Masteritem_print',$data);
    }
    else if(trim($uri) == "export"){
      $this->load->model('Masteritem_model');
      $data['title']        = 'Export Data Item';
      $data['isi']          = 'masteritem/Masteritem_export';
      $data['itemdata']     = $this->Masteritem_model->ViewGetMasteritem()->result();
      $data['filenm']       = "master-item";
      $this->load->view('masteritem/Masteritem_export',$data);
    }
    else if (trim($uri) == "delete") {
        $this->db->query("UPDATE  M_MasterItem
                          SET     IsActive        = 'N',
                                  LastUpdateDate  = '".$datetm."',
                                  LastUpdateBy    = '".$usernm."' 
                          WHERE   ItemID          = '".$uri1."'
                        ");

        $ret_arr['status']  = "ok";
        $ret_arr['caption'] = "Delete Success !!!";
        $this->jcode($ret_arr);
        exit();
    }
    else{
      $this->load->model('Masteritem_model');
      $data['title']        = 'Data Item';
      $data['isi']          = 'masteritem/Masteritem_view';
      $data['itemdata']     = $this->Masteritem_model->ViewGetMasteritem()->result();
      $this->load->view('masteritem/Masteritem_view',$data);
      //$this->load->view('layout/wrapper',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }


}