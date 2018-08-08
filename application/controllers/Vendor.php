<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Vendor extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->version = '2.01.01';
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model(array('Vendor_model'));

		$this->user = $this->session->userdata();
		$this->data = array('user'=>$this->session->userdata);
	}

	public function index() {
		$raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']),1,NULL,TRUE);
		$raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->user_id);
		$raw['data'] = $this->Vendor_model->get();
		$raw['jmldata'] = $this->Vendor_model->count();

		$this->app->view('Templates/header', $this->data);
		$this->app->view('Vendor/index', $raw);
		$this->app->view('Templates/footer');
	}

	public function insert() {
  	$row['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $row['user_detail'] = (object)$this->Pegawai_model->get_user_detail($row['user']->peg_id);
    if (($this->user['akses'] == 99) || ($row['user_detail']->dir_id == 4)) {
      $post = $this->input->post(NULL,TRUE);

      $raw['created_by'] = $this->user['user_id'];
      $raw['nama_vendor'] = strtoupper($post['nama_vendor']);
      $raw['alamat'] = $post['alamat'];

      $this->Vendor_model->insert($raw);
      redirect("Vendor");
    } else {
			redirect("Main/error_403");
		}
  }

  public function update() {
  	$row['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $row['user_detail'] = (object)$this->Pegawai_model->get_user_detail($row['user']->peg_id);

    if (($this->user['akses'] == 99) || ($row['user_detail']->dir_id == 4)) {
      $post = $this->input->post(NULL,TRUE);

      $raw['nama_vendor'] = strtoupper($post['nama_vendor']);
      $raw['alamat'] = $post['alamat'];

      $this->Vendor_model->update($raw, array('vdr_id'=>$post['vdr_id']));
      redirect("Vendor");
    } else {
      redirect("Main/error_403");
    }
  }

  public function delete($id) {
    if ($this->user['akses'] == 99) {
      $mhe = $this->Vendor_model->get_by(array('vdr_id'=>base64_decode($id)),1,NULL,TRUE);
      $this->Vendor_model->delete(base64_decode($id));
      redirect("Vendor");
    } else {
      redirect("Main/error_403");
    }
  }
}