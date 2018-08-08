<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_model extends MY_Model {

	protected $_table_name = 'sessions';
	protected $_primary_key = 'id';
	protected $_order_by = 'id';
	protected $_order_by_type = 'DESC';

	public function __construct(){
    parent::__construct();
  }    
  
  public function logout_user() {
    $this->db->delete('{PRE}'.$this->_table_name, array('id' => $this->input->post('id')));
    return true;
  }

  public function get_data_monitoring() {
    $_this =& get_instance();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(-1);
    $data = array(
      'id',
      'ip_address',
      'timestamp',
      'data'
    );
    $this->db->select($data);
    $query = $this->db->get('{PRE}'.$this->_table_name);
    $no = 1;
    foreach ($query->result() as $row)
    {   
      $session_data = $row->data;
      $return_data = array();
      $offset = 0;
      while ($offset < strlen($session_data)) {
          if (!strstr(substr($session_data, $offset), "|")) {
              throw new Exception("invalid data, remaining: " . substr($session_data, $offset));
          }
          $pos = strpos($session_data, "|", $offset);
          $num = $pos - $offset;
          $varname = substr($session_data, $offset, $num);
          $offset += $num + 1;
          $data = unserialize(substr($session_data, $offset));
          $return_data[$varname] = $data;
          $offset += strlen(serialize($data));
      }
      
      if(!empty($return_data['username'])){
          echo "<tr>";
          echo "<td style=\"width: 10%;text-align: right\"><div id=\"dv_ip_$no\">".date("d-m-Y H:i:s",$return_data['__ci_last_regenerate'])."</div></td>";
          echo "<td style=\"width: 20%;text-align: left\">".$return_data['username']."</td>";
          echo "<td style=\"width: 11%;text-align: center\"><div id=\"dv_$no\">".$row->ip_address."</div></td>";
          echo "<td style=\"text-align: left\">".$return_data['browser']."</td>";
          echo "<td style=\"width: 15%;text-align: left\">".$return_data['platform']."</td>";
          echo "<td style=\"width: 7%;text-align: center\">"
              . " <button class=\"btn btn-sm btn-danger\" onclick=\"logout_user('".$row->id."','".$return_data['username']."');\">Logout</button></td>";
          echo "</tr>"; 
          $no++;
      }
    }
  }

}