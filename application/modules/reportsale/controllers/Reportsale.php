<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportsale extends CI_Controller {

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
	function viewReportSale(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if(trim($uri) == "search"){

      $sale      = (empty($jdeco->sale)) ? "" : "AND A.SaleID = '".$jdeco->sale."'";
      $item      = (empty($jdeco->itemid)) ? "" : "AND B.ItemID = '".$jdeco->itemid."'";
      $startdate = (empty($jdeco->startdate)) ? date('Y-m-d') : $jdeco->startdate;
      $enddate   = (empty($jdeco->enddate)) ? date('Y-m-d') : $jdeco->enddate;
      $status    = (trim($jdeco->statussl) == "0") ? "" : "AND A.Status = '".trim($jdeco->statussl)."'";
      
      $qry = $this->db->query("
                    
                              SELECT    A.SaleID, A.SaleDate, A.TotalSale, A.Status,
                                        A.IsActive, B.ItemID, B.SellingPrice, B.Amount, B.Total, 
                                        C.ItemName
                              FROM      T_Sale A
                              INNER     JOIN T_SaleDetail B ON A.SaleID=B.SaleID
                              INNER     JOIN M_MasterItem C ON B.ItemID=C.ItemID
                              WHERE     A.IsActive ='Y'
                                        AND B.IsActive='Y'
                                        AND A.SaleDate BETWEEN '".$startdate."' AND  '".$enddate."'
                                        ".$sale."
                                        ".$item."
                                        ".$status."
                                        Order By A.SaleID, B.ItemID


                              ");
      if ($qry->num_rows() > 0) {
        $str = $qry->result();

        $data["StartDate"] = $startdate;
        $data["EndDate"]   = $enddate;
        $data["keys"]      = $str;
 
        $jeson['status']   = "ok";
        $jeson['id']       = $sale;
        $jeson['msg']      = "Successfuly";
        $jeson['content']  = $this->load->view('reportsale/Reportsale_search', $data, TRUE);
        header('Content-Type: text/html');
        echo json_encode($jeson);
        exit;

      }
      else{
        $str = "";
        //$this->jcode($str);
        $jeson['status']   = "failed";
        $jeson['id']       = $sale;
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
    else if(trim($uri) == "print"){
      $this->load->model('Reportsale_model');
      $data['title']        = 'Print Data Sale';
      $data['isi']          = 'reportsale/Reportsale_print';
      $data['keys']         = unserialize(urldecode($uri1));
      $data["StartDate"]    = $_GET['StartDate'];
      $data["EndDate"]      = $_GET['EndDate'];
      $this->load->view('reportsale/Reportsale_print',$data);
    }
    else if(trim($uri) == "export"){
      $this->load->model('Reportsale_model');
      $data['title']        = 'Export Data Sale';
      $data['isi']          = 'reportsale/Reportsale_export';
      $data['keys']         = unserialize(urldecode($uri1));
      $data["StartDate"]    = $_GET['StartDate'];
      $data["EndDate"]      = $_GET['EndDate'];
      $data['filenm']       = 'report-sale';
      $this->load->view('reportsale/Reportsale_export',$data);
    }
    else{
      $this->load->model('Reportsale_model');
      $data['title']        = 'Report Sale';
      $data['isi']          = 'reportsale/Reportsale_view';
      $data['cardata']      = $this->Reportsale_model->ViewGetReportSale()->result();
      $data['str']          = "";
      $this->load->view('reportsale/Reportsale_view',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }


}