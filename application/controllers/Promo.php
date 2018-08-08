<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->version = '2.01.01';
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model(array('Promo_model', 'User_model', 'Pegawai_model','Customer_ski_model'));
    $this->load->helper('cookie_helper');
    $this->load->library('Email');

    $this->user = $this->session->userdata();
    $this->data = array('user'=>$this->session->userdata);
  }

  public function index() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
    $raw['data'] = $this->Promo_model->get_promo_detail();
    $raw['cust'] = $this->Customer_ski_model->get();
    $raw['jmldata'] = $this->Promo_model->count();
      
    $this->app->view('templates/header', $this->data);
  	$this->app->view('Promo/index', $raw);
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
      $row['nominal'] = $post['nominal'];
      $row['no_pot_kwit'] = $post['no_pot_kwit'];
      $row['status'] = 'Pending';

      $rules = $this->Promo_model->rules_faktur;
      $this->form_validation->set_rules($rules);

      if ($this->form_validation->run() == FALSE) {
        echo "<script>alert(':: No Faktur ini sudah ada, mohon diganti nomor lain! ::')</script>";
        redirect ("Promo",'refresh');
      } else {
        $this->Promo_model->insert($row);
        redirect('Promo');
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
      $row['nominal'] = $post['nominal'];
      $row['no_pot_kwit'] = $post['no_pot_kwit'];

      $this->Promo_model->update($row, array('promo_id'=>$post['promo_id']));
      redirect("Promo");
    } else {
      redirect("Main/error_403");
    }
  }

  public function no_kor_kwit() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
    if (($this->user['akses'] == 99) || ($raw['user_detail']->dir_id == 3)) {
      $post = $this->input->post(NULL,TRUE);
      $row['no_kor_kwit'] = $post['no_kor_kwit'];
      $this->Promo_model->update($row, array('promo_id'=>$post['promo_id']));
      redirect("Promo");
    } else {
      redirect("Main/error_403");
    }
  }

  public function no_payment() {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
    if (($this->user['akses'] == 99) || ($raw['user_detail']->dir_id == 3)) {
      $post = $this->input->post(NULL,TRUE);
      $row['no_payment'] = $post['no_payment'];
      $this->Promo_model->update($row, array('promo_id'=>$post['promo_id']));
      redirect("Promo");
    } else {
      redirect("Main/error_403");
    }
  }

  public function done($id) {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);
    if (($this->user['akses'] == 99) || ($raw['user_detail']->dir_id == 3)) {
      $row['status'] = 'Done';
      $this->Promo_model->update($row, array('promo_id'=>base64_decode($id)));
      redirect("Promo");
    } else {
      redirect("Main/error_403");
    }
  }

  public function reset($id) {
    if ($this->user['akses'] == 99) {
      $raw['no_kor_kwit'] = '';
      $raw['no_payment'] = '';
      $raw['status'] = 'Pending';
      $this->Promo_model->update($raw, array('promo_id'=>base64_decode($id)));
      redirect("Promo");
    } else {
      redirect("Main/error_403");
    }
  }

  public function delete($id) {
    $raw['user'] = $this->User_model->get_by(array('user_id'=>$this->user['user_id']), 1, NULL, TRUE);
    $raw['user_detail'] = (object)$this->Pegawai_model->get_user_detail($raw['user']->peg_id);

    if (($this->user['akses'] == 99) || ($raw['user_detail']->dir_id == 3)) {
      $rtv = $this->Promo_model->get_by(array('promo_id'=>base64_decode($id)),1,NULL,TRUE);
      $this->Promo_model->delete(base64_decode($id));
      redirect("Promo");
    } else {
      redirect("Main/error_403");
    }
  }

  public function faktur_check($str){
    /* bisa digunakan untuk mengecek ke dalam database nantinya */
    if ($this->Promo_model->count(array('no_faktur' => $str)) > 0){
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
    $ci->email->subject('Update Faktur Sisa Promo');

    $ppn = $this->Promo_model->get_promo_detail(array('no_kor_kwit'=>''), NULL, NULL, FALSE);

    $html = '<!DOCTYPE HTML>
              <html>
              <head>
                <meta name="viewport" content="width:device-width, initial-scale=1.0">
                <title>Update Faktur Sisa Promo</title>
              </head>
              <body>
              <div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
                <p>Yth KSA / KSSK,</p>
                <p>Berikut kami lampirkan potongan promo<br>
                   untuk outlet yang sudah memotong tagihan.<br>
                   Terima kasih atas kerjasamanya.
                </p>
                <p>-</p>
                <table style="border: 1px solid black; border-collapse: collapse;" width="90%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>No. Faktur</th>
                      <th>Nama Outlet</th>
                      <th>Nominal</th>
                      <th>No. Potongan Kwitansi</th>
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
                      <td>'.format_rupiah($rtr->nominal).'</td>
                      <td>'.$rtr->no_pot_kwit.'</td>
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