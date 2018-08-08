<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct() {
    parent::__construct();
    $this->version = '2.01.01';
    date_default_timezone_set('Asia/Jakarta');
    $this->data = array('user'=>$this->session->userdata);
    $this->user = $this->session->userdata();
  }

  public function index() {

  	if ($this->user['akses'] == 99) {
  		$raw['data'] = $this->User_model->get_user();
      $raw['jmldata'] = $this->User_model->count();
        
      $this->app->view('templates/header', $this->data);
	  	$this->app->view('User/index', $raw);
	  	$this->app->view('templates/footer');
      
  	} else {
			redirect("Main/error_403");
		}  	
  }

  public function profile($id) {
    $raw['user'] = $this->User_model->get_user(array('md5(user_id)'=>$id), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);

    $this->app->view('templates/header', $this->data);
    $this->app->view('User/profile', $raw);
    $this->app->view('templates/footer');
  }

  public function add() {
    if ($this->user['akses'] == 99) {
      $raw['pegawai'] = $this->Pegawai_model->get();
      $this->app->view('templates/header', $this->data);
      $this->app->view('User/add', $raw);
      $this->app->view('templates/footer');
    } else {
      redirect("Main/error_403");
    }
  }

  public function insert() {
    if ($this->user['akses'] == 99) {
      $post = $this->input->post(NULL,TRUE);
      $rules = $this->User_model->rules_register;
      $this->form_validation->set_rules($rules);

      if ($this->form_validation->run() == FALSE) {
        $raw['pegawai'] = $this->Pegawai_model->get();
        $this->app->view('templates/header', $this->data);
        $this->app->view('User/add', $raw);
        $this->app->view('templates/footer');
      } else {

        if (isset ($_FILES ['photo'] ['name']) && !empty($_FILES ['photo'] ['name'])) {
          // UPLOAD then RESIZE
          $upload['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/users_pict";
          $upload['allowed_types'] = 'jpg|png|jpeg|gif';
          $upload['overwrite'] = TRUE;
          $upload['max_size'] = '8000';
          $upload['file_name'] = $post['username'];

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

          $raw['pp_pict_filename'] = $file['orig_name'];      
        }

        $raw['created_by'] = $this->user['user_id'];
        $raw['peg_id'] = $post['peg_id'];
        $raw['username'] = $post['username'];
        $raw['password'] = bCrypt($post['password'],12);        
        $raw['email'] = $post['email'];
        $raw['akses'] = $post['akses'];
        $raw['title'] = $post['title'];

        $this->User_model->insert($raw);
        redirect("User");
      }
    } else {
      redirect("Main/error_403");
    }
  }

  public function edit($id) {
    if ($this->user['akses'] == 99) {
      $raw['users'] = $this->User_model->get_user(array('md5(user_id)'=>$id), 1, NULL, TRUE);
      $this->app->view('templates/header', $this->data);
      $this->app->view('User/edit', $raw);
      $this->app->view('templates/footer');
    } else {
      redirect("Main/error_403");
    }
  }

  public function update($id) {
    if ($this->user['akses'] == 99) {
      $post = $this->input->post(NULL,TRUE);

      if (isset ($_FILES ['photo'] ['name']) && !empty($_FILES ['photo'] ['name'])) {
        // UPLOAD then RESIZE
        $upload['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/users_pict";
        $upload['allowed_types'] = 'jpg|png|jpeg|gif';
        $upload['overwrite'] = TRUE;
        $upload['max_size'] = '8000';
        $upload['file_name'] = $post['username'];

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

        $raw['pp_pict_filename'] = $file['orig_name'];      
      }

      $raw['password'] = bCrypt($post['password'],12);
      $raw['akses'] = $post['akses'];
      $raw['title'] = $post['title'];

      $this->User_model->update($raw, array('md5(user_id)'=>$id));
      redirect("User");
    } 
      else {
      redirect("Main/error_403");
    }
  }

  public function activate($id) {
    if ($this->user['akses'] == 99) {
      $raw['active'] = '1';
      $this->User_model->update($raw, array('md5(user_id)'=>$id));
      redirect("User");
    } else {
      redirect("Main/error_403");
    }
  }

  public function deactivate($id) {
    if ($this->user['akses'] == 99) {
      $raw['active'] = '0';
      $this->User_model->update($raw, array('md5(user_id)'=>$id));
      redirect("User");
    } else {
      redirect("Main/error_403");
    }
  }

  public function delete($id) {
    if ($this->user['akses'] == 99) {
      $user = $this->User_model->get_by(array('user_id'=>base64_decode($id)),1,NULL,TRUE);
      unlink("uploads/users_pict/".$user->pp_pict_filename);
      $this->User_model->delete(base64_decode($id));
      redirect("User");
    } else {
      redirect("Main/error_403");
    }
  }

  public function pegawai_check($str){
    /* bisa digunakan untuk mengecek ke dalam database nantinya */
    if ($this->User_model->count(array('peg_id' => $str)) > 0){
      $this->form_validation->set_message('pegawai_check', 'Pegawai ini sudah memiliki akun, mohon diganti yang lain...');
      return FALSE;
    } else{
      return TRUE;
    }
  }

  public function username_check($str){
    /* bisa digunakan untuk mengecek ke dalam database nantinya */
    if ($this->User_model->count(array('username' => $str)) > 0){
      $this->form_validation->set_message('username_check', 'Username ini sudah digunakan, mohon diganti yang lain...');
      return FALSE;
    } else {
      return TRUE;
    }
  }

  public function email_check($str){
    /* bisa digunakan untuk mengecek ke dalam database nantinya */
    if ($this->User_model->count(array('email' => $str)) > 0){
      $this->form_validation->set_message('email_check', 'Email ini sudah digunakan, mohon diganti yang lain...');
      return FALSE;
    } else {
      return TRUE;
    }
  }

}