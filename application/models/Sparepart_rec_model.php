<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sparepart_rec_model extends MY_Model {
	protected $_table_name = 'sprt_rec';
	protected $_primary_key = 'sprec_id';
	protected $_order_by = 'sprec_id';
	protected $_order_by_type = 'DESC';

	public function __construct() {
		parent::__construct();
	}	
}