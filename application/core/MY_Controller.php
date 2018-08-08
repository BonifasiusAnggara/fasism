<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	function __construct() {

		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(array('form','security','user_helper','app_helper'));
		$this->load->library(array('Form_validation','App','Pagination','Links'));
		$this->load->model(array('User_model','Pegawai_model'));

		$this->app->is_logged_in();
	}

}