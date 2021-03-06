<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchaseorder extends CI_Controller {

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
	function viewPurchaseOrder(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if(trim($uri) == "view-ang"){
      $qry = $this->db->query("SELECT * FROM T_PurchaseOrder");
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
        $qry = $this->db->query(" SELECT  A.PurchaseOrderID, A.ItemID, A.PurchasePrice, A.Amount, A.Total,
                                          B.ItemName
                                  FROM    T_PurchaseOrderDetail A
                                  INNER   JOIN M_MasterItem B ON A.ItemID=B.ItemID
                                  WHERE   A.PurchaseOrderID ='".$uri1."' 
                                          AND A.IsActive ='Y'  ");
        // $qry = $this->db->query("SELECT  '000001' AS PurchaseOrderID, 'itm01' AS ItemID , 70000 AS PurchasePrice, 2 AS Amount , 140000 AS Total 
        //                          UNION ALL
        //                          SELECT  '000002' AS PurchaseOrderID, 'itm02' AS ItemID , 50000 AS PurchasePrice, 3 AS Amount , 150000 AS Total 

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
              $data[] = ["item" => $key->ItemID." - ".$key->ItemName, "keyitem" => $key->ItemID, "itemname" => $key->ItemName, "purprice" => $key->PurchasePrice, "stock" => $key->Stock];
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
    //get number id supplier
    else if(trim($uri) == "getnumber"){
      $xdate = date('ym');
      $qry = $this->db->query("SELECT  CONCAT('PCO-".$xdate."-',LPAD(COALESCE(MAX(RIGHT(PurchaseOrderID, 6)), '000000')+1,6,0)) AS GetID
                               FROM    T_PurchaseOrder");
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

      $purorder  = (empty($jdeco->purorder)) ? "" : "".$jdeco->purorder."";
      $purdate   = (empty($jdeco->purchasedate)) ? "" : "".$jdeco->purchasedate."";
      $supplier  = (empty($jdeco->supplierid)) ? "" : "".$jdeco->supplierid."";
      $itemid    = (empty($jdeco->itemid)) ? "" : "".$jdeco->itemid."";
      $purprice  = (empty($jdeco->purprice)) ? 0 : "".$jdeco->purprice."";
      $amount    = (empty($jdeco->amount)) ? 0 : "".$jdeco->amount."";
      $total     = (empty($jdeco->total)) ? 0 : "".$jdeco->total."";

      //check data post or not
      $cek = $this->db->query("SELECT Status FROM T_PurchaseOrder WHERE PurchaseOrderID = '".$purorder."'");
        if ($cek->num_rows() > 0) {
           $res = $cek->row();
           if(trim($res->Status) == "5"){
              $jeson['status']   = "ok";
              $jeson['id']       = $purorder;
              $jeson['msg']      = "Data Already Posted";
              $jeson['notif']    = "Failed To Save, Data Already Posted";
              header('Content-Type: text/html');
              echo json_encode($jeson);
              exit;
           }
      }

      
      $res = $this->db->query("SELECT PurchaseOrderID FROM T_PurchaseOrder WHERE PurchaseOrderID = '".$purorder."'");
          if ($res->num_rows() == 0) {
            
            //insert header
            $this->db->query("INSERT INTO T_PurchaseOrder
                                    ( PurchaseOrderID, PurchaseDate, SupplierID, TotalPurchase,
                                      Status, IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate  ) 
                              VALUES 
                                    ('".$purorder."', '".$purdate."', '".$supplier."', 0,
                                     '5', 'Y', '".$usernm."', '".$datetm."', '".$usernm."' , '".$datetm."')  
                            ");
            
            $msg = "Save";
          }
          else {
            //sum detail PO
            $sum = $this->db->query("SELECT IFNULL(SUM(Total),0) AS TotalAmount 
                                     FROM   T_PurchaseOrderDetail 
                                     WHERE  PurchaseOrderID = '".trim($purorder)."'
                                            AND IsActive = 'Y'
                                     ");
              if ($sum->num_rows() > 0) {
                $res    = $sum->row();
                $sumtot = $res->TotalAmount;
              }
              else{
                $sumtot = 0;
              }

            $this->db->query("UPDATE  T_PurchaseOrder
                                      SET     SupplierID              = '".$supplier."',
                                              PurchaseDate            = '".$purdate."',
                                              TotalPurchase           = ".$sumtot.",
                                              IsActive                = 'Y',
                                              Status                  = '5',
                                              LastUpdateDate          = '".$datetm."',
                                              LastUpdateBy            = '".$usernm."'
                                      WHERE   PurchaseOrderID         = '".$purorder."'
                            ");
            
            $msg = "Update";
          }


        //update stock item
        $qry = $this->db->query(" SELECT  A.PurchaseOrderID, A.ItemID, A.PurchasePrice, A.Amount, A.Total,
                                          B.PurchaseDate, B.SupplierID
                                  FROM    T_PurchaseOrderDetail A 
                                  INNER   JOIN T_PurchaseOrder B ON A.PurchaseOrderID=B.PurchaseOrderID
                                  INNER   JOIN M_MasterItem C ON A.ItemID=C.ItemID
                                  WHERE   A.PurchaseOrderID ='".$purorder."' 
                                          AND A.IsActive ='Y'  

                                ");
        if ($qry->num_rows() > 0) {
          $res = $qry->result();
           foreach ($res as $key) {
              $sitem = $key->ItemID;
              $spco  = $key->PurchaseOrderID;
              $sstk  = $key->Amount;

              //update data item
              $this->db->query("  UPDATE  M_MasterItem
                                  SET     Stock                   = Stock + ".$sstk.",
                                          IsActive                = 'Y',
                                          LastUpdateDate          = '".$datetm."',
                                          LastUpdateBy            = '".$usernm."'
                                  WHERE   ItemID                  = '".$sitem."'
                              ");

           }
        }
        
      
      $jeson['status']   = "ok";
      $jeson['id']       = $purorder;
      $jeson['msg']      = "Successfuly ".$msg;
      $jeson['notif']    = "Successfuly Saved !!!";
      header('Content-Type: text/html');
      echo json_encode($jeson);
      exit;
    }
    else if (trim($uri) == "save-detail") {

      //post file
      $purorder  = (empty($jdeco->purorder)) ? "" : "".$jdeco->purorder."";
      $purdate   = (empty($jdeco->purchasedate)) ? "" : "".$jdeco->purchasedate."";
      $supplier  = (empty($jdeco->supplierid)) ? "" : "".$jdeco->supplierid."";
      $itemid    = (empty($jdeco->itemid)) ? "" : "".$jdeco->itemid."";
      $purprice  = (empty($jdeco->purchaseprice)) ? 0 : "".$jdeco->purchaseprice."";
      $amount    = (empty($jdeco->amount)) ? 0 : "".$jdeco->amount."";
      $total     = (empty($jdeco->total)) ? 0 : "".$jdeco->total."";

      //check data post or not
      $cek = $this->db->query("SELECT Status FROM T_PurchaseOrder WHERE PurchaseOrderID = '".$purorder."'");
        if ($cek->num_rows() > 0) {
           $res = $cek->row();
           if(trim($res->Status) == "5"){
              $jeson['status']   = "ok";
              $jeson['id']       = $purorder;
              $jeson['msg']      = "Data Already Posted";
              $jeson['notif']    = "Failed To Save, Data Already Posted";
              header('Content-Type: text/html');
              echo json_encode($jeson);
              exit;
           }
        }


      
      $res = $this->db->query("SELECT PurchaseOrderID FROM T_PurchaseOrder WHERE PurchaseOrderID = '".$purorder."'");
          if ($res->num_rows() == 0) {
            
            //insert header
            $this->db->query("INSERT INTO T_PurchaseOrder
                                    ( PurchaseOrderID, PurchaseDate, SupplierID, TotalPurchase,
                                      Status, IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate  ) 
                              VALUES 
                                    ('".$purorder."', '".$purdate."', '".$supplier."', 0,
                                     '0', 'Y', '".$usernm."', '".$datetm."', '".$usernm."' , '".$datetm."')  
                            ");
            
          }
          else {
            $this->db->query("UPDATE  T_PurchaseOrder
                                      SET     SupplierID              = '".$supplier."',
                                              PurchaseDate            = '".$purdate."',
                                              TotalPurchase           = 0,
                                              IsActive                = 'Y',
                                              LastUpdateDate          = '".$datetm."',
                                              LastUpdateBy            = '".$usernm."'
                                      WHERE   PurchaseOrderID         = '".$purorder."'
                            ");
            
          }

       //insert Detail PO
      $det = $this->db->query("SELECT PurchaseOrderID, ItemID FROM T_PurchaseOrderDetail WHERE  PurchaseOrderID = '".trim($purorder)."' AND ItemID = '".trim($itemid)."' ");
      if($det->num_rows() == 0){
        $this->db->query("INSERT INTO T_PurchaseOrderDetail
                            (PurchaseOrderID, ItemID, PurchasePrice, Amount, Total, 
                             IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate)
                          VALUES
                            ('".$purorder."', '".$itemid."', ".$purprice.", ".$amount.", ".$total.",
                             'Y', '".$usernm."', '".$datetm."', '".$usernm."' , '".$datetm."' )
                        ");
        $msg = "Save";
      }
      else{
         $this->db->query(" UPDATE  T_PurchaseOrderDetail
                            SET     PurchasePrice           = '".$purprice."',
                                    Amount                  = '".$amount."',
                                    Total                   = '".$total."',
                                    IsActive                = 'Y',
                                    LastUpdateDate          = '".$datetm."',
                                    LastUpdateBy            = '".$usernm."'
                            WHERE   PurchaseOrderID         = '".$purorder."'
                                    AND ItemID              = '".$itemid."'
                            ");
         $msg = "Update";
      }
        
      
      $jeson['status']   = "ok";
      $jeson['id']       = $purorder;
      $jeson['msg']      = "Successfuly ".$msg;
      $jeson['notif']    = "Successfuly Saved !!!";
      header('Content-Type: text/html');
      echo json_encode($jeson);
      exit;
    }
     else if(trim($uri) == "printinvoice"){

      $res = $this->db->query("

                                  SELECT  A.PurchaseOrderID, A.ItemID, A.PurchasePrice, A.Amount, A.Total,
                                          B.PurchaseDate, B.SupplierID, C.ItemName, D.SupplierName
                                  FROM    T_PurchaseOrderDetail A 
                                  INNER   JOIN T_PurchaseOrder B ON A.PurchaseOrderID=B.PurchaseOrderID
                                  INNER   JOIN M_MasterItem C ON A.ItemID=C.ItemID
                                  INNER   JOIN M_MasterSupplier D ON B.SupplierID=D.SupplierID
                                  WHERE   A.PurchaseOrderID ='".$uri1."' 
                                          AND A.IsActive ='Y'  

                              ");
      if ($res->num_rows() > 0) {
        $rows = $res->result();
      }
      else
      {
        $rows = "";  
      }

      $data['title']        = 'Print Invoice Data PurchaseOrder';
      $data['isi']          = 'Purchaseorder/Purchaseorder_printinvoice';
      $data["datainv"]      = $rows;
      $this->load->view('purchaseorder/Purchaseorder_printinvoice',$data);
    }
    else if(trim($uri) == "print"){
      $this->load->model('Purchaseorder_model');
      $data['title']        = 'Print Data PurchaseOrder';
      $data['isi']          = 'Purchaseorder/Purchaseorder_print';
      $data['podata']       = $this->Purchaseorder_model->ViewGetPurchaseOrder()->result();
      $this->load->view('purchaseorder/Purchaseorder_print',$data);
    }
    else if(trim($uri) == "export"){
      $this->load->model('Purchaseorder_model');
      $data['title']        = 'Export Data PurchaseOrder';
      $data['isi']          = 'Purchaseorder/Purchaseorder_export';
      $data['podata']       = $this->Purchaseorder_model->ViewGetPurchaseOrder()->result();
      $data['filenm']       = "purchase-order-transaction";
      $this->load->view('purchaseorder/Purchaseorder_export',$data);
    }
    else if (trim($uri) == "post") {

        //check data post or not
        $cek = $this->db->query("SELECT Status FROM T_PurchaseOrder WHERE PurchaseOrderID = '".$uri1."'");
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
      $pst = $this->db->query("SELECT PurchaseOrderID FROM T_PurchaseOrderDetail WHERE PurchaseOrderID = '".$uri1."' AND IsActive = 'Y' ");
        if ($pst->num_rows() == 0) {
            $jeson['status']   = "failed";
            $jeson['id']       = $uri;
            $jeson['msg']      = "Data Not Found";
            $jeson['caption']  = "Failed To Post, Please Insert Data Detail Purchase";
            
            header('Content-Type: text/html');
            echo json_encode($jeson);
            exit;
        }


        //sum detail PO
            $sum = $this->db->query("SELECT IFNULL(SUM(Total),0) AS TotalAmount 
                                     FROM   T_PurchaseOrderDetail 
                                     WHERE  PurchaseOrderID = '".trim($uri1)."'
                                            AND IsActive = 'Y'
                                     ");
              if ($sum->num_rows() > 0) {
                $res    = $sum->row();
                $sumtot = $res->TotalAmount;
              }
              else{
                $sumtot = 0;
              }


        $this->db->query("UPDATE  T_PurchaseOrder
                          SET     Status           = '5',
                                  TotalPurchase    = ".$sumtot.",
                                  LastUpdateDate   = '".$datetm."',
                                  LastUpdateBy     = '".$usernm."' 
                          WHERE   PurchaseOrderID  = '".$uri1."'
                        ");



        //update stock item
        $qry = $this->db->query(" SELECT  A.PurchaseOrderID, A.ItemID, A.PurchasePrice, A.Amount, A.Total,
                                          B.PurchaseDate, B.SupplierID
                                  FROM    T_PurchaseOrderDetail A 
                                  INNER   JOIN T_PurchaseOrder B ON A.PurchaseOrderID=B.PurchaseOrderID
                                  INNER   JOIN M_MasterItem C ON A.ItemID=C.ItemID
                                  WHERE   A.PurchaseOrderID ='".$uri1."' 
                                          AND A.IsActive ='Y'  

                                ");
        if ($qry->num_rows() > 0) {
          $res = $qry->result();
           foreach ($res as $key) {
              $sitem = $key->ItemID;
              $spco  = $key->PurchaseOrderID;
              $sstk  = $key->Amount;

              //update data item
              $this->db->query("  UPDATE  M_MasterItem
                                  SET     Stock                   = Stock + ".$sstk.",
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
        $cek = $this->db->query("SELECT Status FROM T_PurchaseOrder WHERE PurchaseOrderID = '".$uri1."'");
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


        $this->db->query("UPDATE  T_PurchaseOrder
                          SET     IsActive        = 'N',
                                  LastUpdateDate  = '".$datetm."',
                                  LastUpdateBy    = '".$usernm."' 
                          WHERE   PurchaseOrderID  = '".$uri1."'
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
        $cek = $this->db->query("SELECT Status FROM T_PurchaseOrder WHERE PurchaseOrderID = '".$uri1."'");
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



        $this->db->query("UPDATE  T_PurchaseOrderDetail
                          SET     IsActive          = 'N',
                                  LastUpdateDate    = '".$datetm."',
                                  LastUpdateBy      = '".$usernm."' 
                          WHERE   PurchaseOrderID   = '".$uri1."'
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
      $this->load->model('Purchaseorder_model');
      $data['title']        = 'Data PurchaseOrder';
      $data['isi']          = 'Purchaseorder/Purchaseorder_view';
      $data['podata']       = $this->Purchaseorder_model->ViewGetPurchaseOrder()->result();
      $this->load->view('purchaseorder/Purchaseorder_view',$data);
      //$this->load->view('layout/wrapper',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }


}