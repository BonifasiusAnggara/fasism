<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends MY_Model {
	protected $_table_name = 'register';
	protected $_primary_key = 'reg_id';
	protected $_order_by = 'reg_id';
	protected $_order_by_type = 'DESC';

	public function __construct() {
		parent::__construct();
	}

	public $rules_register = array(
		'no_rtv' => array(
      'field' => 'no_rtv',
      'label' => 'No. RTV',
      'rules' => 'trim|callback_rtv_check'
		)
	);

	public function get_register_detail($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->select('{PRE}register.*, {PRE}customer_ski.cust_name, {PRE}direktorat.*');
		$this->db->join('{PRE}customer_ski', '{PRE}register.cust_no  = {PRE}customer_ski.cust_no', 'LEFT');
		$this->db->join('{PRE}direktorat', '{PRE}register.dir_id  = {PRE}direktorat.dir_id', 'LEFT');
		return parent::get_by($where,$limit,$offset,$single,$select);
	}

	function get_statistic(){
		$this->db->select("Count({PRE}register.reg_id) AS total_retur,
			  Date_Format({PRE}register.tgl_trm_gudang, '%d') AS date",FALSE);
		$this->db->where(
				"YEAR({PRE}register.tgl_trm_gudang) = YEAR(NOW()) AND
				 MONTH({PRE}register.tgl_trm_gudang) = MONTH(NOW())");

		$this->db->group_by('date');
		$this->db->limit(15,0);				
		$this->_order_by_type = 'ASC';
		return parent::get_by();
	}

}