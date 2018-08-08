<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ppn_model extends MY_Model {
	protected $_table_name = 'ppn';
	protected $_primary_key = 'ppn_id';
	protected $_order_by = 'ppn_id';
	protected $_order_by_type = 'DESC';

	public function __construct() {
		parent::__construct();
	}

	public $rules_faktur = array(
		'no_faktur' => array(
      'field' => 'no_faktur',
      'label' => 'No. Faktur',
      'rules' => 'trim|callback_faktur_check'
		)
	);

	public function get_ppn_detail($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->select('{PRE}ppn.*, {PRE}customer_ski.cust_name');
		$this->db->join('{PRE}customer_ski', '{PRE}ppn.cust_no  = {PRE}customer_ski.cust_no', 'LEFT');
		return parent::get_by($where,$limit,$offset,$single,$select);
	}
}