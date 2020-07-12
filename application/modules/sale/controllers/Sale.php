<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sale extends CI_Controller {

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	public function index() {
		$data=array('title'=>'Bryn Storre - Halaman Administrator',
					 'isi' =>'dasbor/dasbor_view'
						);
		$this->load->view('layout/wrapper',$data);	
	}


	//group widget
	function viewSale(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if(trim($uri) == "view-ang"){
      $qry = $this->db->query("SELECT * FROM T_Sale");
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
    //detail purchase order
    else if(trim($uri) == "view-detail"){
      if(trim($uri1) != ""){
        $qry = $this->db->query("
                                  SELECT  A.SaleID, A.ItemID, A.SellingPrice, A.Amount, A.Total,  
                                          B.SaleID, B.SaleDate, B.TotalSale, C.ItemName
                                  FROM    T_SaleDetail A
                                  INNER   JOIN T_Sale B ON A.SaleID=B.SaleID
                                  INNER   JOIN M_MasterItem C ON A.ItemID=C.ItemID
                                  WHERE   A.SaleID ='".$uri1."' 
                                          AND A.IsActive ='Y'  
                                ");
        // $qry = $this->db->query("SELECT  '000001' AS SaleID, 'itm01' AS ItemID , 70000 AS PurchasePrice, 2 AS Amount , 140000 AS Total 
        //                          UNION ALL
        //                          SELECT  '000002' AS SaleID, 'itm02' AS ItemID , 50000 AS PurchasePrice, 3 AS Amount , 150000 AS Total 

        //                        ");
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
      else{
        $str  = "";
        $this->jcode($str);
        exit();
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
              $data[] = ["item" => $key->ItemID." - ".$key->ItemName, "keyitem" => $key->ItemID, "itemname" => $key->ItemName, "selprice" => $key->SellingPrice, "stock"=>$key->Stock];
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
    //get number id supplier
    else if(trim($uri) == "getnumber"){
      $xdate = date('ym');
      $qry = $this->db->query("SELECT  CONCAT('SAL-".$xdate."-',LPAD(COALESCE(MAX(RIGHT(SaleID, 6)), '000000')+1,6,0)) AS GetID
                               FROM    T_Sale");
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
      $sale      = (empty($jdeco->sale)) ? "" : "".$jdeco->sale."";
      $saledate  = (empty($jdeco->saledate)) ? "" : "".$jdeco->saledate."";
      $itemid    = (empty($jdeco->itemid)) ? "" : "".$jdeco->itemid."";
      $selprice  = (empty($jdeco->sellingprice)) ? "" : "".$jdeco->sellingprice."";
      $amount    = (empty($jdeco->amount)) ? "" : "".$jdeco->amount."";
      $total     = (empty($jdeco->total)) ? "" : "".$jdeco->total."";


      //check data post or not
      $cek = $this->db->query("SELECT Status FROM T_Sale WHERE SaleID = '".$sale."'");
        if ($cek->num_rows() > 0) {
           $res = $cek->row();
           if(trim($res->Status) == "5"){
              $jeson['status']   = "ok";
              $jeson['id']       = $sale;
              $jeson['msg']      = "Data Already Posted";
              $jeson['notif']    = "Failed To Save, Data Already Posted";
              header('Content-Type: text/html');
              echo json_encode($jeson);
              exit;
           }
        }

        
      $res = $this->db->query("SELECT SaleID FROM T_Sale WHERE SaleID = '".$sale."'");
          if ($res->num_rows() == 0) {
            
            //insert header
            $this->db->query("INSERT INTO T_Sale
                                    ( SaleID, SaleDate, TotalSale,
                                      Status, IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate  ) 
                              VALUES 
                                    ('".$sale."', '".$saledate."', 0,
                                     '5', 'Y', '".$usernm."', '".$datetm."', '".$usernm."' , '".$datetm."')  
                            ");
            
            $msg = "Save";
          }
          else {
            //sum detail sale
            $sum = $this->db->query("SELECT IFNULL(SUM(Total),0) AS TotalAmount 
                                     FROM   T_SaleDetail 
                                     WHERE  SaleID = '".trim($sale)."'
                                            AND IsActive = 'Y'
                                     ");
              if ($sum->num_rows() > 0) {
                $res    = $sum->row();
                $sumtot = $res->TotalAmount;
              }
              else{
                $sumtot = 0;
              }

            $this->db->query("UPDATE  T_Sale
                                      SET     SaleDate                = '".$saledate."',
                                              TotalSale               = ".$sumtot.",
                                              IsActive                = 'Y',
                                              Status                  = '5',
                                              LastUpdateDate          = '".$datetm."',
                                              LastUpdateBy            = '".$usernm."'
                                      WHERE   SaleID                  = '".$sale."'
                            ");
            
            $msg = "Update";
          }



          //update stock
          $qry = $this->db->query("
                                  SELECT  A.SaleID, A.ItemID, A.SellingPrice, A.Amount, A.Total,  
                                          B.SaleID, B.SaleDate, B.TotalSale
                                  FROM    T_SaleDetail A
                                  INNER   JOIN T_Sale B ON A.SaleID=B.SaleID
                                  INNER   JOIN M_MasterItem C ON A.ItemID=C.ItemID
                                  WHERE   A.SaleID ='".$sale."' 
                                          AND A.IsActive ='Y'  
                                ");
          if ($qry->num_rows() > 0) {
          $res = $qry->result();
           foreach ($res as $key) {
              $sitem = $key->ItemID;
              $spco  = $key->SaleID;
              $sstk  = $key->Amount;

              //update data item
              $this->db->query("  UPDATE  M_MasterItem
                                  SET     Stock                   = Stock - ".$sstk.",
                                          IsActive                = 'Y',
                                          LastUpdateDate          = '".$datetm."',
                                          LastUpdateBy            = '".$usernm."'
                                  WHERE   ItemID                  = '".$sitem."'
                              ");

            }
          }
        
      
      $jeson['status']   = "ok";
      $jeson['id']       = $sale;
      $jeson['msg']      = "Successfuly ".$msg;
      $jeson['notif']    = "Successfuly Saved !!!";
      header('Content-Type: text/html');
      echo json_encode($jeson);
      exit;
    }
    else if (trim($uri) == "save-detail") {

      //post file
      $sale      = (empty($jdeco->sale)) ? "" : "".$jdeco->sale."";
      $saledate  = (empty($jdeco->saledate)) ? "" : "".$jdeco->saledate."";
      $itemid    = (empty($jdeco->itemid)) ? "" : "".$jdeco->itemid."";
      $selprice  = (empty($jdeco->sellingprice)) ? "" : "".$jdeco->sellingprice."";
      $amount    = (empty($jdeco->amount)) ? "" : "".$jdeco->amount."";
      $total     = (empty($jdeco->total)) ? "" : "".$jdeco->total."";


      //check data post or not
      $cek = $this->db->query("SELECT Status FROM T_Sale WHERE SaleID = '".$sale."'");
        if ($cek->num_rows() > 0) {
           $res = $cek->row();
           if(trim($res->Status) == "5"){
              $jeson['status']   = "ok";
              $jeson['id']       = $sale;
              $jeson['msg']      = "Data Already Posted";
              $jeson['notif']    = "Failed To Save, Data Already Posted";
              header('Content-Type: text/html');
              echo json_encode($jeson);
              exit;
           }
        }


      
      $res = $this->db->query("SELECT SaleID FROM T_Sale WHERE SaleID = '".$sale."'");
          if ($res->num_rows() == 0) {
            
            //insert header
            $this->db->query("INSERT INTO T_Sale
                                    ( SaleID, SaleDate, TotalSale,
                                      Status, IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate  ) 
                              VALUES 
                                    ('".$sale."', '".$saledate."', 0,
                                     '0', 'Y', '".$usernm."', '".$datetm."', '".$usernm."' , '".$datetm."')  
                            ");
            
          }
          else {
            $this->db->query("UPDATE  T_Sale
                                      SET     SaleDate                = '".$saledate."',
                                              TotalSale               = 0,
                                              IsActive                = 'Y',
                                              LastUpdateDate          = '".$datetm."',
                                              LastUpdateBy            = '".$usernm."'
                                      WHERE   SaleID                  = '".$sale."'
                            ");
            
          }

       //insert Detail PO
      $det = $this->db->query("SELECT SaleID, ItemID FROM T_SaleDetail WHERE  SaleID = '".trim($sale)."' AND ItemID = '".trim($itemid)."' ");
      if($det->num_rows() == 0){
        $this->db->query("INSERT INTO T_SaleDetail
                            (SaleID, ItemID, SellingPrice, Amount, Total, 
                             IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate)
                          VALUES
                            ('".$sale."', '".$itemid."', ".$selprice.", ".$amount.", ".$total.",
                             'Y', '".$usernm."', '".$datetm."', '".$usernm."' , '".$datetm."' )
                        ");
        $msg = "Save";
      }
      else{
         $this->db->query(" UPDATE  T_SaleDetail
                            SET     SellingPrice            = '".$selprice."',
                                    Amount                  = '".$amount."',
                                    Total                   = '".$total."',
                                    IsActive                = 'Y',
                                    LastUpdateDate          = '".$datetm."',
                                    LastUpdateBy            = '".$usernm."'
                            WHERE   SaleID                  = '".$sale."'
                                    AND ItemID              = '".$itemid."'
                            ");
         $msg = "Update";
      }
        
      
      $jeson['status']   = "ok";
      $jeson['id']       = $sale;
      $jeson['msg']      = "Successfuly ".$msg;
      $jeson['notif']    = "Successfuly Saved !!!";
      header('Content-Type: text/html');
      echo json_encode($jeson);
      exit;
    }
    else if(trim($uri) == "print"){
      $this->load->model('Sale_model');
      $data['title']        = 'Print Data Sale';
      $data['isi']          = 'sale/Sale_print';
      $data['sldata']       = $this->Sale_model->ViewGetSale()->result();
      $this->load->view('sale/Sale_print',$data);
    }
    else if(trim($uri) == "printbill"){

      $qry = $this->db->query(" SELECT  B.SaleID, B.SaleDate, B.TotalSale,
                                        B.Status, A.ItemID, A.SellingPrice, A.Amount, A.Total, C.ItemName
                                FROM    T_SaleDetail A
                                INNER   JOIN T_Sale B ON A.SaleID=B.SaleID
                                INNER   JOIN M_MasterItem C ON A.ItemID=C.ItemID
                                WHERE   A.SaleID ='".$uri1."' AND A.IsActive ='Y'  
                            ");
      if ($qry->num_rows() > 0) {
        $res = $qry->result();
      }
      else
      {
        $res  = "";
      }


      $this->load->model('Sale_model');
      $data['title']        = 'Print Bill Data Sale';
      $data['isi']          = 'sale/Sale_printbill';
      $data['sldata']       = $res;
      $this->load->view('sale/Sale_printbill',$data);
    }
    else if(trim($uri) == "export"){
      $this->load->model('Sale_model');
      $data['title']        = 'Export Data Sale';
      $data['isi']          = 'sale/Sale_export';
      $data['sldata']       = $this->Sale_model->ViewGetSale()->result();
      $data['filenm']       = 'sale-transaction';
      $this->load->view('sale/Sale_export',$data);
    }
    else if (trim($uri) == "post") {

        //check data post or not
        $cek = $this->db->query("SELECT Status FROM T_Sale WHERE SaleID = '".$uri1."'");
          if ($cek->num_rows() > 0) {
             $res = $cek->row();
             if(trim($res->Status) == "5"){
                $jeson['status']   = "failed";
                $jeson['id']       = $uri1;
                $jeson['msg']      = "Data Already Posted";
                $jeson['caption']  = "Failed To Delete, Data Already Posted";
                header('Content-Type: text/html');
                echo json_encode($jeson);
                exit;
             }
        }

         //check detail data purchase
      $pst = $this->db->query("SELECT SaleID FROM T_SaleDetail WHERE SaleID = '".$uri1."' AND IsActive = 'Y' ");
        if ($pst->num_rows() == 0) {
            $jeson['status']   = "failed";
            $jeson['id']       = $uri;
            $jeson['msg']      = "Data Not Found";
            $jeson['caption']  = "Failed To Post, Please Insert Data Detail Sale";
            
            header('Content-Type: text/html');
            echo json_encode($jeson);
            exit;
        }


        //sum detail sale
        $sum = $this->db->query("SELECT IFNULL(SUM(Total),0) AS TotalAmount 
                                     FROM   T_SaleDetail 
                                     WHERE  SaleID = '".trim($uri1)."'
                                            AND IsActive = 'Y'
                                     ");
          if ($sum->num_rows() > 0) {
              $res    = $sum->row();
              $sumtot = $res->TotalAmount;
          }
          else{
              $sumtot = 0;
          }


        $this->db->query("UPDATE  T_Sale 
                          SET     Status           = '5',
                                  TotalSale        = ".$sumtot.",
                                  LastUpdateDate   = '".$datetm."',
                                  LastUpdateBy     = '".$usernm."' 
                          WHERE   SaleID           = '".$uri1."'
                        ");


        //update stock
          $qry = $this->db->query("
                                  SELECT  A.SaleID, A.ItemID, A.SellingPrice, A.Amount, A.Total,  
                                          B.SaleID, B.SaleDate, B.TotalSale
                                  FROM    T_SaleDetail A
                                  INNER   JOIN T_Sale B ON A.SaleID=B.SaleID
                                  INNER   JOIN M_MasterItem C ON A.ItemID=C.ItemID
                                  WHERE   A.SaleID ='".$uri1."' 
                                          AND A.IsActive ='Y'  
                                ");
          if ($qry->num_rows() > 0) {
          $res = $qry->result();
           foreach ($res as $key) {
              $sitem = $key->ItemID;
              $spco  = $key->SaleID;
              $sstk  = $key->Amount;

              //update data item
              $this->db->query("  UPDATE  M_MasterItem
                                  SET     Stock                   = Stock - ".$sstk.",
                                          IsActive                = 'Y',
                                          LastUpdateDate          = '".$datetm."',
                                          LastUpdateBy            = '".$usernm."'
                                  WHERE   ItemID                  = '".$sitem."'
                              ");

            }
          }

        $ret_arr['status']  = "ok";
        $ret_arr['caption'] = "Post Successfuly !!!";
        $this->jcode($ret_arr);
        exit();
    }
    else if (trim($uri) == "delete") {

      //check data post or not
        $cek = $this->db->query("SELECT Status FROM T_Sale WHERE SaleID = '".$uri1."'");
          if ($cek->num_rows() > 0) {
             $res = $cek->row();
             if(trim($res->Status) == "5"){
                $jeson['status']   = "ok";
                $jeson['id']       = $uri1;
                $jeson['msg']      = "Data Already Posted";
                $jeson['caption']  = "Failed To Delete, Data Already Posted";
                header('Content-Type: text/html');
                echo json_encode($jeson);
                exit;
             }
        }



        $this->db->query("UPDATE  T_Sale
                          SET     IsActive        = 'N',
                                  LastUpdateDate  = '".$datetm."',
                                  LastUpdateBy    = '".$usernm."' 
                          WHERE   SaleID          = '".$uri1."'
                        ");

        $ret_arr['status']  = "ok";
        $ret_arr['caption'] = "Delete Success !!!";
        $this->jcode($ret_arr);
        exit();
    }
    //delete detail PO
    else if (trim($uri) == "delete-detail") {
      if(trim($uri1) != "" && trim($uri2) != ""){

        //check data post or not
        $cek = $this->db->query("SELECT Status FROM T_Sale WHERE SaleID = '".$uri1."'");
          if ($cek->num_rows() > 0) {
             $res = $cek->row();
             if(trim($res->Status) == "5"){
                $jeson['status']   = "ok";
                $jeson['id']       = $uri1;
                $jeson['msg']      = "Data Already Posted";
                $jeson['caption']  = "Failed To Delete, Data Already Posted";
                header('Content-Type: text/html');
                echo json_encode($jeson);
                exit;
             }
        }

        
        $this->db->query("UPDATE  T_SaleDetail
                          SET     IsActive          = 'N',
                                  LastUpdateDate    = '".$datetm."',
                                  LastUpdateBy      = '".$usernm."' 
                          WHERE   SaleID            = '".$uri1."'
                                  AND ItemID        = '".$uri2."'
                        ");

        $ret_arr['status']  = "ok";
        $ret_arr['caption'] = "Delete Success !!!";
        $this->jcode($ret_arr);
        exit();
      }
      else
      {
        $ret_arr['status']  = "Failed";
        $ret_arr['caption'] = "Record Not Found !!!";
        $this->jcode($ret_arr);
        exit();
      }
    }
    else{
      $this->load->model('Sale_model');
      $data['title']        = 'Data Sale';
      $data['isi']          = 'sale/Sale_view';
      $data['sldata']       = $this->Sale_model->ViewGetSale()->result();
      $this->load->view('sale/Sale_view',$data);
      //$this->load->view('layout/wrapper',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }

  

}