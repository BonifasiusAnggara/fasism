<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Item_tg_model extends MY_Model {
	protected $_table_name = 'tbl_item_tg';
	protected $_primary_key = 'itg_id';
	protected $_order_by = 'itg_id';
	protected $_order_by_type = 'DESC';

	public function __construct() {
		parent::__construct();
	}	
}