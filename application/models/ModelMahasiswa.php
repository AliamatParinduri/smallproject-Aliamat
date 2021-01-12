<?php
class ModelMahasiswa extends CI_Model
{
    public function getMahasiswajson($searchTerm)
    {
        $this->db->select('*');
        $this->db->like("nm_mahasiswa", $searchTerm);
        $fetched_records = $this->db->get('mahasiswa');
        $users = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['no_mahasiswa'], "text" => $user['nm_mahasiswa'] . " - " . $user['no_mahasiswa']);
        }
        return $data;
    }
}
