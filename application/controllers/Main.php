<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	protected $user_detail;

	public function __construct(){
		parent::__construct();
		$this->load->helper('cookie_helper');
	}

	public function login() {

		$post = $this->input->post(NULL,TRUE);

		if (isset($post['username'])) {
      $this->user_detail = $this->User_model->get_by(array('username'=>$post['username']), 1, NULL, TRUE);
    }

    $this->form_validation->set_message('required', '%s kosong, tolong diisi !');
    $rules = $this->User_model->rules;
    $this->form_validation->set_rules($rules);

    if ($this->form_validation->run() == FALSE) {
      $this->app->view('Main/login');
    }
    else {
      
      if ($this->agent->is_browser())
      {
        $agent = $this->agent->browser().' '.$this->agent->version();
      }
      elseif ($this->agent->is_robot())
      {
        $agent = $this->agent->robot();
      }
      elseif ($this->agent->is_mobile())
      {
        $agent = $this->agent->mobile();
      }
      else
      {
        $agent = 'Unidentified User Agent';
      }

      $last_login = date('Y-m-d H:i:s');

      $login_data = array(
        'user_id'=>$this->user_detail->user_id,
        'username'=>$post['username'],
        'logged_in'=>TRUE,
        'akses'=>$this->user_detail->akses,
        'active'=>$this->user_detail->active,
        'last_login'=>$last_login,
        'email'=>$this->user_detail->email,
        'pp_pict_filename'=>$this->user_detail->pp_pict_filename,
        'platform' => $this->agent->platform(),
        'browser' => $agent
      );

      $this->session->set_userdata($login_data);

      $raw = array('last_login'=>$last_login);
      $this->User_model->update($raw, array('user_id'=>$this->user_detail->user_id));

      if (isset($post['remember'])) {
        $expire = time() + (86400 * 7);
        set_cookie('username', $post['username'], $expire, "/");
        set_cookie('password', $post['password'], $expire, "/");
      }

      redirect(set_url('Dashboard'));
    }
  }

  public function logout() {
		$this->session->sess_destroy();
		delete_cookie('username'); delete_cookie('password');
		redirect("Main/login");
	}

	public function password_check($str) {
  	$user_detail =  $this->user_detail;  	
  	if (@$user_detail->password == crypt($str,@$user_detail->password)){
		  return TRUE;
		}
		else if(@$user_detail->password) {
			$this->form_validation->set_message('password_check', 'Passwordnya Anda salah...');
			return FALSE;
		}
		else {
			$this->form_validation->set_message('password_check', 'Anda tidak punya akses Admin...');
			return FALSE;	
		}		
  }

  public function user_active($str) {
    /* bisa digunakan untuk mengecek ke dalam database nantinya */
    if ($this->User_model->count(array('username' => $str)) > 0){
      $user_detail =  $this->user_detail;
      if ($user_detail->active != 1) {
        $this->form_validation->set_message('user_active', 'Akun anda belum aktif !');
        return FALSE;
      } else if($user_detail->active == 1) {
        return TRUE;
      }
    }
    else {
      $this->form_validation->set_message('user_active', 'Anda tidak mempunyai akses Admin !');
      return FALSE;
    }
  }

  public function error_403() {
    $data['user'] = $this->session->userdata;      
    $this->app->view('templates/header',$data);    
    $this->app->view('Main/error_403');
    $this->app->view('templates/footer');
  }

  public function error_404() {
    $data['user'] = $this->session->userdata;     
    $this->app->view('templates/header',$data);
    $this->app->view('Main/error_404');
    $this->app->view('templates/footer');
  }
  
}