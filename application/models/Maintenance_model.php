<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance_model extends MY_Model {
	protected $_table_name = 'maintenance';
	protected $_primary_key = 'mtc_id';
	protected $_order_by = 'mtc_id';
	protected $_order_by_type = 'DESC';

	public function __construct() {
		parent::__construct();
	}	
}