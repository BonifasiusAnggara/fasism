<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_model extends MY_Model {
	protected $_table_name = 'vendor_mhe';
	protected $_primary_key = 'vdr_id';
	protected $_order_by = 'vdr_id';
	protected $_order_by_type = 'DESC';

	public function __construct() {
		parent::__construct();
	}	
}