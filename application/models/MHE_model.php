<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MHE_model extends MY_Model {
	protected $_table_name = 'mhe';
	protected $_primary_key = 'mhe_id';
	protected $_order_by = 'mhe_id';
	protected $_order_by_type = 'DESC';

	public function __construct() {
		parent::__construct();
	}
	
}