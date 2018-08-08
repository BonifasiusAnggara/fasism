<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends MY_Model {
	protected $_table_name = 'item';
	protected $_primary_key = 'item_id';
	protected $_order_by = 'item_id';
	protected $_order_by_type = 'ASC';

	public function __construct() {
		parent::__construct();
	}

}