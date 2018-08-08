<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MHE extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->version = '2.01.01';
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model(array('MHE_model','Vendor_model','Maintenance_model','Sparepart_mhe_model','Sparepart_rec_model'));
    $this->load->helper('cookie_helper');

    $this->user = $this->session->userdata();
    $this->data = array('user'=>$this->session->userdata);
  }

  public function index() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
  	$raw['data'] = $this->MHE_model->get();
    $raw['jmldata'] = $this->MHE_model->count();
      
    $this->app->view('templates/header', $this->data);
  	$this->app->view('MHE/index', $raw);
  	$this->app->view('templates/footer');
  }

  public function add() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
    if (($this->user['akses'] == 99) || ($raw['user_detail']->dir_id == 4)) {
      $this->app->view('templates/header', $this->data);
      $this->app->view('MHE/add');
      $this->app->view('templates/footer');
    } else {
			redirect("Main/error_403");
		}
  }

  public function insert() {
  	$row['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $row['user_detail'] = (object)$this->Pegawai_model->get_user_detail($row['user']->peg_id);
    if (($this->user['akses'] == 99) || ($row['user_detail']->dir_id == 4)) {
      $post = $this->input->post(NULL,TRUE);

      if (isset ($_FILES ['photo'] ['name']) && !empty($_FILES ['photo'] ['name'])) {
        // UPLOAD then RESIZE
        $upload['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/photo_mhe";
        $upload['allowed_types'] = 'jpg|png|jpeg|gif';
        $upload['overwrite'] = TRUE;
        $upload['max_size'] = '8000';
        $upload['file_name'] = $post['no_seri'];

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
      $raw['no_seri'] = $post['no_seri'];
      $raw['jenis'] = $post['jenis'];
      $raw['merk'] = $post['merk'];        
      $raw['type'] = strtoupper($post['type']);
      $raw['thn_pembuatan'] = $post['thn_pembuatan'];
      $raw['keterangan'] = $post['keterangan'];

      $this->MHE_model->insert($raw);
      redirect("MHE");
    } else {
			redirect("Main/error_403");
		}
  }

  public function insert_kontrak() {
    $row['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $row['user_detail'] = (object)$this->Pegawai_model->get_user_detail($row['user']->peg_id);
    if (($this->user['akses'] == 99) || ($row['user_detail']->dir_id == 4)) {
      $post = $this->input->post(NULL,TRUE);
      
      if (isset ($_FILES ['pdf'] ['name']) && !empty($_FILES ['pdf'] ['name'])) {
        // UPLOAD then RESIZE
        $upload['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf_kontrak";
        $upload['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
        $upload['overwrite'] = TRUE;
        $upload['max_size'] = '8000';
        $upload['file_name'] = strtoupper($post['no_kontrak']);

        $this->load->library('upload',$upload);
        $this->upload->do_upload('pdf');

        $file = $this->upload->data();
        $raw['pdf_kontrak'] = $file['orig_name'];      
      }

      $raw['edited_by'] = $this->user['user_id'];
      $raw['edited_on'] = date('Y-m-d H:i:s');
      $raw['no_kontrak'] = strtoupper($post['no_kontrak']);

      $this->MHE_model->update($raw, array('mhe_id'=>$post['mhe_id']));
      redirect("MHE");
    } else {
      redirect("Main/error_403");
    }
  }

  public function edit($id) {
  	$row['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $row['user_detail'] = (object)$this->Pegawai_model->get_user_detail($row['user']->peg_id);
    if (($this->user['akses'] == 99) || ($row['user_detail']->dir_id == 4)) {
      $raw['mhe'] = $this->MHE_model->get_by(array('md5(mhe_id)'=>$id), 1, NULL, TRUE);
      $this->app->view('templates/header', $this->data);
      $this->app->view('MHE/edit', $raw);
      $this->app->view('templates/footer');
    } else {
      redirect("Main/error_403");
    }
  }

  public function update($id) {
  	$row['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $row['user_detail'] = (object)$this->Pegawai_model->get_user_detail($row['user']->peg_id);

    if (($this->user['akses'] == 99) || ($row['user_detail']->dir_id == 4)) {
      $post = $this->input->post(NULL,TRUE);

      if (isset ($_FILES ['photo'] ['name']) && !empty($_FILES ['photo'] ['name'])) {
        // UPLOAD then RESIZE
        $upload['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/photo_mhe";
        $upload['allowed_types'] = 'jpg|png|jpeg|gif';
        $upload['overwrite'] = TRUE;
        $upload['max_size'] = '8000';
        $upload['file_name'] = $post['no_seri'];

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

      $raw['edited_by'] = $this->user['user_id'];
      $raw['edited_on'] = date('Y-m-d H:i:s');
      $raw['no_seri'] = $post['no_seri'];
      $raw['jenis'] = $post['jenis'];
      $raw['merk'] = $post['merk'];        
      $raw['type'] = strtoupper($post['type']);
      $raw['thn_pembuatan'] = $post['thn_pembuatan'];
      $raw['keterangan'] = $post['keterangan'];

      $this->MHE_model->update($raw, array('md5(mhe_id)'=>$id));
      redirect("MHE");
    } else {
      redirect("Main/error_403");
    }
  }

  public function delete($id) {
    if ($this->user['akses'] == 99) {
      $mhe = $this->MHE_model->get_by(array('mhe_id'=>base64_decode($id)),1,NULL,TRUE);
      unlink("uploads/photo_mhe/".$mhe->photo_filename);
      unlink("uploads/pdf_kontrak/".$mhe->pdf_kontrak);
      $this->MHE_model->delete(base64_decode($id));
      $this->Sparepart_rec_model->delete_by(array('mhe_id'=>base64_decode($id)));
      $this->Maintenance_model->delete_by(array('mhe_id'=>base64_decode($id)));
      redirect("MHE");
    } else {
      redirect("Main/error_403");
    }
  }

  public function maintenance_record($id) {
    $raw['mhe'] = $this->MHE_model->get_by(array('mhe_id'=>base64_decode($id)), 1, NULL, TRUE);
    $raw['mtc'] = $this->Maintenance_model->get_by(array('mhe_id'=>base64_decode($id)), FALSE, NULL, FALSE);
    $raw['jmldata'] = $this->Maintenance_model->count();
    $raw['vendor'] = $this->Vendor_model->get();
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
    $this->app->view('templates/header', $this->data);
    $this->app->view('MHE/maintenance', $raw);
    $this->app->view('templates/footer');
  }

  public function add_mtc() {
  	$row['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $row['user_detail'] = (object)$this->Pegawai_model->get_user_detail($row['user']->peg_id);
    if (($this->user['akses'] == 99) || ($row['user_detail']->dir_id == 4)) {
      $post = $this->input->post(NULL,TRUE);

      if (isset ($_FILES ['pdf'] ['name']) && !empty($_FILES ['pdf'] ['name'])) {
        // UPLOAD then RESIZE
        $upload['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf_maintenance";
        $upload['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
        $upload['overwrite'] = TRUE;
        $upload['max_size'] = '8000';
        $upload['file_name'] = strtoupper($post['no_spk']);

        $this->load->library('upload',$upload);
        $this->upload->do_upload('pdf');

        $file = $this->upload->data();
        $raw['pdf_maintenance'] = $file['orig_name'];      
      }

      $raw['created_by'] = $this->user['user_id'];
      $raw['mhe_id'] = $post['mhe_id'];
      $raw['no_spk'] = strtoupper($post['no_spk']);
      $raw['jenis'] = $post['jenis'];
      $raw['tanggal'] = $post['tanggal'];        
      $raw['vendor'] = $post['vendor'];
      $raw['nama_teknisi'] = $post['nama_teknisi'];
      $raw['catatan'] = $post['catatan'];

      $this->Maintenance_model->insert($raw);
      redirect(set_url('MHE/maintenance_record/'.base64_encode($post['mhe_id'])));
    } else {
			redirect("Main/error_403");
		}
  }

  public function edit_mtc() {
    $row['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $row['user_detail'] = (object)$this->Pegawai_model->get_user_detail($row['user']->peg_id);
    if (($this->user['akses'] == 99) || ($row['user_detail']->dir_id == 4)) {
      $post = $this->input->post(NULL,TRUE);

      if (isset ($_FILES ['pdf'] ['name']) && !empty($_FILES ['pdf'] ['name'])) {
        // UPLOAD then RESIZE
        $upload['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf_maintenance";
        $upload['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
        $upload['overwrite'] = TRUE;
        $upload['max_size'] = '8000';
        $upload['file_name'] = strtoupper($post['no_spk']);

        $this->load->library('upload',$upload);
        $this->upload->do_upload('pdf');

        $file = $this->upload->data();
        $raw['pdf_maintenance'] = $file['orig_name'];      
      }

      $raw['edited_by'] = $this->user['user_id'];
      $raw['edited_on'] = date('Y-m-d H:i:s');
      $raw['no_spk'] = strtoupper($post['no_spk']);
      $raw['jenis'] = $post['jenis'];
      $raw['tanggal'] = $post['tanggal'];        
      $raw['vendor'] = strtoupper($post['vendor']);
      $raw['nama_teknisi'] = $post['nama_teknisi'];
      $raw['catatan'] = $post['catatan'];

      $this->Maintenance_model->update($raw, array('mtc_id'=>$post['mtc_id']));
      redirect(set_url('MHE/maintenance_record/'.base64_encode($post['mhe_id'])));
    } else {
      redirect("Main/error_403");
    }
  }

  public function delete_mtc($id) {
    if ($this->user['akses'] == 99) {
      $mtc = $this->Maintenance_model->get_by(array('mtc_id'=>base64_decode($id)),1,NULL,TRUE);
      unlink("uploads/pdf_maintenance/".$mtc->pdf_maintenance);
      $this->Maintenance_model->delete(base64_decode($id));
      redirect(set_url('MHE/maintenance_record/'.base64_encode($mtc->mhe_id)));
    } else {
      redirect("Main/error_403");
    }
  }

  public function sparepart_record($id) {
    $raw['mhe'] = $this->MHE_model->get_by(array('mhe_id'=>base64_decode($id)), 1, NULL, TRUE);
    $raw['sprec'] = $this->Sparepart_rec_model->get_by(array('mhe_id'=>base64_decode($id)), FALSE, NULL, FALSE);
    $raw['jmldata'] = $this->Sparepart_mhe_model->count();

    foreach ($raw['sprec'] as $key) {
      $arr_id = unserialize($key->sparepart);
      $arr1[] = $this->Sparepart_mhe_model->get_sparepart_by_id($arr_id);
    }

    if (isset($arr1)) { $raw['spareparts'] = $arr1; }
    else { $raw['spareparts'] = array(''); }

    $raw['sprt'] = $this->Sparepart_mhe_model->get();
    $raw['vendor'] = $this->Vendor_model->get();
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
    $this->app->view('templates/header', $this->data);
    $this->app->view('MHE/sparepart', $raw);
    $this->app->view('templates/footer');
  }

  public function add_sprec() {
    $row['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $row['user_detail'] = (object)$this->Pegawai_model->get_user_detail($row['user']->peg_id);
    if (($this->user['akses'] == 99) || ($row['user_detail']->dir_id == 4)) {
      $post = $this->input->post(NULL,TRUE);

      if (isset ($_FILES ['pdf'] ['name']) && !empty($_FILES ['pdf'] ['name'])) {
        // UPLOAD then RESIZE
        $upload['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf_sprec";
        $upload['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
        $upload['overwrite'] = TRUE;
        $upload['max_size'] = '8000';
        $upload['file_name'] = strtoupper($post['no_spk']);

        $this->load->library('upload',$upload);
        $this->upload->do_upload('pdf');

        $file = $this->upload->data();
        $raw['pdf_sprec'] = $file['orig_name'];      
      }

      $raw['created_by'] = $this->user['user_id'];
      $raw['mhe_id'] = $post['mhe_id'];
      $raw['no_spk'] = strtoupper($post['no_spk']);
      $raw['sparepart'] = serialize($post['sparepart']);
      $raw['tanggal'] = $post['tanggal'];       
      $raw['vendor'] = $post['vendor'];
      $raw['nama_teknisi'] = $post['nama_teknisi'];       
      $raw['biaya'] = $post['biaya'];
      $raw['catatan'] = $post['catatan'];

      $this->Sparepart_rec_model->insert($raw);
      redirect(set_url('MHE/sparepart_record/'.base64_encode($post['mhe_id'])));
    } else {
      redirect("Main/error_403");
    }
  }

  public function edit_sprec() {
    $row['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $row['user_detail'] = (object)$this->Pegawai_model->get_user_detail($row['user']->peg_id);
    if (($this->user['akses'] == 99) || ($row['user_detail']->dir_id == 4)) {
      $post = $this->input->post(NULL,TRUE);

      if (isset ($_FILES ['pdf'] ['name']) && !empty($_FILES ['pdf'] ['name'])) {
        // UPLOAD then RESIZE
        $upload['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf_sprec";
        $upload['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
        $upload['overwrite'] = TRUE;
        $upload['max_size'] = '8000';
        $upload['file_name'] = strtoupper($post['no_spk']);

        $this->load->library('upload',$upload);
        $this->upload->do_upload('pdf');

        $file = $this->upload->data();
        $raw['pdf_sprec'] = $file['orig_name'];      
      }

      $raw['edited_by'] = $this->user['user_id'];
      $raw['edited_on'] = date('Y-m-d H:i:s');
      $raw['no_spk'] = strtoupper($post['no_spk']);
      $raw['sparepart'] = serialize($post['sparepart']);
      $raw['tanggal'] = $post['tanggal'];       
      $raw['vendor'] = $post['vendor'];
      $raw['nama_teknisi'] = $post['nama_teknisi'];       
      $raw['biaya'] = $post['biaya'];
      $raw['catatan'] = $post['catatan'];

      $this->Sparepart_rec_model->update($raw, array('sprec_id'=>$post['sprec_id']));
      redirect(set_url('MHE/sparepart_record/'.base64_encode($post['mhe_id'])));
    } else {
      redirect("Main/error_403");
    }
  }

  public function delete_sprec($id) {
    if ($this->user['akses'] == 99) {
      $mtc = $this->Sparepart_rec_model->get_by(array('sprec_id'=>base64_decode($id)),1,NULL,TRUE);
      unlink("uploads/pdf_sprec/".$mtc->pdf_sprec);
      $this->Sparepart_rec_model->delete(base64_decode($id));
      redirect(set_url('MHE/sparepart_record/'.base64_encode($mtc->mhe_id)));
    } else {
      redirect("Main/error_403");
    }
  }
  
}