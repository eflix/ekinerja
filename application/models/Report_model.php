<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

	public function data_chart_by_gender(){
		$query = "select sum(1) total,sum(case when jenis_kelamin = 'pria' then 1 else 0 end) pria,
        sum(case when jenis_kelamin = 'wanita' then 1 else 0 end) wanita from responden";
		
		$data = $this->db->query($query);
		return $data->row();
	}

	public function datatable_gender(){
		$query = "select jenis_kelamin kategori,count(1) total from responden
		group by jenis_kelamin";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function datatable_umur(){
		$query = "select 'r_17_30' kategori,count(id) total from (
			select *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tanggal_lahir)), '%Y') + 0 AS age
			from responden) a where age >= 17 and age <=30
			union ALL
			select 'r_31_50' category,count(id) total from (
			select *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tanggal_lahir)), '%Y') + 0 AS age
			from responden) a where age >= 31 and age <= 50
			union ALL
			select 'r_51' category,count(id) total from (
			select *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tanggal_lahir)), '%Y') + 0 AS age
			from responden) a where age >= 51 and age <= 50";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function datatable_agama(){
		$query = "select agama kategori,count(1) total from responden
		group by agama";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function datatable_kecamatan(){
		$query = "select a.id,a.name kategori,count(b.id) total from regional_districts a
		left outer join responden b on (a.id = b.kecamatan)
		where regency_id = 1275
		group by a.id,a.name";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function getRespondenByParam($category,$value){
		
		if($category == 'umur'){
			$query = " select * from (select *,'r_17_30' kategori,count(id) total from (
				select *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tanggal_lahir)), '%Y') + 0 AS age
				from responden) a where age >= 17 and age <=30
				union ALL
				select *,'r_31_50' category,count(id) total from (
				select *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tanggal_lahir)), '%Y') + 0 AS age
				from responden) a where age >= 31 and age <= 50
				union ALL
				select *,'r_51' category,count(id) total from (
				select *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tanggal_lahir)), '%Y') + 0 AS age
				from responden) a where age >= 51 and age <= 50) x where kategori = '$value'";
		
		$data = $this->db->query($query);
		return $data->result();
		} else if ($category == 'all'){
			return $query = $this->db->get('responden')->result();
		} 
		else {
			return $query = $this->db->get_where('responden',[$category =>$value])->result();
		}
	}

	public function data_chart_by_umur(){
		$query = "select count(1) total,sum(case when age >= 17 and age <=30 then 1 else 0 end) r_17_30,
		sum(case when age >= 31 and age <=50 then 1 else 0 end) r_31_50,
		sum(case when age >= 51 then 1 else 0 end) r_51 from (
		SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), tanggal_lahir)), '%Y') + 0 AS age
		FROM responden
		) tbl_a";
		
		$data = $this->db->query($query);
		return $data->row();
	}

	public function data_chart_by_agama(){
		$query = "select count(1) total,sum(case when agama = 'islam' then 1 else 0 end) islam,
		sum(case when agama = 'kristen' then 1 else 0 end) kristen,
		sum(case when agama = 'katolik' then 1 else 0 end) katolik,
		sum(case when agama = 'hindu' then 1 else 0 end) hindu,
		sum(case when agama = 'budha' then 1 else 0 end) budha,
		sum(case when agama = 'konghucu' then 1 else 0 end) konghucu,
		sum(case when agama = 'lainnya' then 1 else 0 end) lainnya
		from responden";
		
		$data = $this->db->query($query);
		return $data->row();
	}

	public function data_chart_by_kecamatan(){
		$query = "select 0 id,'Total' district,count(1) total from responden
		union all
		select a.id,a.name,count(b.id) total from regional_districts a
		left outer join responden b on (a.id = b.kecamatan)
		where regency_id = 1275
		group by a.id,a.name";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function getAllVillages(){
		$query = "select a.id id_kec,a.name kecamatan,b.id,b.name kelurahan,count(c.id) total from regional_districts a 
		inner join regional_villages b on (a.id = b.district_id) 
		left outer join responden c on (b.id = c.kelurahan)
		where regency_id = 1275
		group by  b.id,b.name";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function get_chart_by_village(){
		$query = "select a.id id_kec,a.name kecamatan,b.id,b.name kelurahan,count(c.id) total from regional_districts a 
		inner join regional_villages b on (a.id = b.district_id) 
		left outer join responden c on (b.id = c.kelurahan)
		where regency_id = 1275
		group by  b.id,b.name";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function data_chart_by_kecamatan_tokoh(){
		$query = "select 0 id,'Total' district,count(1) total from tokoh
		union all
		select a.id,a.name,count(b.id) total from regional_districts a
		left outer join tokoh b on (a.id = b.kecamatan)
		where regency_id = 1275
		group by a.id,a.name";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function datatable_kecamatan_tokoh(){
		$query = "select a.id,a.name kategori,count(b.id) total from regional_districts a
		left outer join tokoh b on (a.id = b.kecamatan)
		where regency_id = 1275
		group by a.id,a.name";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function getAllLaporanHarianByUser($id){
		return $query = $this->db->get_where('laporan_harian',['id_user' => $id])->result();
	}

	public function getAllLaporanByMonth($id,$month){
		return $query = $this->db->get_where('laporan_harian',['id_user' => $id,'month(tanggal)' => $month])->result();
	}

	public function getAllTukin($id_user,$year){
		$query = "SELECT bulan,tunjangan_jabatan,jml_tdk_masuk*potongan potongan,tunjangan_jabatan-(jml_tdk_masuk*potongan) jml_bersih 
		FROM (
		select bulan,jml_masuk,20-jml_masuk jml_tdk_masuk,tunjangan_jabatan,
		(0.3/100)*tunjangan_jabatan potongan FROM (
					SELECT MONTH(a.tanggal) bulan,COUNT(a.tanggal) jml_masuk,c.tunjangan_jabatan FROM laporan_harian a
					LEFT OUTER JOIN user b ON (a.id_user = b.id)
					LEFT OUTER JOIN kelas_jabatan c ON (b.id_kelas_jabatan = c.id) 
					WHERE a.id_user = $id_user AND YEAR(a.tanggal) = $year
					) tunjangan
		) tunjangan";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function getAllTukinAdmin($year,$month){
		$query = "SELECT nama,bulan,tunjangan_jabatan,jml_tdk_masuk*potongan potongan,tunjangan_jabatan-(jml_tdk_masuk*potongan) jml_bersih 
		FROM (
		select nama,bulan,jml_masuk,20-jml_masuk jml_tdk_masuk,tunjangan_jabatan,
		(0.3/100)*tunjangan_jabatan potongan FROM (
					SELECT b.nama,MONTH(a.tanggal) bulan,COUNT(a.tanggal) jml_masuk,c.tunjangan_jabatan FROM laporan_harian a
					LEFT OUTER JOIN user b ON (a.id_user = b.id)
					LEFT OUTER JOIN kelas_jabatan c ON (b.id_kelas_jabatan = c.id) 
					WHERE YEAR(a.tanggal) = $year AND MONTH(a.tanggal) = $month
					GROUP BY b.nama
					) tunjangan
		) tunjangan";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function getPenandatangananByUnitKerja($id_unit_kerja){
		// return $query = $this->db->get('penandatanganan a')
		// 				->join('unit_kerja b','a.id_unit_kerja = b.id','inner')
		// 				->row();

		$query = "select a.*,b.unit_kerja from penandatanganan a
				inner join unit_kerja b on (a.id_unit_kerja = b.id)
				where a.id_unit_kerja = $id_unit_kerja";
		
		$data = $this->db->query($query);
		return $data->row();
	}

	public function getAllUser(){
		return $query = $this->db->get_where('user',['role_id' => 2,'is_active' => 1])->result();
	}

	public function getUserById($id){
		return $query = $this->db->get_where('user',['id'=>$id])->row();
	}
}

?>