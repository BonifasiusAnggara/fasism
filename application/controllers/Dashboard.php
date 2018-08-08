<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct() {
    parent::__construct();
    $this->version = '2.01.01';
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model(array('MY_Model','ReturChainstore_model','Ppn_model','Promo_model','TukarGuling_model','MHE_model','Maintenance_model','Sparepart_rec_model','Register_model'));
  }

  public function index() {

  	$data['user'] = $this->session->userdata;
    $array = array('status !=' => 'Done');
    $ReturChainstore = $this->ReturChainstore_model->count($array);
    $Ppn = $this->Ppn_model->count($array);
    $Promo = $this->Promo_model->count($array);
    $total = $ReturChainstore+$Ppn+$Promo;
    $pct_rcs = $ReturChainstore/$total*100;
    $pct_ppn = $Ppn/$total*100;
    $pct_promo = $Promo/$total*100;
    $array = array('pet_retur' => '');

    $raw['statistik'] = $this->Register_model->get_statistic();
    
    $raw['ReturChainstore'] = $ReturChainstore;
    $raw['Ppn'] = $Ppn;
    $raw['Promo'] = $Promo;
    $raw['total'] = $total;
    $raw['pct_rcs'] = number_format($pct_rcs,2);
    $raw['pct_ppn'] = number_format($pct_ppn,2);
    $raw['pct_promo'] = number_format($pct_promo,2);

    $raw['rbd'] = $this->Register_model->count($array);
    $raw['mhe'] = $this->MHE_model->count();
    $raw['mtc_rec'] = $this->Maintenance_model->count();
    $raw['spr_rec'] = $this->Sparepart_rec_model->count();

  	$this->app->view('templates/header', $data);
  	$this->app->view('Main/dashboard', $raw);
  	$this->app->view('templates/footer');
  }
}