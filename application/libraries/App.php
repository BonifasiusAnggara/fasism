<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App {

  function view($pages, $data=NULL) {
    $_this =& get_instance();

    $data ?
      $_this->load->view($pages, $data)
      :
      $_this->load->view($pages);
  }

  function is_logged_in() {
    $_this =& get_instance();

    $user_session = $_this->session->userdata;

    if ($_this->uri->segment(2) == 'login') {
      if (isset($user_session['logged_in']) && $user_session['logged_in'] == TRUE) {
        redirect(set_url('Dashboard'));
      }
    } else {
      if (!isset($user_session['logged_in'])) {
        $_this->session->sess_destroy();
        redirect(set_url('Main/login'));
      }
    }
  }
}