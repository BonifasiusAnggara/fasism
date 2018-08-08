<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->version = '2.01.01';
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model(array('Direktorat_model'));
    $this->load->helper('cookie_helper');

    $this->user = $this->session->userdata();
    $this->data = array('user'=>$this->session->userdata);
  }

  public function index() {  

  	if ($this->user['akses'] == 99) {
      $raw['data'] = $this->Pegawai_model->get_peg_detail();
      $raw['jmldata'] = $this->Pegawai_model->count();
        
      $this->app->view('templates/header', $this->data);
	  	$this->app->view('Pegawai/index', $raw);
	  	$this->app->view('templates/footer');
      
  	} else {
			redirect("Main/error_403");
		}
	}

  public function add() {
    if ($this->user['akses'] == 99) {
      $raw['direktorat'] = $this->Direktorat_model->get();
      $this->app->view('templates/header', $this->data);
      $this->app->view('Pegawai/add', $raw);
      $this->app->view('templates/footer');
    }
  }

  public function insert() {
    if ($this->user['akses'] == 99) {
      $post = $this->input->post(NULL,TRUE);
      $rules = $this->Pegawai_model->rules_register;
      $this->form_validation->set_rules($rules);

      if ($this->form_validation->run() == FALSE) {
        $raw['direktorat'] = $this->Direktorat_model->get();
        $this->app->view('templates/header', $this->data);
        $this->app->view('Pegawai/add', $raw);
        $this->app->view('templates/footer');
      } else {
        $raw = array(
          'created_by'=>$this->user['user_id'],
          'nama_depan'=>$post['nama_depan'],
          'nama_belakang'=>$post['nama_belakang'],
          'NIK'=>$post['NIK'],
          'dir_id'=>$post['direktorat'],
          'jabatan'=>$post['jabatan'],
          'jenis_kelamin'=>$post['jenis_kelamin'],
          'tempat_lahir'=>$post['tempat_lahir'],
          'tanggal_lahir'=>$post['tanggal_lahir'],
          'handphone'=>$post['handphone'],
          'alamat'=>$post['alamat']
        );
        $this->Pegawai_model->insert($raw);
        redirect("Pegawai");
      }
    }
  }

  public function edit($id) {
    if ($this->user['akses'] == 99) {
      $raw['direktorat'] = $this->Direktorat_model->get();
      $raw['pegawai'] = $this->Pegawai_model->get_by(array('md5(peg_id)'=>$id), 1, NULL, TRUE);
      $raw['peg_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['pegawai']->peg_id);
      $this->app->view('templates/header', $this->data);
      $this->app->view('Pegawai/edit', $raw);
      $this->app->view('templates/footer');
    }
  }

  public function update($id) {
    $post = $this->input->post(NULL,TRUE);
    $raw = array(
      'nama_depan'=>$post['nama_depan'],
      'nama_belakang'=>$post['nama_belakang'],
      'dir_id'=>$post['direktorat'],
      'jabatan'=>$post['jabatan'],
      'jenis_kelamin'=>$post['jenis_kelamin'],
      'tempat_lahir'=>$post['tempat_lahir'],
      'tanggal_lahir'=>$post['tanggal_lahir'],
      'handphone'=>$post['handphone'],
      'alamat'=>$post['alamat']
    );
    $this->Pegawai_model->update($raw, array('md5(peg_id)'=>$id));
    redirect("Pegawai");
  }

  public function delete($id) {
    if ($this->user['akses'] == 99) {
      $this->Pegawai_model->delete(base64_decode($id));
      $this->User_model->delete_by(array('peg_id'=>base64_decode($id)));
      redirect("Pegawai");
    }
  }

  public function nik_check($str){
    /* bisa digunakan untuk mengecek ke dalam database nantinya */
    if ($this->Pegawai_model->count(array('NIK' => $str)) > 0){
      $this->form_validation->set_message('nik_check', 'NIK sudah digunakan, mohon diganti yang lain...');
      return FALSE;
    }
    else{
      return TRUE;
    }
  }
}