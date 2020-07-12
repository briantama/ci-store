<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

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


  public function viewProfile() {

    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
   
    //get library
    $datetm     = date('Y-m-d H:i:s');
    $usernm     = $this->session->userdata('nama');

    if (trim($uri) == "save") 
    {
     
      $status = "";
      $msg    = "";
      $file_element_name = 'file';
      if ($status != "error") {
        $config['upload_path']   = './upload/user/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 1024;
        $config['encrypt_name']  = FALSE;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload($file_element_name)) {

          $status = 'ok';
          $msg    = $this->upload->display_errors('', '');

          
          $data = $this->upload->data();
          $image_path = $data['full_path'];
          if(file_exists($image_path)) {
            $status = "ok";
            $msg    = "Upload gambar berhasil";
          } else {
            $status = "ok";
            $msg    = "Terjadi kesalahan. Ulangi lagi.";
          }
          $ambil_gambar = $this->db->query("SELECT AdminImage, UserName FROM M_User WHERE UserName = '".$usernm."'")->row();
          if ($usernm != "") 
          {
            if($ambil_gambar->AdminImage != ""){
              unlink("./upload/user/".$ambil_gambar->AdminImage);
            }
            $this->db->query("UPDATE  M_User
                                      SET     AdminImage         = '".$data['file_name']."',
                                              LastUpdateDate     = '".$datetm."',
                                              LastUpdateBy       = '".$usernm."'
                                      WHERE   UserName           = '".$usernm."'
                            ");
          } 
        }

      }

      $jeson['status']   = $status;
      $jeson['id']       = $usernm;
      $jeson['msg']      = "Profile Image ".$msg;
      $jeson['notif']    = "Successfuly Saved !!!";
      header('Content-Type: text/html');
      echo json_encode($jeson);
      exit;
    }
    //show data master group
    else if(trim($uri) == "view-ang"){
      $qry = $this->db->query("SELECT * FROM M_User WHERE UserName = '".$usernm."'");
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
      $usernm     = $this->session->userdata('nama');
      $where = array(
        'Username' => $usernm
        );
      $this->load->model('Profile_model');
      $data=array('title'=>'Data Profile',
                  'isi'  =>'profile/Profile_view' 
                );
      $data['dataAdmin'] = $this->Profile_model->getAdmin($where, "M_User")->result();  
      //$this->load->view('admin/layout/wrapper',$data);  
      $this->load->view('profile/Profile_view',$data);

    }

  }

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }
  

}