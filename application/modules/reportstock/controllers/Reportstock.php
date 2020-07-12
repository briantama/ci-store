<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportstock extends CI_Controller {

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
	function viewReportStock(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');


    if(trim($uri) == "search"){

      $purchase  = (empty($jdeco->purchase)) ? "" : "ReferenceID = '".$jdeco->purchase."'";
      $item      = (empty($jdeco->itemid)) ? "" : "AND ItemID = '".$jdeco->itemid."'";
      $startdate = (empty($jdeco->startdate)) ? "" : "A.PurchaseDate >='".substr($jdeco->startdate,0,10)."'";
      $enddate   = (empty($jdeco->enddate)) ? "" : "A.PurchaseDate <='".substr($jdeco->enddate,0,10)."'";
      //sale date
      $startdt   = (empty($jdeco->startdate)) ? "" : "A.SaleDate >='".substr($jdeco->startdate,0,10)."'";
      $enddt     = (empty($jdeco->enddate)) ? "" : "A.SaleDate <='".substr($jdeco->enddate,0,10)."'";
      $sale      = (empty($jdeco->sale)) ? "" : "AND ReferenceID = '".$jdeco->purchase."'";
      
      $status    = (trim($jdeco->reporttype) == "") ? "HI" : trim($jdeco->reporttype);

      if(trim($status) == "HI")
      {
        $qry = $this->db->query("
                      
                              SELECT     ReferenceID, RefDate, ItemID , ItemName, Stock, StockIn, StockOut, ref
                              FROM ( 

                                SELECT    'Default Stock' as ReferenceID, date('Y-m-d') as RefDate, ItemID , ItemName, 
                                          Stock, 0 as StockIn, 0 as StockOut, 1 as ref
                                FROM      M_MasterItem


                                UNION ALL

                                SELECT    B.PurchaseOrderID as ReferenceID, PurchaseDate as RefDate, B.ItemID, C.ItemName, 
                                          0 as Stock, B.Amount as StockIn, 0 as StockOut, 2 as ref
                                FROM      T_PurchaseOrder A
                                INNER     JOIN T_PurchaseOrderDetail B ON A.PurchaseOrderID=B.PurchaseOrderID
                                INNER     JOIN M_MasterItem C ON B.ItemID=C.ItemID
                                WHERE     A.IsActive ='Y'
                                          AND B.IsActive='Y'
                                          ".$startdate."
                                          ".$enddate."

                                UNION ALL

                                SELECT    A.SaleID as ReferenceID, SaleDate as RefDate, B.ItemID, C.ItemName, 
                                          0 as Stock, 0 as StockIn, B.Amount as StockOut, 3 as ref
                                FROM      T_Sale A
                                INNER     JOIN T_SaleDetail B ON A.SaleID=B.SaleID
                                INNER     JOIN M_MasterItem C ON B.ItemID=C.ItemID
                                WHERE     A.IsActive ='Y'
                                          AND B.IsActive='Y'
                                          ".$startdt."
                                          ".$enddt."

                            ) ASX
                            WHERE ItemID <> ''
                                  ".$item."
                                  ".$purchase."
                                  ".$sale."
                            ORDER BY ItemID, ref


                                ");
        if ($qry->num_rows() > 0) {
          $str = $qry->result();
          //$this->jcode($res);
          //$this->load->view('reportpurchase/Reportpurchase_search', array('keys'=>$str));
          $data["StartDate"] = (empty($jdeco->startdate) != "") ? $jdeco->startdate : date('Y-m-d');
          $data["EndDate"]   = (empty($jdeco->enddate) != "") ? $jdeco->enddate : date('Y-m-d');
          $data["RptType"]   = "HI";
          $data["keys"]      = $str;
   


          $jeson['status']   = "ok";
          $jeson['id']       = $item;
          $jeson['msg']      = "Successfuly";
          $jeson['content']  = $this->load->view('reportstock/Reportstock_search', $data, TRUE);
          header('Content-Type: text/html');
          echo json_encode($jeson);
          exit;

        }
        else{
          $str = "";
          //$this->jcode($str);
          $jeson['status']   = "failed";
          $jeson['id']       = $item;
          $jeson['msg']      = "Record Not Found";
          $jeson['content']  = $str;
          header('Content-Type: text/html');
          echo json_encode($jeson);
          exit;
        }
      }
      else
      {
          $qry = $this->db->query("
                      
                              SELECT     ItemID , ItemName, IFNULL(SUM(Stock),0) AS Stock, IFNULL(SUM(StockIn) ,0) AS StockIn, 
                                         IFNULL(SUM(StockOut),0) AS StockOut 
                              FROM ( 

                                SELECT    'Default Stock' as ReferenceID, date('Y-m-d') as RefDate, ItemID , ItemName, 
                                          Stock, 0 as StockIn, 0 as StockOut, 1 as ref
                                FROM      M_MasterItem


                                UNION ALL

                                SELECT    B.PurchaseOrderID as ReferenceID, PurchaseDate as RefDate, B.ItemID, C.ItemName, 
                                          0 as Stock, B.Amount as StockIn, 0 as StockOut, 2 as ref
                                FROM      T_PurchaseOrder A
                                INNER     JOIN T_PurchaseOrderDetail B ON A.PurchaseOrderID=B.PurchaseOrderID
                                INNER     JOIN M_MasterItem C ON B.ItemID=C.ItemID
                                WHERE     A.IsActive ='Y'
                                          AND B.IsActive='Y'
                                          

                                UNION ALL

                                SELECT    A.SaleID as ReferenceID, SaleDate as RefDate, B.ItemID, C.ItemName, 
                                          0 as Stock, 0 as StockIn, B.Amount as StockOut, 3 as ref
                                FROM      T_Sale A
                                INNER     JOIN T_SaleDetail B ON A.SaleID=B.SaleID
                                INNER     JOIN M_MasterItem C ON B.ItemID=C.ItemID
                                WHERE     A.IsActive ='Y'
                                          AND B.IsActive='Y'
                                        

                            ) ASX
                            WHERE ItemID <> ''
                                   ".$item."
                                  ".$purchase."
                                  ".$sale."
                            GROUP BY ItemID ,ItemName
                            ORDER BY ItemID


                                ");
        if ($qry->num_rows() > 0) {
          $str = $qry->result();
          //$this->jcode($res);
          //$this->load->view('reportpurchase/Reportpurchase_search', array('keys'=>$str));
          $data["StartDate"] = (empty($jdeco->startdate) != "") ? $jdeco->startdate : date('Y-m-d');
          $data["EndDate"]   = (empty($jdeco->enddate) != "") ? $jdeco->enddate : date('Y-m-d');
          $data["RptType"]   = "TI";
          $data["keys"]      = $str;
   


          $jeson['status']   = "ok";
          $jeson['id']       = $item;
          $jeson['msg']      = "Successfuly";
          $jeson['content']  = $this->load->view('reportstock/Reportstock_searchtotal', $data, TRUE);
          header('Content-Type: text/html');
          echo json_encode($jeson);
          exit;

        }
        else{
          $str = "";
          //$this->jcode($str);
          $jeson['status']   = "failed";
          $jeson['id']       = $item;
          $jeson['msg']      = "Record Not Found";
          $jeson['content']  = $str;
          header('Content-Type: text/html');
          echo json_encode($jeson);
          exit;
        }
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
      $data['title']        = 'Print Data Stock';
      $data['isi']          = 'reportstock/Reportstock_print';
      $data['keys']         = unserialize(urldecode($uri1));
      $data["StartDate"]    = $_GET['StartDate'];
      $data["EndDate"]      = $_GET['EndDate'];
      $data["RptType"]      = $_GET['RptType'];
      $this->load->view('reportstock/Reportstock_print',$data);
    }
    else if(trim($uri) == "export"){
      $data['title']        = 'Export Data Stock';
      $data['isi']          = 'reportstock/Reportstock_export';
      $data['keys']         = unserialize(urldecode($uri1));
      $data["StartDate"]    = $_GET['StartDate'];
      $data["EndDate"]      = $_GET['EndDate'];
      $data["RptType"]      = $_GET['RptType'];
      $data['filenm']       = 'report-stock';
      $this->load->view('reportstock/Reportstock_export',$data);
    }
    else{
      $this->load->model('Reportstock_model');
      $data['title']        = 'Report Stock Item';
      $data['isi']          = 'reportstock/Reportstock_view';
      $data['cardata']      = $this->Reportstock_model->ViewGetReportStock()->result();
      $data['str']          = "";
      $this->load->view('reportstock/Reportstock_view',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }


}