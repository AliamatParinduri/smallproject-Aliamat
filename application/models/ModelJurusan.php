<?php
class ModelJurusan extends CI_Model
{
    public function getJurusanjson($searchTerm)
    {
        $this->db->select('*');
        $this->db->like("nm_jurusan", $searchTerm);
        $fetched_records = $this->db->get('jurusan');
        $users = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['kd_jurusan'], "text" => $user['nm_jurusan']);
        }
        return $data;
    }
}
