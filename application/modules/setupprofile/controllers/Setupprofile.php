<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setupprofile extends CI_Controller {

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


  public function viewSetupProfile() {

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
      $file_element_name = 'photo';

      //code post 
      $stpidx    = $_POST["stpidx"];
      $stptitle  = $_POST["stptitle"];
      $stpname   = $_POST["stpname"];
      $stpdesc   = $_POST["stpdesc"];
      $stpimg    = $_POST["stpimg"];
     
      if ($status != "error") {
        $config['upload_path']   = './upload/profile/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 1024;
        $config['encrypt_name']  = FALSE;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file_element_name)) {
          $status = 'ok';
          $msg = $this->upload->display_errors('', '');

          $res = $this->db->query("SELECT SetupprofileID FROM M_Setupprofile WHERE SetupprofileID = '".$stpidx."'");
          if ($res->num_rows() > 0) {

              $this->db->query("
                                   UPDATE  M_Setupprofile
                                      SET     SetupTitle              = '".$stptitle."',
                                              SetupName               = '".$stpname."',
                                              SetupDescription        = '".$stpdesc."',
                                              SetupImageDasbor        = '".$stpimg."',
                                              IsActive                = 'Y',
                                              LastUpdateDate          = '".$datetm."',
                                              LastUpdateBy            = '".$usernm."'
                                      WHERE   SetupprofileID          = ".$stpidx."
                              ");
          } 
          else {

            //notif save error uload image null
            $jeson['status']   = "failed";
            $jeson['msg']      = "Profile Image, ".$msg;
            $jeson['focus']    = "photo";
            header('Content-Type: text/html');
            echo json_encode($jeson);
            exit;

        
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

          $ambil_gambar = $this->db->query("SELECT SetupImage, SetupprofileID FROM M_Setupprofile WHERE SetupprofileID =  '".$stpidx."'");
          if ($ambil_gambar->num_rows() > 0) {
            $rowf = $ambil_gambar->row();
            if($rowf->SetupImage != ""){
              if(file_exists("./upload/profile/".$rowf->SetupImage)){
                unlink("./upload/profile/".$rowf->SetupImage);
              }
            }


            $this->db->query("
                                    UPDATE  M_Setupprofile
                                      SET     SetupImage              = '".$data['file_name']."', 
                                              SetupTitle              = '".$stptitle."',
                                              SetupName               = '".$stpname."',
                                              SetupDescription        = '".$stpdesc."',
                                              SetupImageDasbor        = '".$stpimg."',
                                              IsActive                = 'Y',
                                              LastUpdateDate          = '".$datetm."',
                                              LastUpdateBy            = '".$usernm."'
                                      WHERE   SetupprofileID          = ".$stpidx."
                            ");
          } 
          else {
            
            $this->db->query("INSERT INTO M_Setupprofile
                                    ( SetupTitle, SetupName, SetupDescription, SetupImageDasbor, SetupImage, 
                                      IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate ) 
                              VALUES 
                                    ( '".$stptitle."', '".$stpname."', '".$stpdesc."',  '".$stpimg."', '".$data['file_name']."', 
                                      'Y', '".$usernm."', '".$datetm."', '".$usernm."',  '".$datetm."') 
                            ");
          }
        }
      }
      $jeson['status']   = $status;
      $jeson['id']       = $stpidx;
      $jeson['msg']      = "Profile Save ".$msg;
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
      $this->load->model('Setupprofile_model');
      $data['title']        = 'Data Setupprofile';
      $data['isi']          = 'setupprofile/Setupprofile_view';
      $data['itemdata']     = $this->Setupprofile_model->ViewGetSetupprofile()->result();
      $this->load->view('setupprofile/Setupprofile_view',$data);

    }

  }

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }
  

}