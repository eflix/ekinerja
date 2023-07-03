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

		

		$data['laporan_harian'] = $this->report_model->getAllLaporanByMonth($id_user,$bulan);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('report/laporan_harian', $data);
		$this->load->view('templates/footer');
    }

	public function download_laporan(){
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();
		$id_user = $this->session->userdata('id_user');
		$unit_kerja = $this->session->userdata('id_unit_kerja');
		$nama = $this->session->userdata('nama');
		$nip = $this->session->userdata('nip');

		$tanggal = $this->input->get('tanggal');
		$bulan = date("m",$tanggal);
		$disBulan = date("F",$tanggal);

		$laporan_harian = $this->report_model->getAllLaporanByMonth($id_user,$bulan);
		$kepala_sign = $this->report_model->getPenandatangananByUnitKerja($unit_kerja);
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
		$pdf->Cell(20,7,$data['user']['nama'],0,1,'');

		$pdf->Cell(20,7,'NIP',0,0,'');
		$pdf->Cell(3,7,':',0,0,'');
		$pdf->Cell(20,7,$data['user']['nip'],0,1,'');

		$pdf->Cell(20,7,'Unit Kerja',0,0,'');
		$pdf->Cell(3,7,':',0,0,'');
		$pdf->Cell(20,7,'',0,1,'');

		$pdf->Cell(20,7,'Bulan',0,0,'');
		$pdf->Cell(3,7,':',0,0,'');
		$pdf->Cell(20,7,$disBulan . '/' . $bulan,0,1,'');

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,7,'Tanggal',1,0,'');
		$pdf->Cell(30,7,'Hari',1,0,'');
		$pdf->Cell(130,7,'Keterangan',1,1,'');

		$pdf->SetFont('Arial','',12);

		$month = date("m",$tanggal);
		$year = date("Y",$tanggal);
		
		for ($i=1; $i <= 31; $i++) { 
			if (strlen($i) == 1){
				$tanggal = "$year-$month-0$i";
			} else {
				$tanggal = "$year-$month-$i";
			}

			$pdf->Cell(30,7,$tanggal,1,0,'');
			$pdf->Cell(30,7,date('l', strtotime($tanggal)),1,0,'');

				$keterangan = "";
				if ($laporan) {
					foreach ($laporan as $key => $value) {
						if (!empty($value[$tanggal])) {
							$keterangan = $value[$tanggal];
						}
					}
				}
				$pdf->MultiCell(130,7,$keterangan,1,1,'');
		}

		$pdf->ln(10);
		$signY = $pdf->GetY();

		$pdf->SetY($signY);
		$pdf->SetX(20);
		$pdf->Cell(40,7,$kepala_sign->jabatan,0,0,'C');

		$pdf->ln(30);
		$nameY = $pdf->GetY();

		$pdf->SetY($nameY);
		$pdf->SetX(20);
		$pdf->Cell(40,7,$kepala_sign->nama,0,1,'C');
		$pdf->SetX(20);
		$pdf->Cell(40,7,'NIP. '.$kepala_sign->nip,0,0,'C');

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

	public function Laporan_tukin() 
    {
        $data['title'] = 'Laporan Tunjangan Pegawai';
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();
		$id_user = $this->session->userdata('id_user');

		if($this->input->get('year')){
			$data['year'] = $this->input->get('year');
		} else {
			$data['year'] = date('Y');
		}

		$data['tukin'] = $this->report_model->getAllTukin($id_user,$data['year']);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('report/laporan_tukin', $data);
		$this->load->view('templates/footer');
    }

	public function download_tukin(){
		$data['user'] = $this->db->get_where('user', ['nip' => $this->session->userdata('nip')])->row_array();
		$id_user = $this->session->userdata('id_user');

		$year = $this->input->get('year');

		$tukin = $this->report_model->getAllTukin($id_user,$year);
		
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
			$pdf->Cell(50,7,number_format($value->tunjangan,2),1,0,'');
			$pdf->Cell(50,7,number_format($value->potongan,2),1,0,'');
			$pdf->Cell(50,7,number_format($value->jml_bersih,2),1,1,'');
		}

		$pdf->Output();
	}

}

