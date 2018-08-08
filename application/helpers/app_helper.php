<?php

  function set_url($sub){
    $_this =& get_instance();
      return site_url($sub);
  }

  function is_active_page_print($page,$class){
		$_this =& get_instance();
		if($page == $_this->uri->segment(1)){
			return $class;
		}
  }
  
  function title(){
		$_this =& get_instance();
    $page = $_this->uri->segment(1);
    $page2 = $_this->uri->segment(2);
    
		$array_page = array(
      'Dashboard' => 'asism | Dashboard',
      'Monitoring' => 'asism | Realtime Monitoring',
      'Pegawai' => 'asism | Pegawai',
      'User' => 'asism | User',
      'ReturChainStore' => 'asism | Retur ChainStore',
      'Ppn' => 'asism | FS Ppn',
      'Promo' => 'asism | FS Promo',
      'MHE' => 'asism | M H E',
      'Vendor' => 'asism | Vendor MHE',
      'Sparepart_mhe' => 'asism | Sparepart MHE',
      'TukarGuling' => 'asism | Tukar Guling',
      'error_403' => 'asism | Error_403'
    );
    
    if (array_key_exists($page, $array_page)) {
      if (array_key_exists($page2, $array_page)) {
        return $array_page[$page2];
      } else {
        return $array_page[$page];
      }
    }
  }

  function tgl_indo($tanggal){
    $bulan = array (
      1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    
    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun
   
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
  }

  function format_rupiah($angka) {
    $rupiah = "Rp. ".number_format($angka,0,',','.');
    return $rupiah;
  }

  function format_ribuan($angka) {
    $ribu = number_format($angka,0,',','.');
    return $ribu;
  }

  function format_ribuan2($angka) {
    $ribu = number_format($angka,2,',','.');
    return $ribu;
  }

  function format_persen($angka) {
    $ribu = number_format($angka,2,',','.')." %";
    return $ribu;
  }

?>