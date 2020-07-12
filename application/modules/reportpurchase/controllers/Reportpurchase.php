<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportpurchase extends CI_Controller {

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


	//galeri widget
	function viewReportPurchase(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    
    if(trim($uri) == "search"){

      $purchase  = (empty($jdeco->purchase)) ? "" : "AND A.PurchaseOrderID = '".$jdeco->purchase."'";
      $item      = (empty($jdeco->itemid)) ? "" : "AND B.ItemID = '".$jdeco->itemid."'";
      $supplier  = (empty($jdeco->supplierid)) ? "" : "AND A.SupplierID = '".$jdeco->supplierid."'";
      $startdate = (empty($jdeco->startdate)) ? date('Y-m-d') : substr($jdeco->startdate,0,10);
      $enddate   = (empty($jdeco->enddate)) ? date('Y-m-d') : substr($jdeco->enddate,0,10);
      $status    = (trim($jdeco->statuspo) == "0") ? "" : "AND A.Status = '".trim($jdeco->statuspo)."'";
      
      $qry = $this->db->query("
                    
                              SELECT    A.PurchaseOrderID, A.PurchaseDate, A.SupplierID, A.TotalPurchase,
                                        A.Status, A.IsActive, B.ItemID, B.PurchasePrice, B.Amount, B.Total,
                                        C.ItemName, D.SupplierName
                              FROM      T_PurchaseOrder A
                              INNER     JOIN T_PurchaseOrderDetail B ON A.PurchaseOrderID=B.PurchaseOrderID
                              INNER     JOIN M_MasterItem C ON B.ItemID=C.ItemID
                              INNER     JOIN M_MasterSupplier D ON A.SupplierID=D.SupplierID
                              WHERE     A.IsActive ='Y'
                                        AND B.IsActive='Y'
                                        AND A.PurchaseDate BETWEEN '".$startdate."' AND  '".$enddate."'
                                        ".$purchase."
                                        ".$item."
                                        ".$supplier."
                                        ".$status."
                                        Order By A.PurchaseOrderID


                              ");
      if ($qry->num_rows() > 0) {
        $str = $qry->result();
        //$this->jcode($res);
        //$this->load->view('reportpurchase/Reportpurchase_search', array('keys'=>$str));
        $data["StartDate"] = $startdate;
        $data["EndDate"]   = $enddate;
        $data["keys"]      = $str;
 


        $jeson['status']   = "ok";
        $jeson['id']       = $purchase;
        $jeson['msg']      = "Successfuly";
        $jeson['content']  = $this->load->view('reportpurchase/Reportpurchase_search', $data, TRUE);
        header('Content-Type: text/html');
        echo json_encode($jeson);
        exit;

      }
      else{
        $str = "";
        //$this->jcode($str);
        $jeson['status']   = "failed";
        $jeson['id']       = $purchase;
        $jeson['msg']      = "Record Not Found";
        $jeson['content']  = $str;
        header('Content-Type: text/html');
        echo json_encode($jeson);
        exit;
      }

    }
    //search item 
    else if(trim($uri) == "searchitem"){
        $varbl =  $jdeco->searchText;
        if(trim($varbl))
        {
          $query = $this->db->query(" SELECT  ItemID, ItemName, GroupID, ShortItem, PurchasePrice, SellingPrice, Stock, 
                                              ItemImage, IsActive 
                                      FROM    M_MasterItem
                                      WHERE   IsActive  = 'Y'
                                              AND (ItemID LIKE '%".$varbl."%' OR ItemName LIKE '%".$varbl."%')
                                ");
           if ($query->num_rows() > 0) {
            $arr = $query->result();
            foreach($arr as $key){
              $data[] = ["item" => $key->ItemID." - ".$key->ItemName, "keyitem" => $key->ItemID, "itemname" => $key->ItemName, "purprice" => $key->PurchasePrice];
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
    //search supplier 
    else if(trim($uri) == "searchsupplier"){
        $varbl =  $jdeco->searchText;
        if(trim($varbl))
        {
          $query = $this->db->query(" SELECT  SupplierID, SupplierName, Description, 
                                              IsActive
                                      FROM    M_MasterSupplier
                                      WHERE   IsActive  = 'Y'
                                              AND (SupplierID LIKE '%".$varbl."%' OR SupplierName LIKE '%".$varbl."%')
                                ");
           if ($query->num_rows() > 0) {
            $arr = $query->result();
            foreach($arr as $key){
              $data[] = ["supplier" => $key->SupplierID." - ".$key->SupplierName, "keysupplier" => $key->SupplierID, "suppliername" => $key->SupplierName];
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
    else if(trim($uri) == "print"){
      $this->load->model('Reportpurchase_model');
      $data['title']        = 'Print Data Purchase Order';
      $data['isi']          = 'reportpurchase/Reportpurchase_print';
      $data['keys']         = unserialize(urldecode($uri1));
      $data["StartDate"]    = $_GET['StartDate'];
      $data["EndDate"]      = $_GET['EndDate'];
      $this->load->view('reportpurchase/Reportpurchase_print',$data);
    }
    else if(trim($uri) == "export"){
      $this->load->model('Reportpurchase_model');
      $data['title']        = 'Export Data Purchase Order';
      $data['isi']          = 'reportpurchase/Reportpurchase_export';
      $data['keys']         = unserialize(urldecode($uri1));
      $data["StartDate"]    = $_GET['StartDate'];
      $data["EndDate"]      = $_GET['EndDate'];
      $data['filenm']       = 'report-purchase-order';
      $this->load->view('reportpurchase/Reportpurchase_export',$data);
    }
    else{
      $this->load->model('Reportpurchase_model');
      $data['title']        = 'Report Purchase Order';
      $data['isi']          = 'reportpurchase/Reportpurchase_view';
      $data['cardata']      = $this->Reportpurchase_model->ViewGetReportPurchase()->result();
      $data['str']          = "";
      $this->load->view('reportpurchase/Reportpurchase_view',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }


}