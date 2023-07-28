<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function getDataChartTotalResponden(){
		$query = "select count(1) total,sum(case when b.id_responden is not null then 1 else 0 end)survey,
        sum(case when b.id_responden is null then 1 else 0 end) not_survey from responden a
        left outer join data_answer b on (a.id = b.id_responden)";
		
		$data = $this->db->query($query);
		return $data->row();
	}

	public function getEventDueDate(){
		$query = "SELECT * FROM events
		WHERE DATE_ADD(current_date, INTERVAL 1 DAY) = date(event_date)";
		
		$data = $this->db->query($query);
		return $data->result();
	}

	public function getUserPegawai($id){
		$query = "SELECT a.*,b.kelas_jabatan,c.unit_kerja,c.tingkatan FROM user a
		LEFT OUTER JOIN kelas_jabatan b ON (a.id_kelas_jabatan = b.id)
		LEFT OUTER JOIN unit_kerja c ON (a.id_unit_kerja = c.id)
		WHERE a.id = $id";
		
		$data = $this->db->query($query);
		return $data->row();
	}

}

?>