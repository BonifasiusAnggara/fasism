<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterRetur extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->version = '2.01.01';
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model(array('Register_model', 'User_model', 'Pegawai_model','Customer_ski_model','Direktorat_model'));
    $this->load->helper('cookie_helper');
    $this->load->library('Email');

    $this->user = $this->session->userdata();
    $this->data = array('user'=>$this->session->userdata);
  }

  public function index() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
  	$raw['data'] = $this->Register_model->get_register_detail();
    $raw['cust'] = $this->Customer_ski_model->get();
    $raw['direktorat'] = $this->Direktorat_model->get();
    $raw['jmldata'] = $this->Register_model->count();
      
    $this->app->view('templates/header', $this->data);
  	$this->app->view('RegisterRetur/index', $raw);
  	$this->app->view('templates/footer');
  }

  public function add() {    
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
    $row['cust'] = $this->Customer_ski_model->get();
    $row['direktorat'] = $this->Direktorat_model->get();

    if (($raw['user_detail']->dir_id == 5) || ($this->user['akses'] == 99)) {
      $this->app->view('templates/header', $this->data);
      $this->app->view('RegisterRetur/add', $row);
      $this->app->view('templates/footer');
    } else {
      redirect("Main/error_403");
    }    
  }

  public function insert() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);

    if (($raw['user_detail']->dir_id == 5) || ($this->user['akses'] == 99)) {
      $post = $this->input->post(NULL,TRUE);
      $rules = $this->Register_model->rules_register;
      $this->form_validation->set_rules($rules);

      if ($this->form_validation->run() == FALSE) {
        $this->app->view('templates/header', $this->data);
        $this->app->view('RegisterRetur/add', $raw);
        $this->app->view('templates/footer');
      } else {

      	$date = date('Y-m-d');
      	$row = array(
      		'created_by'=>$this->user['user_id'],
      		'no_rtv'=>$post['no_rtv'],
      		'cust_no'=>$post['cust_no'],
      		'cabang_chs'=>$post['cabang_chs'],
      		'dir_id'=>$post['dir_id'],
      		'nama_driver'=>$post['nama_driver'],
      		'tgl_retur'=>$date
      	);

        $this->Register_model->insert($row);
        redirect("RegisterRetur");
      }
    } else {
      redirect("Main/error_403");
    }
  }

  public function edit_retur() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);

    if (($raw['user_detail']->dir_id == 4) || ($raw['user_detail']->dir_id == 5) || ($this->user['akses'] == 99)) {
      $post = $this->input->post(NULL,TRUE);
        
      $row = array(
    		'cust_no'=>$post['cust_no'],
    		'cabang_chs'=>$post['cabang_chs'],
    		'dir_id'=>$post['dir_id'],
    		'nama_driver'=>$post['nama_driver'],
    		'pet_retur'=>$post['pet_retur']
    	);

      $this->Register_model->update($row, array('reg_id'=>$post['reg_id']));
      redirect("RegisterRetur");

    } else {
      redirect("Main/error_403");
    }
  }

  public function approve() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);

    if (($raw['user_detail']->dir_id == 4) || ($this->user['akses'] == 99)) {
      $post = $this->input->post(NULL,TRUE);
      
      $date = date('Y-m-d');
      $row = array(
    		'pet_retur'=>$post['pet_retur'],
    		'tgl_trm_gudang'=>$date
    	);

      $this->Register_model->update($row, array('reg_id'=>$post['reg_id']));
      redirect("RegisterRetur");

    } else {
      redirect("Main/error_403");
    }
  }

  public function delete($id) {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);

    if (($this->user['akses'] == 99) || ($raw['user_detail']->dir_id == 4) || ($raw['user_detail']->dir_id == 5)) {
      $this->Register_model->delete(base64_decode($id));
      redirect("RegisterRetur");
    } else {
      redirect("Main/error_403");
    }
  }

  public function rtv_check($str){
    /* bisa digunakan untuk mengecek ke dalam database nantinya */
    if ($this->Register_model->count(array('no_rtv' => $str)) > 0){
      $this->form_validation->set_message('rtv_check', 'No. RTV ini sudah ada, mohon diganti yang lain...');
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

}