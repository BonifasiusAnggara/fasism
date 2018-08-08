<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Sparepart_mhe extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->version = '2.01.01';
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model(array('Sparepart_mhe_model'));

		$this->user = $this->session->userdata();
		$this->data = array('user'=>$this->session->userdata);
	}

	public function index() {
		$raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']),1,NULL,TRUE);
		$raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->user_id);
		$raw['data'] = $this->Sparepart_mhe_model->get();
		$raw['jmldata'] = $this->Sparepart_mhe_model->count();

		$this->app->view('Templates/header', $this->data);
		$this->app->view('Sparepart_mhe/index', $raw);
		$this->app->view('Templates/footer');
	}

	public function insert() {
  	$row['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $row['user_detail'] = (object)$this->Pegawai_model->get_user_detail($row['user']->peg_id);
    if (($this->user['akses'] == 99) || ($row['user_detail']->dir_id == 4)) {
      $post = $this->input->post(NULL,TRUE);

      if (isset ($_FILES ['photo'] ['name']) && !empty($_FILES ['photo'] ['name'])) {
        // UPLOAD then RESIZE
        $upload['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/photo_sprt_mhe";
        $upload['allowed_types'] = 'jpg|png|jpeg|gif';
        $upload['overwrite'] = TRUE;
        $upload['max_size'] = '8000';
        $upload['file_name'] = $post['nama_sprt'];

        $this->load->library('upload',$upload);
        $this->upload->do_upload('photo');

        $file = $this->upload->data();

        $edit['source_image'] = $this->upload->upload_path.$this->upload->file_name;
        $edit['maintain_ratio'] = FALSE;
        $edit['width'] = 250;
        $edit['height'] = 300;

        $this->load->library('image_lib');
        $this->image_lib->clear();
        $this->image_lib->initialize($edit);
        $this->image_lib-> resize();

        $raw['photo_filename'] = $file['orig_name'];      
      }

      $raw['created_by'] = $this->user['user_id'];
      $raw['nama_sprt'] = $post['nama_sprt'];
      $raw['harga_sprt'] = $post['harga_sprt'];

      $this->Sparepart_mhe_model->insert($raw);
      redirect("Sparepart_mhe");
    } else {
			redirect("Main/error_403");
		}
  }

  public function update() {
  	$row['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $row['user_detail'] = (object)$this->Pegawai_model->get_user_detail($row['user']->peg_id);
    if (($this->user['akses'] == 99) || ($row['user_detail']->dir_id == 4)) {
      $post = $this->input->post(NULL,TRUE);

      if (isset ($_FILES ['photo'] ['name']) && !empty($_FILES ['photo'] ['name'])) {
        // UPLOAD then RESIZE
        $upload['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/photo_sprt_mhe";
        $upload['allowed_types'] = 'jpg|png|jpeg|gif';
        $upload['overwrite'] = TRUE;
        $upload['max_size'] = '8000';
        $upload['file_name'] = $post['nama_sprt'];

        $this->load->library('upload',$upload);
        $this->upload->do_upload('photo');

        $file = $this->upload->data();

        $edit['source_image'] = $this->upload->upload_path.$this->upload->file_name;
        $edit['maintain_ratio'] = FALSE;
        $edit['width'] = 250;
        $edit['height'] = 300;

        $this->load->library('image_lib');
        $this->image_lib->clear();
        $this->image_lib->initialize($edit);
        $this->image_lib-> resize();

        $raw['photo_filename'] = $file['orig_name'];      
      }

      $raw['created_by'] = $this->user['user_id'];
      $raw['nama_sprt'] = $post['nama_sprt'];
      $raw['harga_sprt'] = $post['harga_sprt'];

      $this->Sparepart_mhe_model->update($raw, array('sprt_id'=>$post['sprt_id']));
      redirect("Sparepart_mhe");
    } else {
			redirect("Main/error_403");
		}
  }

  public function delete($id) {
    if ($this->user['akses'] == 99) {
      $mhe = $this->Sparepart_mhe_model->get_by(array('sprt_id'=>base64_decode($id)),1,NULL,TRUE);
      $this->Sparepart_mhe_model->delete(base64_decode($id));
      redirect("Sparepart_mhe");
    } else {
      redirect("Main/error_403");
    }
  }

}