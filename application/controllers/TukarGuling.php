<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class TukarGuling extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->version = '2.01.01';
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model(array('TukarGuling_model','TG_detail_model','Item_model','Customer_ski_model'));
    $this->load->helper('cookie_helper');
    $this->load->library('Email');

		$this->user = $this->session->userdata();
		$this->data = array('user'=>$this->session->userdata);
	}

	public function index() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
  	$raw['data'] = $this->TukarGuling_model->get_tg_detail();
    $raw['cust'] = $this->Customer_ski_model->get();
    $raw['jmldata'] = $this->TukarGuling_model->count();
      
    $this->app->view('templates/header', $this->data);
  	$this->app->view('TukarGuling/index', $raw);
  	$this->app->view('templates/footer');
  }

  public function add() {    
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
    $row['cust'] = $this->Customer_ski_model->get();

    if (($raw['user_detail']->dir_id == 4) || ($this->user['akses'] == 99)) {
      $this->app->view('templates/header', $this->data);
      $this->app->view('TukarGuling/add', $row);
      $this->app->view('templates/footer');
    } else {
      redirect("Main/error_403");
    }    
  }

  public function insert() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);

    if (($raw['user_detail']->dir_id == 4) || ($this->user['akses'] == 99)) {
      $post = $this->input->post(NULL,TRUE);
      $max_id = $this->TukarGuling_model->get_max_tg();
      $max_id = $max_id->tg_id + 1;

      $row['tg_id'] = $max_id;
      $row['created_by'] = $this->user['user_id'];
      $row['no_ttrb'] = strtoupper($post['no_ttrb']);
      $row['cust_no'] = $post['cust_no'];
      $row['tgl_trm_brg'] = $post['tgl_trm_brg'];
      $row['sp'] = $post['sp'];
      $row['keterangan'] = $post['keterangan'];
      $row['status'] = 'RECEIVED';

      $this->TukarGuling_model->insert($row);
      redirect('TukarGuling/detail_item/'.sha1($max_id));
    } else {
      redirect("Main/error_403");
    }
  }

  public function delete($id) {
    if ($this->user['akses'] == 99) {
      $this->TukarGuling_model->delete(base64_decode($id));
      $this->TG_detail_model->delete_by(array('tg_id'=>base64_decode($id)));
      redirect("TukarGuling");
    }
  }

  public function update() {
    $post = $this->input->post(NULL,TRUE);
    $raw = array(
      'cust_no'=>$post['cust_no'],
      'no_ttrb'=>$post['no_ttrb'],
      'tgl_trm_brg'=>$post['tgl_trm_brg'],
      'sp'=>$post['sp'],
      'keterangan'=>$post['keterangan']
    );
    $this->TukarGuling_model->update($raw, array('tg_id'=>$post['tg_id']));
    redirect("TukarGuling");
  }

  public function data_BPB() {
    $post = $this->input->post(NULL,TRUE);
    $raw = array(
      'no_bpb'=>strtoupper($post['no_bpb']),
      'tgl_bpb'=>$post['tgl_bpb'],
      'status'=>'PROCESSED'
    );
    $this->TukarGuling_model->update($raw, array('tg_id'=>$post['tg_id']));
    redirect("TukarGuling");
  }

  public function data_BKB() {
    $post = $this->input->post(NULL,TRUE);
    $raw = array(
      'no_bkb'=>strtoupper($post['no_bkb']),
      'tgl_bkb'=>$post['tgl_bkb']
    );
    $this->TukarGuling_model->update($raw, array('tg_id'=>$post['tg_id']));
    redirect("TukarGuling");
  }

  public function tgl_abl_dok() {
    $post = $this->input->post(NULL,TRUE);
    $raw['tgl_abl_dok'] = $post['tgl_abl_dok'];
    $this->TukarGuling_model->update($raw, array('tg_id'=>$post['tg_id']));
    redirect("TukarGuling");
  }

  public function data_pengiriman() {
    $post = $this->input->post(NULL,TRUE);
    $raw = array(
      'nama_pengirim'=>$post['nama_pengirim'],
      'tgl_kirim'=>$post['tgl_kirim'],
      'status'=>'SHIPPED'
    );
    $this->TukarGuling_model->update($raw, array('tg_id'=>$post['tg_id']));
    redirect("TukarGuling");
  }

  public function tgl_kbl_dok() {
    $post = $this->input->post(NULL,TRUE);
    $raw = array(
      'tgl_kbl_dok'=>$post['tgl_kbl_dok'],
      'status'=>'DELIVERED'
    );
    $this->TukarGuling_model->update($raw, array('tg_id'=>$post['tg_id']));
    redirect("TukarGuling");
  }

  public function reset($id) {
    if ($this->user['akses'] == 99) {
      $raw = array(
        'no_bpb'=>'',
        'tgl_bpb'=>'',
        'no_bkb'=>'',
        'tgl_bkb'=>'',
        'tgl_abl_dok'=>'',
        'nama_pengirim'=>'',
        'tgl_kirim'=>'',
        'tgl_kbl_dok'=>'',
        'status'=>'RECEIVED'
      );
      $this->TukarGuling_model->update($raw, array('tg_id'=>base64_decode($id)));
      redirect("TukarGuling");
    } else {
      redirect("Main/error_403");
    }
  }

  public function detail_item($id) {    
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
    $raw['header'] = $this->TukarGuling_model->get_tg_detail(array('sha1(tg_id)'=>$id),1,NULL,TRUE);
    $raw['data'] = $this->TG_detail_model->get_item_detail(array('sha1(tg_id)'=>$id),NULL,NULL,FALSE);
    $raw['jmldata'] = $this->TG_detail_model->count(array('sha1(tg_id)'=>$id));
    $raw['item'] = $this->Item_model->get();

    if (($raw['user_detail']->dir_id == 4) || ($this->user['akses'] == 99)) {
      $this->app->view('templates/header', $this->data);
      $this->app->view('TukarGuling/add_item', $raw);
      $this->app->view('templates/footer');
    } else {
      redirect("Main/error_403");
    }    
  }

  public function add_item() {    
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);

    if (($raw['user_detail']->dir_id == 4) || ($this->user['akses'] == 99)) {
      $post = $this->input->post(NULL,TRUE);
      $max_id = $post['tg_id'];

      $row['created_by'] = $this->user['user_id'];
      $row['tg_id'] = strtoupper($post['tg_id']);
      $row['item_code'] = $post['item_code'];
      $row['batch_num'] = strtoupper($post['batch_num']);
      $row['exp_date'] = $post['exp_date'];
      $row['quantity'] = $post['quantity'];

      $this->TG_detail_model->insert($row);
      redirect('TukarGuling/detail_item/'.sha1($max_id));
    } else {
      redirect("Main/error_403");
    }    
  }

  public function delete_item($id) {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);

    if (($raw['user_detail']->dir_id == 4) || ($this->user['akses'] == 99)) {
      $itg = $this->TG_detail_model->get_by(array('itg_id'=>base64_decode($id)),1,NULL,TRUE);
      $this->TG_detail_model->delete(base64_decode($id));
      redirect('TukarGuling/detail_item/'.sha1($itg->tg_id));
    } else {
      redirect("Main/error_403");
    }
  }

  public function edit_item() {    
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);

    if (($raw['user_detail']->dir_id == 4) || ($this->user['akses'] == 99)) {
      $post = $this->input->post(NULL,TRUE);
      $max_id = $post['tg_id'];

      $row['batch_num'] = strtoupper($post['batch_num']);
      $row['exp_date'] = $post['exp_date'];
      $row['quantity'] = $post['quantity'];

      $this->TG_detail_model->update($row, array('itg_id'=>$post['itg_id']));
      redirect('TukarGuling/detail_item/'.sha1($max_id));
    } else {
      redirect("Main/error_403");
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

    $ci->email->from('kepala.gudang@enseval.com', 'Kepala Gudang');
    $list = array('kepala.transportasi@enseval.com');
    $ci->email->to($list);
    $ci->email->subject('Data Tukar Guling');

    $tg = $this->TukarGuling_model->get_tg_detail(array('tgl_kirim'=>'0000-00-00'), NULL, NULL, FALSE);

    $html = '<!DOCTYPE HTML>
              <html>
              <head>
                <meta name="viewport" content="width:device-width, initial-scale=1.0">
                <title>Update Retur Chainstore</title>
              </head>
              <body>
              <div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
                <p>Yth Kepala Transportasi</p>
                <p>Berikut ini kami sampaikan data Tukar Guling,<br>
                   yang sudah diproses BKB, tapi belum dikirim.<br>
                   Mohon bantuan dari rekan² Transportasi untuk melakukan pengiriman, terima kasih.
                </p>
                <p>-</p>
                <table style="border: 1px solid black; border-collapse: collapse;" width="40%">
                  <thead>
                    <tr>
                      <th>No. TTRB</th>
                      <th>No. Customer</th>
                      <th>Nama Customer</th>                  
                      <th>Tgl. Terima Barang</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>';
    foreach ($tg as $tgl) {
            $html .=
                    '<tr>
                      <td>'.$tgl->no_ttrb.'</td>
                      <td>'.$tgl->cust_no.'</td>
                      <td>'.$tgl->cust_name.'</td>
                      <td>'.tgl_indo($tgl->tgl_trm_brg).'</td>
                      <td>'.$tgl->keterangan.'</td>
                    </tr>'; }
    $html .=             
                  '</tbody>
                </table>
                <p>Klik link berikut untuk data selengkapnya.</p>
                <p><a href="epm.sukabumi.com/scada">epm.sukabumi.com/scada</a></p>
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