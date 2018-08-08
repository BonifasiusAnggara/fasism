<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_ski_model extends MY_Model {
	protected $_table_name = 'customer_ski';
	protected $_primary_key = 'cust_id';
	protected $_order_by = 'cust_id';
	protected $_order_by_type = 'DESC';

	public function __construct() {
		parent::__construct();
	}
	
}