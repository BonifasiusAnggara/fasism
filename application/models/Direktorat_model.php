<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Direktorat_model extends MY_Model {

	protected $_table_name = 'direktorat';
	protected $_primary_key = 'dir_id';
	protected $_order_by = 'dir_id';
	protected $_order_by_type = 'DESC';

	public function __construct() {
		parent::__construct();
	}

}