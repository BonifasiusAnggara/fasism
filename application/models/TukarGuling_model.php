<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TukarGuling_model extends MY_Model {
	protected $_table_name = 'tukar_guling';
	protected $_primary_key = 'tg_id';
	protected $_order_by = 'tg_id';
	protected $_order_by_type = 'DESC';

	public function __construct() {
		parent::__construct();
	}

	public function get_tg_detail($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->select('{PRE}tukar_guling.*, {PRE}customer_ski.cust_name');
		$this->db->join('{PRE}customer_ski', '{PRE}tukar_guling.cust_no  = {PRE}customer_ski.cust_no', 'LEFT');
		return parent::get_by($where,$limit,$offset,$single,$select);
	}

	public function get_max_tg() {
    $this->db->select_max ('tg_id');
    $query = $this->db->get('{PRE}'.$this->_table_name);
    return $query->row();
	}

}