<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends MY_Model {

	protected $_table_name = 'pegawai';
	protected $_primary_key = 'peg_id';
	protected $_order_by = 'peg_id';
	protected $_order_by_type = 'DESC';

	public $rules_register = array(
		'nik' => array(
      'field' => 'NIK',
      'label' => 'NIK',
      'rules' => 'trim|callback_nik_check'
		)
	);

	public function __construct() {
		parent::__construct();
	}

	public function get_user_detail($id=NULL){
		$this->db->select('{PRE}pegawai.*, {PRE}direktorat.dir_name');
		$this->db->join('{PRE}direktorat', '{PRE}pegawai.dir_id  = {PRE}direktorat.dir_id', 'LEFT');
		return parent::get($id);
	}

	public function get_peg_detail($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->select('{PRE}pegawai.*, {PRE}direktorat.dir_name, {PRE}direktorat.dir_id');
		$this->db->join('{PRE}direktorat', '{PRE}pegawai.dir_id  = {PRE}direktorat.dir_id', 'LEFT');
		return parent::get_by($where,$limit,$offset,$single,$select);
	}
	
}