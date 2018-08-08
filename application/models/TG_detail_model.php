<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TG_detail_model extends MY_Model {
	protected $_table_name = 'item_tg';
	protected $_primary_key = 'itg_id';
	protected $_order_by = 'itg_id';
	protected $_order_by_type = 'DESC';

	public function __construct() {
		parent::__construct();
	}

	public function get_item_detail($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->select('{PRE}item_tg.*, {PRE}item.item_desc');
		$this->db->join('{PRE}item', '{PRE}item_tg.item_code  = {PRE}item.item_code', 'LEFT');
		return parent::get_by($where,$limit,$offset,$single,$select);
	}
}