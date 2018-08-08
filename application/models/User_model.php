<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model {
	
	protected $_table_name = 'user';
	protected $_primary_key = 'user_id';
	protected $_order_by = 'user_id';
	protected $_order_by_type = 'DESC';

	public $rules = array(
		'username' => array(
      'field' => 'username',
      'rules' => 'trim|required|xss_clean|callback_user_active'
		), 
		'password' => array(
			'field' => 'password',
			'rules' => 'trim|required|xss_clean|callback_password_check'
		)
	);	

	public $rules_register = array(
		'peg_id' => array(
      'field' => 'peg_id',
      'label' => 'Pegawai',
      'rules' => 'trim|required|callback_pegawai_check'
		),
		'username' => array(
      'field' => 'username',
      'label' => 'Username',
      'rules' => 'trim|required|callback_username_check'
		),
		'email' => array(
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'trim|required|valid_email|callback_email_check'
		),
	);

	public function __construct() {
		parent::__construct();
	}

	public function get_user($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->join('{PRE}pegawai', '{PRE}user.peg_id  = {PRE}pegawai.peg_id', 'LEFT');
		return parent::get_by($where,$limit,$offset,$single,$select);
	}

}