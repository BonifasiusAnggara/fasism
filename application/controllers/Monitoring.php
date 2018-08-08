<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends MY_Controller {

	public function __construct() {
    parent::__construct();
    $this->version = '2.01.01';
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model(array('Monitoring_model'));
  }

  public function index() {

  	$data['user'] = $this->session->userdata;

  	$this->app->view('templates/header', $data);
  	$this->app->view('Main/monitoring');
  	$this->app->view('templates/footer');
  }

  public function get_data_monitoring() {
    $result = $this->Monitoring_model->get_data_monitoring();
    return $result;
	}

	public function logout_user() {
    $result = $this->Monitoring_model->logout_user();
    return $result;
	}

}