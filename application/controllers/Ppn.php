<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ppn extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->version = '2.01.01';
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model(array('Ppn_model', 'User_model', 'Pegawai_model','Customer_ski_model'));
    $this->load->helper('cookie_helper');
    $this->load->library('Email');

    $this->user = $this->session->userdata();
    $this->data = array('user'=>$this->session->userdata);
  }

  public function index() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
    $raw['data'] = $this->Ppn_model->get_ppn_detail();
    $raw['cust'] = $this->Customer_ski_model->get();
    $raw['jmldata'] = $this->Ppn_model->count();
      
    $this->app->view('templates/header', $this->data);
  	$this->app->view('Ppn/index', $raw);
  	$this->app->view('templates/footer');
  }

  public function insert() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);

    if (($raw['user_detail']->dir_id == 3) || ($this->user['akses'] == 99)) {
      $post = $this->input->post(NULL,TRUE);

      $row['created_by'] = $this->user['user_id'];
      $row['no_faktur'] = $post['no_faktur'];
      $row['cust_no'] = $post['cust_no'];
      $row['nilai_faktur'] = $post['nilai_faktur'];
      $row['ppn'] = $post['ppn'];
      $row['pph'] = $post['pph'];
      $row['status'] = 'Pending';

      $rules = $this->Ppn_model->rules_faktur;
      $this->form_validation->set_rules($rules);

      if ($this->form_validation->run() == FALSE) {
        echo "<script>alert(':: No Faktur ini sudah ada, mohon diganti nomor lain! ::')</script>";
        redirect ("Ppn",'refresh');
      } else {
        $this->Ppn_model->insert($row);
        redirect('Ppn');
      }
    } else {
      redirect("Main/error_403");
    }
  }

  public function update() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);

    if (($raw['user_detail']->dir_id == 3) || ($this->user['akses'] == 99)) {
      $post = $this->input->post(NULL,TRUE);

      $row['cust_no'] = $post['cust_no'];
      $row['nilai_faktur'] = $post['nilai_faktur'];
      $row['ppn'] = $post['ppn'];
      $row['pph'] = $post['pph'];

      $this->Ppn_model->update($row, array('ppn_id'=>$post['ppn_id']));
      redirect("ppn");
    } else {
      redirect("Main/error_403");
    }
  }

  public function delete($id) {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);

    if (($this->user['akses'] == 99) || ($raw['user_detail']->dir_id == 3)) {
      $rtv = $this->Ppn_model->get_by(array('ppn_id'=>base64_decode($id)),1,NULL,TRUE);
      $this->Ppn_model->delete(base64_decode($id));
      redirect("Ppn");
    } else {
      redirect("Main/error_403");
    }
  }

  public function no_ntpn() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
    if (($this->user['akses'] == 99) || ($raw['user_detail']->dir_id == 6)) {
      $post = $this->input->post(NULL,TRUE);
      $row['no_ntpn'] = $post['no_ntpn'];
      $this->Ppn_model->update($row, array('ppn_id'=>$post['ppn_id']));
      redirect("Ppn");
    } else {
      redirect("Main/error_403");
    }
  }

  public function done($id) {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
    if (($this->user['akses'] == 99) || ($raw['user_detail']->dir_id == 3)) {
      $row['status'] = 'Done';
      $this->Ppn_model->update($row, array('ppn_id'=>base64_decode($id)));
      redirect("Ppn");
    } else {
      redirect("Main/error_403");
    }
  }

  public function reset($id) {
    if ($this->user['akses'] == 99) {
      $raw['no_ntpn'] = '';
      $raw['status'] = 'Pending';
      $this->Ppn_model->update($raw, array('ppn_id'=>base64_decode($id)));
      redirect("Ppn");
    } else {
      redirect("Main/error_403");
    }
  }

  public function faktur_check($str){
    /* bisa digunakan untuk mengecek ke dalam database nantinya */
    if ($this->Ppn_model->count(array('no_faktur' => $str)) > 0){
      $this->form_validation->set_message('faktur_check', 'No. Faktur ini sudah ada, mohon diganti yang lain...');
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
    $ci->email->subject('Update Faktur Sisa Ppn');

    $ppn = $this->Ppn_model->get_ppn_detail(array('no_ntpn'=>''), NULL, NULL, FALSE);

    $html = '<!DOCTYPE HTML>
              <html>
              <head>
                <meta name="viewport" content="width:device-width, initial-scale=1.0">
                <title>Update Faktur Sisa Ppn</title>
              </head>
              <body>
              <div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
                <p>Yth Adm Pharma,</p>
                <p>Berikut kami sampaikan data Faktur Sisa Ppn,<br>
                   Mohon bantuannya untuk mengisi No. NTPN di aplikasi SCADA.
                </p>
                <p>-</p>
                <table style="border: 1px solid black; border-collapse: collapse;" width="90%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>No. Faktur</th>
                      <th>Nama Outlet</th>
                      <th>Nilai Faktur</th>
                      <th>Ppn</th>
                      <th>Pph</th>
                    </tr>
                  </thead>
                  <tbody>';
            $no = 1;
    foreach ($ppn as $rtr) {
            $html .=
                    '<tr>
                      <td>'.$no.'</td>
                      <td>'.$rtr->no_faktur.'</td>
                      <td>'.$rtr->cust_name.'</td>
                      <td>'.format_rupiah($rtr->nilai_faktur).'</td>
                      <td>'.format_rupiah($rtr->ppn).'</td>
                      <td>'.format_rupiah($rtr->pph).'</td>
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