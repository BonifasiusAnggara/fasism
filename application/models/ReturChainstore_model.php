<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ReturChainstore_model extends MY_Model {
	protected $_table_name = 'rtv';
	protected $_primary_key = 'rtv_id';
	protected $_order_by = 'rtv_id';
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

	public function get_rtv_detail($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->select('{PRE}rtv.*, {PRE}customer_ski.cust_name, {PRE}direktorat.*');
		$this->db->join('{PRE}customer_ski', '{PRE}rtv.cust_no  = {PRE}customer_ski.cust_no', 'LEFT');
		$this->db->join('{PRE}direktorat', '{PRE}rtv.dir_id  = {PRE}direktorat.dir_id', 'LEFT');
		return parent::get_by($where,$limit,$offset,$single,$select);
	}
}