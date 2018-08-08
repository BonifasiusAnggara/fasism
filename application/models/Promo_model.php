<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Promo_model extends MY_Model {
	protected $_table_name = 'promo';
	protected $_primary_key = 'promo_id';
	protected $_order_by = 'promo_id';
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

	public function get_promo_detail($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->select('{PRE}promo.*, {PRE}Customer_ski.cust_name');
		$this->db->join('{PRE}Customer_ski', '{PRE}promo.cust_no  = {PRE}Customer_ski.cust_no', 'LEFT');
		return parent::get_by($where,$limit,$offset,$single,$select);
	}
}