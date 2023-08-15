<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// is_logged_in();
		$this->load->model('Report_model','report_model');
		$this->load->library('Pdf');
	}
	
	public function index(){
		redirect(base_url());
	}

	public function input_data_harian() 
    {
        $data['title'] = 'Input Laporan Harian';
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();
		$id_user = $this->session->userdata('id_user');

		$data['laporan_harian'] = $this->report_model->getAllLaporanHarianByUser($id_user);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('report/input_data_harian', $data);
		$this->load->view('templates/footer');
    }

	public function do_add_edit_laporan(){

		$id = $this->input->post('id', true);
		$id_user = $this->session->userdata('id_user');
		$kedb = [
			'id_user' => $id_user,
			'tanggal' => date('Y-m-d', strtotime($this->input->post('tanggal'))),
			'keterangan' => $this->input->post('laporan', true),
			// 'created_dt' => date('Y-m-d'),
			// 'created_by' => $this->session->userdata('name')
		];

		if ($id == "") {
			$this->db->insert('laporan_harian',$kedb);
		} else {
			$this->db->where('id',$id);
			$this->db->update('laporan_harian',$kedb);
		}
		
		redirect(base_url().'report/input_data_harian');
	}

	public function do_delete_data_harian(){
		$id = $this->input->get('id');

		if ($id){
			$this->db->where('id',$id);
			$this->db->delete('laporan_harian');
		}
		redirect(base_url().'report/input_data_harian');
	}

	public function getLaporanById($id){
        $laporanById = $this->db->get_where('laporan_harian',['id' => $id])->row();
        echo json_encode($laporanById);
    }

	public function Laporan_harian() 
    {
        $data['title'] = 'Laporan Harian Pegawai';
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();
		$id_user = $this->session->userdata('id_user');

		if($this->input->get('tanggal')){
			$tanggal = strtotime($this->input->get('tanggal'));
			$bulan = date("m",$tanggal);
			$data['tanggal'] = $tanggal;
		} else {
			$bulan = date('m');
			$data['tanggal'] = strtotime(date('Y-m-d'));
		}

		if($this->input->get('id_pegawai')) {
			$data['id_pegawai'] = $this->input->get('id_pegawai');
		} else {
			$data['id_pegawai'] = 0;
		}

		$data['users'] = $this->report_model->getAllUser();

		if($data['user']['role_id'] == 1) {
			$data['laporan_harian'] = $this->report_model->getAllLaporanByMonth($data['id_pegawai'],$bulan);
		} else {
			$data['laporan_harian'] = $this->report_model->getAllLaporanByMonth($id_user,$bulan);
		}

		$awal_cuti = '1-08-2020';
		$akhir_cuti = '31-08-2020';
		
		// tanggalnya diubah formatnya ke Y-m-d 
		// $awal_cuti = date_create_from_format('d-m-Y', $awal_cuti);
		// $awal_cuti = date_format($awal_cuti, 'Y-m-d');
		// $awal_cuti = strtotime($awal_cuti);
		
		// $akhir_cuti = date_create_from_format('d-m-Y', $akhir_cuti);
		// $akhir_cuti = date_format($akhir_cuti, 'Y-m-d');
		// $akhir_cuti = strtotime($akhir_cuti);
		
		// $haricuti = array();
		// $sabtuminggu = array();
		
		// for ($i=$awal_cuti; $i <= $akhir_cuti; $i += (60 * 60 * 24)) {
		// 	if (date('w', $i) !== '0' && date('w', $i) !== '6') {
		// 		$haricuti[] = $i;
		// 	} else {
		// 		$sabtuminggu[] = $i;
		// 	}
		
		// }
		// $jumlah_cuti = count($haricuti);
		// $jumlah_sabtuminggu = count($sabtuminggu);
		// $abtotal = $jumlah_cuti + $jumlah_sabtuminggu;
		// echo "<pre>";
		// echo "<h1>Sistem Cuti Online</h1>";
		// echo "<hr>";
		// echo "Mulai Cuti : " . date('d-m-Y', $awal_cuti) . "<br>";
		// echo "Terakhir Cuti : " . date('d-m-Y', $akhir_cuti) . "<br>";
		// echo "Jumlah Hari Cuti : " . $jumlah_cuti ."<br>";
		// echo "Jumlah Sabtu/Minggu : " . $jumlah_sabtuminggu ."<br>";
		// echo "Total Hari : " . $abtotal ."<br>";
		
		
		// echo "<h1>Hari Kerja</h1>";
		// echo "<hr>";
		// 	foreach ($haricuti as $value) {
		// 		echo date('d-m-Y', $value)  . " -> " . strftime("%A, %d %B %Y", date($value)) . "\n" . "<br>";
		// 	}
		
		// echo "<h1>Sabtu Minggu</h1>";
		// echo "<hr>";
		// 	foreach ($sabtuminggu as $value) {
		// 		echo date('d-m-Y', $value) . " -> " . strftime("%A, %d %B %Y", date($value)) . "\n" . "<br>";
		// 	}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('report/laporan_harian', $data);
		$this->load->view('templates/footer');
    }

	public function download_laporan(){
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();
		$id_user = $this->session->userdata('id_user');
		$id_unit_kerja = $this->session->userdata('id_unit_kerja');
		$nama = $this->session->userdata('nama');
		$nip = $this->session->userdata('nip');

		$tanggal = $this->input->get('tanggal');
		$bulan = date("m",$tanggal);
		$disBulan = date("F",$tanggal);

		if($this->input->get('id_pegawai')) {
			$id_pegawai = $this->input->get('id_pegawai');
		} else {
			$id_pegawai = 0;
		}

		$data['users'] = $this->report_model->getAllUser();

		if($data['user']['role_id'] == 1) {
			$laporan_harian = $this->report_model->getAllLaporanByMonth($id_pegawai,$bulan);
			$user = $this->report_model->getUserById($id_pegawai);
			if($user) {
				$id_unit_kerja = $user->id_unit_kerja;
				$nama = $user->nama;
				$nip = $user->nip;
			}
		} else {
			$laporan_harian = $this->report_model->getAllLaporanByMonth($id_user,$bulan);
		}

		// $unit_kerja = $this->report_model->getUnitKerjaById($unit_kerja);

		$kepala_sign = $this->report_model->getPenandatangananByUnitKerja($id_unit_kerja);
		// $
		// var_dump($kepala_sign);

		$laporan = [];
		foreach ($laporan_harian as $key => $value) {
			$laporan[] = [
				$value->tanggal => $value->keterangan	
			];
		}
		
		$pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);

        // $pdf->WriteHTML("$headerHtml");
        // mencetak string
        $pdf->Cell(190,7,'DAFTAR LAPORAN HARIAN PEGAWAI',0,1,'C');
        $pdf->SetLineWidth(0);
        $pdf->Line(10,20,200,20);
        $pdf->Cell(190,7,'',0,1,'C');

		$pdf->SetFont('Arial','',12);

		$pdf->Cell(20,7,'Nama',0,0,'');
		$pdf->Cell(3,7,':',0,0,'');
		$pdf->Cell(20,7,$nama,0,1,'');

		$pdf->Cell(20,7,'NIP',0,0,'');
		$pdf->Cell(3,7,':',0,0,'');
		$pdf->Cell(20,7,$nip,0,1,'');

		$pdf->Cell(20,7,'Unit Kerja',0,0,'');
		$pdf->Cell(3,7,':',0,0,'');
		$pdf->Cell(20,7,(isset($kepala_sign->unit_kerja))?$kepala_sign->unit_kerja:"",0,1,'');

		$pdf->Cell(20,7,'Bulan',0,0,'');
		$pdf->Cell(3,7,':',0,0,'');
		$pdf->Cell(20,7,$disBulan . '/' . $bulan,0,1,'');

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,7,'Hari',1,0,'');
		$pdf->Cell(30,7,'Tanggal',1,0,'');
		$pdf->Cell(130,7,'Keterangan',1,1,'');

		$pdf->SetFont('Arial','',12);

		$month = date("m",$tanggal);
		$year = date("Y",$tanggal);

		$month_end = strtotime('last day of this month', $tanggal);
		$month_start = strtotime('first day of this month', $tanggal);
		$end_month = date('d', $month_end);

		$haricuti = array();
		$sabtuminggu = array();
		
		for ($i=$month_start; $i <= $month_end; $i += (60 * 60 * 24)) {
			if (date('w', $i) !== '0' && date('w', $i) !== '6') {
				$haricuti[] = $i;
			} else {
				$sabtuminggu[] = $i;
			}
		
		}
		$jumlah_cuti = count($haricuti);

		foreach ($haricuti as $key => $value1) {
			$tgl = date('Y-m-d', $value1);
			$hari = strftime("%A", date($value1));
			
			$pdf->Cell(30,7,$hari,1,0,'');
			$pdf->Cell(30,7,$tgl,1,0,'');

				$keterangan = "";
				if ($laporan) {
					foreach ($laporan as $key => $value) {
						if (!empty($value[$tgl])) {
							$keterangan = $value[$tgl];
						}
					}
				}
			$pdf->MultiCell(130,7,$keterangan,1,1,'');
		}

		$signY = $pdf->GetY();

		$pdf->SetY($signY);
		$pdf->SetX(20);
		$pdf->Cell(60,7,(isset($kepala_sign->jabatan))?$kepala_sign->jabatan:"",0,0,'C');

		$pdf->ln(20);
		$nameY = $pdf->GetY();

		$pdf->SetY($nameY);
		$pdf->SetX(20);
		$pdf->Cell(60,7,(isset($kepala_sign->nama))?$kepala_sign->nama:"",0,1,'C');
		$pdf->SetX(20);
		$pdf->Cell(60,7,'NIP. '.(isset($kepala_sign->nip))?$kepala_sign->nip:"",0,0,'C');

		$pdf->SetY($signY);
		$pdf->SetX(160);
		$pdf->Cell(40,7,'Jakarta, ' . date('d M Y'),0,1,'C');
		$pdf->SetX(160);
		$pdf->Cell(60,7,'Pegawai',0,1,'C');
		$pdf->ln(40);
		$pdf->SetY($nameY);
		$pdf->SetX(160);
		$pdf->Cell(60,7,$nama ,0,1,'C');
		$pdf->SetX(160);
		$pdf->Cell(60,7,'NIP. '.$nip,0,0,'C');

		$pdf->Output();
	}

	public function laporan_tukin() 
    {
        $data['title'] = 'Laporan Tunjangan Pegawai';
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();
		$id_user = $this->session->userdata('id_user');

		if($this->input->get('year')){
			$data['year'] = $this->input->get('year');
		} else {
			$data['year'] = date('Y');
		}

		if($this->input->get('month')){
			$data['month'] = $this->input->get('month');
		} else {
			$data['month'] = 0;
		}

		if($data['user']['role_id'] == 1) {
			$data['tukin'] = $this->report_model->getAllTukinAdmin($data['year'],$data['month']);
			$nama_view = "laporan_tukin_admin";
		} else {
			$data['tukin'] = $this->report_model->getAllTukin($id_user,$data['year']);
			$nama_view = "laporan_tukin";
		}


		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('report/'.$nama_view, $data);
		$this->load->view('templates/footer');
    }

	public function download_tukin(){
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();
		$id_user = $this->session->userdata('id_user');

		$id_unit_kerja = $this->session->userdata('id_unit_kerja');
		$nama = $this->session->userdata('nama');
		$nip = $this->session->userdata('nip');

		$year = $this->input->get('year');

		$tukin = $this->report_model->getAllTukin($id_user,$year);

		$kepala_sign = $this->report_model->getPenandatangananByUnitKerja($id_unit_kerja);
		
		$pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);

        // $pdf->WriteHTML("$headerHtml");
        // mencetak string
        $pdf->Cell(190,7,'LAPORAN TUNJANGAN KINERJA PEGAWAI',0,1,'C');
        $pdf->SetLineWidth(0);
        $pdf->Line(10,20,200,20);
        $pdf->Cell(190,7,'',0,1,'C');

		$pdf->SetFont('Arial','',12);

		$pdf->Cell(20,7,'Nama',0,0,'');
		$pdf->Cell(3,7,':',0,0,'');
		$pdf->Cell(20,7,$data['user']['nama'],0,1,'');

		$pdf->Cell(20,7,'NIP',0,0,'');
		$pdf->Cell(3,7,':',0,0,'');
		$pdf->Cell(20,7,$data['user']['nip'],0,1,'');

		$pdf->Cell(20,7,'Unit Kerja',0,0,'');
		$pdf->Cell(3,7,':',0,0,'');
		$pdf->Cell(20,7,'',0,1,'');

		$pdf->Cell(20,7,'Tahun',0,0,'');
		$pdf->Cell(3,7,':',0,0,'');
		$pdf->Cell(20,7,$year,0,1,'');

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,7,'Bulan',1,0,'');
		$pdf->Cell(50,7,'Tunjangan',1,0,'');
		$pdf->Cell(50,7,'Potongan',1,0,'');
		$pdf->Cell(50,7,'Tunjangan Bersih',1,1,'');

		$pdf->SetFont('Arial','',12);

		foreach ($tukin as $key => $value) {
			$pdf->Cell(30,7,$value->bulan,1,0,'');
			$pdf->Cell(50,7,number_format($value->tunjangan_jabatan,2),1,0,'');
			$pdf->Cell(50,7,number_format($value->potongan,2),1,0,'');
			$pdf->Cell(50,7,number_format($value->jml_bersih,2),1,1,'');
		}

		$signY = 230;

		$pdf->SetY($signY);
		$pdf->SetX(20);
		$pdf->Cell(40,7,(isset($kepala_sign->jabatan))?$kepala_sign->jabatan:"",0,0,'C');

		$pdf->ln(20);
		$nameY = $signY+30;

		$pdf->SetY($nameY);
		$pdf->SetX(20);
		$pdf->Cell(40,7,(isset($kepala_sign->nama))?$kepala_sign->nama:"",0,1,'C');
		$pdf->SetX(20);
		$pdf->Cell(40,7,'NIP. '.(isset($kepala_sign->nip))?$kepala_sign->nip:"",0,0,'C');

		$pdf->SetY($signY);
		$pdf->SetX(160);
		$pdf->Cell(40,7,'Pegawai',0,1,'C');
		$pdf->ln(30);
		$pdf->SetY($nameY);
		$pdf->SetX(160);
		$pdf->Cell(40,7,$nama ,0,1,'C');
		$pdf->SetX(160);
		$pdf->Cell(40,7,'NIP. '.$nip,0,0,'C');

		$pdf->Output();
	}

	public function download_tukin_admin(){
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();
		$id_user = $this->session->userdata('id_user');
		
		$id_unit_kerja = $this->session->userdata('id_unit_kerja');
		$nama = $this->session->userdata('nama');
		$nip = $this->session->userdata('nip');

		$year = $this->input->get('year');

		
		$month = $this->input->get('month');

		$tukin = $this->report_model->getAllTukinAdmin($year,$month);

		$eselon = $this->report_model->getEselonI();

		if ($eselon) {
			$namaEselon = $eselon->nama;
			$nipEselon = $eselon->nip;
		} else {
			$namaEselon = "";
			$nipEselon = "";
		}
		
		$pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);

        // $pdf->WriteHTML("$headerHtml");
        // mencetak string
        $pdf->Cell(190,7,'LAPORAN TUNJANGAN KINERJA PEGAWAI',0,1,'C');
        $pdf->SetLineWidth(0);
        $pdf->Line(10,20,200,20);
        $pdf->Cell(190,7,'',0,1,'C');

		$pdf->SetFont('Arial','',12);

		$pdf->Cell(20,7,'Tahun',0,0,'');
		$pdf->Cell(3,7,':',0,0,'');
		$pdf->Cell(20,7,$year,0,1,'');

		$pdf->Cell(20,7,'Bulan',0,0,'');
		$pdf->Cell(3,7,':',0,0,'');
		$pdf->Cell(20,7,date_format(date_create("$year-$month"),'F'),0,1,'');

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,7,'No',1,0,'');
		$pdf->Cell(70,7,'Nama',1,0,'');
		$pdf->Cell(40,7,'Tunjangan',1,0,'');
		$pdf->Cell(30,7,'Potongan',1,0,'');
		$pdf->Cell(40,7,'Tunjangan Bersih',1,1,'');

		$pdf->SetFont('Arial','',12);

		foreach ($tukin as $key => $value) {
			$pdf->Cell(10,7,$key+1,1,0,'');
			$pdf->Cell(70,7,$value->nama,1,0,'');
			$pdf->Cell(40,7,number_format($value->tunjangan_jabatan,2),1,0,'');
			$pdf->Cell(30,7,number_format($value->potongan,2),1,0,'');
			$pdf->Cell(40,7,number_format($value->jml_bersih,2),1,1,'');
		}


		$signY = 200;

		// $pdf->SetY($signY);
		// $pdf->SetX(20);
		// $pdf->Cell(40,7,(isset($kepala_sign->jabatan))?$kepala_sign->jabatan:"",0,0,'C');

		// $pdf->ln(20);
		$nameY = $signY+40;

		$pdf->SetY($nameY);
		// $pdf->SetX(20);
		// $pdf->Cell(40,7,(isset($kepala_sign->nama))?$kepala_sign->nama:"",0,1,'C');
		// $pdf->SetX(20);
		// $pdf->Cell(40,7,'NIP. '.(isset($kepala_sign->nip))?$kepala_sign->nip:"",0,0,'C');

		$pdf->SetY($signY);
		$pdf->SetX(140);
		$pdf->Cell(60,7,'Jakarta, ' . date('d M Y'),0,1,'C');
		$pdf->SetX(140);
		$pdf->Cell(60,7,'Kepala Esselon I',0,1,'C');
		// $pdf->ln(60);
		$pdf->SetY($nameY);
		$pdf->SetX(140);
		$pdf->Cell(60,7,$namaEselon ,0,1,'C');
		$pdf->SetX(140);
		$pdf->Cell(60,7,'NIP. '.$nipEselon,0,0,'C');

		$pdf->Output();
	}

}

