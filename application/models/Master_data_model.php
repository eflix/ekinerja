<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_data_model extends CI_Model {

	public function getAllResponden(){
		$query = "select a.*,b.name text_provinsi,c.name text_kabupaten,d.name text_kecamatan,e.name text_kelurahan 
		from responden a
		left outer join regional_provinces b on (a.provinsi = b.id)
		left outer join regional_regencies c on (a.kabupaten = c.id)
		left outer join regional_districts d on (a.kecamatan = d.id)
		left outer join regional_villages e on (a.kelurahan = e.id)";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function getAllProvince(){
		return $query = $this->db->get('regional_provinces')->result();
	}

	public function getRegencieByProvince($id,$search){
		$query = "select rr.id id,rr.name text from regional_regencies rr
		left outer join regional_provinces rp on (rr.province_id = rp.id) where rp.id = $id and rr.name like '%$search%'";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function getDistrictByParam($search,$id_province,$id_regencie){
		$query = "select rd.id id,rd.name text
		from regional_districts rd
		inner join regional_regencies rr on (rd.regency_id = rr.id)
		inner join regional_provinces rp on (rr.province_id = rp.id)
		where rr.province_id = $id_province and rd.regency_id = $id_regencie and rd.name like '%$search%'";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function getVillageByParam($search,$id_province,$id_regencie,$id_district){
		// $query = "select rv.id id,rv.name text
		// from regional_villages rv
		// inner join regional_districts rd on (rv.district_id = rd.id)
		// inner join regional_regencies rr on (rd.regency_id = rr.id)
		// inner join regional_provinces rp on (rr.province_id = rp.id)
		// where rr.province_id = $id_province and rd.regency_id = $id_regencie and rv.district_id = $id_district and rd.name like '%$search%'";

		$query = "select rv.id id,rv.name text
		from regional_villages rv
		where rv.district_id = $id_district and rv.name like '%$search%'";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function getRespondenById($id){
		$query = "select a.*,b.name text_provinsi,c.name text_kabupaten,d.name text_kecamatan,e.name text_kelurahan 
		from responden a
		left outer join regional_provinces b on (a.provinsi = b.id)
		left outer join regional_regencies c on (a.kabupaten = c.id)
		left outer join regional_districts d on (a.kecamatan = d.id)
		left outer join regional_villages e on (a.kelurahan = e.id)
		where a.id = $id";
		
		$data = $this->db->query($query);
		return $data->row();
	}

	public function getAllTokoh(){
		$query = "select a.*,b.name text_provinsi,c.name text_kabupaten,d.name text_kecamatan,e.name text_kelurahan 
		from tokoh a
		left outer join regional_provinces b on (a.provinsi = b.id)
		left outer join regional_regencies c on (a.kabupaten = c.id)
		left outer join regional_districts d on (a.kecamatan = d.id)
		left outer join regional_villages e on (a.kelurahan = e.id)";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function getTokohById($id){
		$query = "select a.*,b.name text_provinsi,c.name text_kabupaten,d.name text_kecamatan,e.name text_kelurahan 
		from tokoh a
		left outer join regional_provinces b on (a.provinsi = b.id)
		left outer join regional_regencies c on (a.kabupaten = c.id)
		left outer join regional_districts d on (a.kecamatan = d.id)
		left outer join regional_villages e on (a.kelurahan = e.id)
		where a.id = $id";
		
		$data = $this->db->query($query);
		return $data->row();
	}

	public function getAllEvent(){
		return $query = $this->db->get('events')->result();
	}

	public function getEventById($id){
		return $query = $this->db->get_where('events',['id' => $id])->row();
	}

	public function getAllCategory(){
		return $query = $this->db->get('kategori')->result();
	}
	
	public function getAllInstansi(){
		return $query = $this->db->get('instansi')->result();
	}

	public function getAllUnitKerja(){
		return $query = $this->db->get('unit_kerja')->result();
	}

	public function getAllGolongan(){
		return $query = $this->db->get('golongan')->result();
	}
	
}

?>