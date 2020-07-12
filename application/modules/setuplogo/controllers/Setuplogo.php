<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setuplogo extends CI_Controller {

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


  public function viewSetupLogo() {

    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
   
    //get library
    $datetm     = date('Y-m-d H:i:s');
    $usernm     = $this->session->userdata('nama');

    if (trim($uri) == "save") {
      $status    = "";
      $msg       = "";
      $file_element_name = 'file';

      //code post 
      $stpidx    = $_POST["stpidx"];
     
     
      if ($status != "error") {
        $config['upload_path']   = './upload/logo/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 1024;
        $config['encrypt_name']  = FALSE;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file_element_name)) {
        
            //notif save error uload image null
            $msg = $this->upload->display_errors('', '');
            $jeson['status']   = "failed";
            $jeson['msg']      = "Logo Image, ".$msg;
            $jeson['focus']    = "photo";
            header('Content-Type: text/html');
            echo json_encode($jeson);
            exit;

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

          $ambil_gambar = $this->db->query("SELECT SetupImageLogo, SetupprofileID FROM M_Setupprofile WHERE SetupprofileID =  '".$stpidx."'");
          if ($ambil_gambar->num_rows() > 0) {
            $rowf = $ambil_gambar->row();
            if($rowf->SetupImageLogo != ""){
              if(file_exists("./upload/logo/".$rowf->SetupImageLogo)){
                unlink("./upload/logo/".$rowf->SetupImageLogo);
              }
            }


            $this->db->query("
                                    UPDATE    M_Setupprofile
                                      SET     SetupImageLogo          = '".$data['file_name']."', 
                                              IsActive                = 'Y',
                                              LastUpdateDate          = '".$datetm."',
                                              LastUpdateBy            = '".$usernm."'
                                      WHERE   SetupprofileID          = ".$stpidx."
                            ");
          } 
          else {
            
            $this->db->query("INSERT INTO M_Setupprofile
                                    ( SetupImageLogo, 
                                      IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate ) 
                              VALUES 
                                    ( '".$data['file_name']."', 
                                      'Y', '".$usernm."', '".$datetm."', '".$usernm."',  '".$datetm."') 
                            ");
          }
        }
      }
      $jeson['status']   = $status;
      $jeson['id']       = $stpidx;
      $jeson['msg']      = "Logo Save ".$msg;
      $jeson['notif']    = "Successfuly Saved !!!" . $msg;
      header('Content-Type: text/html');
      echo json_encode($jeson);
      exit;
    }
    //show data master group
    else if(trim($uri) == "view-ang"){
      $qry = $this->db->query("SELECT * FROM M_Setupprofile ");
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
    else
    {
      $this->load->model('Setuplogo_model');
      $data['title']        = 'Data Setup Logo';
      $data['isi']          = 'setuplogo/Setuplogo_view';
      $data['logodata']     = $this->Setuplogo_model->ViewGetSetuplogo()->result();
      $this->load->view('setuplogo/Setuplogo_view',$data);

    }

  }

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }
  

}