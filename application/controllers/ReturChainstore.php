<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReturChainstore extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->version = '2.01.01';
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model(array('ReturChainstore_model', 'User_model', 'Pegawai_model','Customer_ski_model','Direktorat_model'));
    $this->load->helper('cookie_helper');
    $this->load->library('Email');

    $this->user = $this->session->userdata();
    $this->data = array('user'=>$this->session->userdata);
  }

  public function index() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
  	$raw['data'] = $this->ReturChainstore_model->get_rtv_detail();
    $raw['cust'] = $this->Customer_ski_model->get();
    $raw['direktorat'] = $this->Direktorat_model->get();
    $raw['jmldata'] = $this->ReturChainstore_model->count();
      
    $this->app->view('templates/header', $this->data);
  	$this->app->view('ReturChainstore/index', $raw);
  	$this->app->view('templates/footer');
  }

  public function add() {    
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
    $row['cust'] = $this->Customer_ski_model->get();
    $row['direktorat'] = $this->Direktorat_model->get();

    if (($raw['user_detail']->dir_id == 3) || ($this->user['akses'] == 99)) {
      $this->app->view('templates/header', $this->data);
      $this->app->view('ReturChainstore/add', $row);
      $this->app->view('templates/footer');
    } else {
      redirect("Main/error_403");
    }    
  }

  public function insert() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);

    if (($raw['user_detail']->dir_id == 3) || ($this->user['akses'] == 99)) {
      $post = $this->input->post(NULL,TRUE);
      $rules = $this->ReturChainstore_model->rules_register;
      $this->form_validation->set_rules($rules);

      if ($this->form_validation->run() == FALSE) {
        $this->app->view('templates/header', $this->data);
        $this->app->view('ReturChainstore/add', $raw);
        $this->app->view('templates/footer');
      } else {

        if (isset ($_FILES ['pdf'] ['name']) && !empty($_FILES ['pdf'] ['name'])) {
          // UPLOAD then RESIZE
          $upload['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf_rtv";
          $upload['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
          $upload['overwrite'] = TRUE;
          $upload['max_size'] = '8000';
          $upload['file_name'] = $post['no_rtv'];

          $this->load->library('upload',$upload);
          $this->upload->do_upload('pdf');

          $file = $this->upload->data();
          $row['pdf_filename'] = $file['orig_name'];     
        }

        $row['created_by'] = $this->user['user_id'];
        $row['no_rtv'] = $post['no_rtv'];
        $row['cust_no'] = $post['cust_no'];
        $row['cabang_chs'] = $post['cabang_chs'];
        $row['dir_id'] = $post['dir_id'];     
        $row['nominal'] = $post['nominal'];
        $row['status'] = "Pending";

        $this->ReturChainstore_model->insert($row);
        redirect("ReturChainstore");
      }
    } else {
      redirect("Main/error_403");
    }
  }

  public function edit_rtv() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);

    if (($raw['user_detail']->dir_id == 3) || ($this->user['akses'] == 99)) {
      $post = $this->input->post(NULL,TRUE);
        
      $row['cust_no'] = $post['cust_no'];
      $row['cabang_chs'] = $post['cabang_chs'];
      $row['dir_id'] = $post['dir_id'];      
      $row['nominal'] = $post['nominal'];

      $this->ReturChainstore_model->update($row, array('rtv_id'=>$post['rtv_id']));
      redirect("ReturChainstore");
      
    } else {
      redirect("Main/error_403");
    }
  }

  public function input_cn() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
    $post = $this->input->post(NULL,TRUE);
    if (($this->user['akses'] == 99) || ($raw['user_detail']->dir_id == 3)) {
      $row = array(
        'no_cn'=>$post['no_cn'],
        'status'=>'Done'
      );
      $this->ReturChainstore_model->update($row, array('rtv_id'=>$post['rtv_id']));
      redirect("ReturChainstore");
    } else {
      redirect("Main/error_403");
    }
  }

  public function delete($id) {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);

    if (($this->user['akses'] == 99) || ($raw['user_detail']->dir_id == 3)) {
      $rtv = $this->ReturChainstore_model->get_by(array('rtv_id'=>base64_decode($id)),1,NULL,TRUE);
      unlink("uploads/pdf_rtv/".$rtv->pdf_filename);
      $this->ReturChainstore_model->delete(base64_decode($id));
      redirect("ReturChainstore");
    } else {
      redirect("Main/error_403");
    }
  }

	public function rtv_check($str){
    /* bisa digunakan untuk mengecek ke dalam database nantinya */
    if ($this->ReturChainstore_model->count(array('no_rtv' => $str)) > 0){
      $this->form_validation->set_message('rtv_check', 'No. RTV ini sudah ada, mohon diganti yang lain...');
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

  public function send_mail() {
    $ci = get_instance();
    $config['protocol'] = "smtp";
    $config['smtp_host'] = "mail.enseval.com";
    $config['smtp_port'] = "25";
    $config['smtp_user'] = "";
    $config['smtp_pass'] = "";
    $config['charset'] = "utf-8";
    $config['mailtype'] = "html";
    $config['newline'] = "\r\n";

    $ci->email->initialize($config);

    $post = $this->input->post(NULL,TRUE);
    $list = $post['mail_to'];

    $ci->email->from('sugiono.arif@enseval.com', 'Arif Sugiono');
    $ci->email->to($list);
    $ci->email->subject('Update Retur Chainstore');

    $array = array('status' => 'Pending');
    $rtv = $this->ReturChainstore_model->get_rtv_detail($array, NULL, NULL, FALSE);

    $html = '<!DOCTYPE HTML>
              <html>
              <head>
                <meta name="viewport" content="width:device-width, initial-scale=1.0">
                <title>Update Retur Chainstore</title>
              </head>
              <body>
              <div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
                <p>Yth Rekan² EPM Sukabumi,</p>
                <p>Berikut kami sampaikan data Retur Chainstore,<br>
                   yang sudah melakukan potongan, tapi belum ada Faktur CN nya.<br>
                   Mohon bantuan dari rekan² sekalian untuk melakukan pelacakan, terima kasih.
                </p>
                <p>-</p>
                <table style="border: 1px solid black; border-collapse: collapse;" width="90%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>No. RTV</th>
                      <th>Nama Outlet</th>
                      <th>Cabang Chainstore</th>
                      <th>Direktorat</th>
                      <th>Value</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>';
            $no = 1;
    foreach ($rtv as $rtr) {
            $html .=
                    '<tr>
                      <td>'.$no.'</td>
                      <td>'.$rtr->no_rtv.'</td>
                      <td>'.$rtr->cust_name.'</td>
                      <td>'.$rtr->cabang_chs.'</td>
                      <td>'.$rtr->dir_slug.'</td>
                      <td>'.format_rupiah($rtr->nominal).'</td>
                      <td>'.$rtr->status.'</td>
                    </tr>'; $no++; }
    $html .=             
                  '</tbody>
                </table>
                <p>Klik link berikut untuk data selengkapnya.</p>
                <p><a href="epm.sukabumi.com/fasism">epm.sukabumi.com/fasism</a></p>
              </div>
              </body>
              </html>';

    $ci->email->message($html);
    if ($this->email->send()) {
        echo 'Email sent.';
    } else {
        show_error($this->email->print_debugger());
    }
  }

}