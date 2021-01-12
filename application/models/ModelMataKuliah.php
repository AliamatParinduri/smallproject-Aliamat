<?php
class ModelMataKuliah extends CI_Model
{
    public function getMataKuliahjson($searchTerm)
    {
        $this->db->select('*');
        $this->db->where("semester", $this->session->userdata('semester'));
        $this->db->like("nm_matkul", $searchTerm);
        $fetched_records = $this->db->get('mata_kuliah');
        $users = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['kd_mata_kuliah'], "text" => $user['nm_matkul']);
        }
        return $data;
    }

    public function getMataKuliahWherejson($searchTerm, $no_mahasiswa, $semester)
    {
        $data = $this->db->get_where('mahasiswa', ['no_mahasiswa' => $no_mahasiswa])->row_array();

        $this->db->select('*');
        $this->db->from("mata_kuliah");
        $this->db->join("mahasiswa", "mata_kuliah.jurusan=mahasiswa.jurusan");
        $this->db->like("mata_kuliah.nm_matkul", $searchTerm);
        $this->db->where(["mata_kuliah.semester" => $semester, 'mahasiswa.jurusan' => $data['jurusan']]);
        $fetched_records = $this->db->get('');
        $users = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['kd_mata_kuliah'], "text" => $user['nm_matkul']);
        }
        return $data;
    }
}
