<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sparepart_mhe_model extends MY_Model {
	protected $_table_name = 'sprt_mhe';
	protected $_primary_key = 'sprt_id';
	protected $_order_by = 'sprt_id';
	protected $_order_by_type = 'DESC';

	public function __construct() {
		parent::__construct();
	}

	public function get_sparepart_by_id($arr_id) {
    $this->db->where_in('sprt_id',$arr_id);
    $query = $this->db->get('{PRE}'.$this->_table_name);
    return $query -> result ();
  }
}