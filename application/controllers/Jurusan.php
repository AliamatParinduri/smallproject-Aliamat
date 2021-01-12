<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
{

    public function getKodeOtomatis($kode = null, $tabel = null)
    {
        $this->db->select('*');
        $this->db->from("$tabel");
        $query = $this->db->get_compiled_select();
        $sql = $this->db->query($query . " where LEFT(kd_$tabel, " . strlen($kode) . ") = '$kode' ORDER BY kd_$tabel DESC ")->result_array();

        $kode = $kode;

        if ($sql != Null) {
            $pisah = explode("-", $sql[0]["kd_" . $tabel]);

            $number =  (int) $pisah[1];
            $digit = intval($number) + 1;

            if ($digit >= 1 and $digit <= 9) {
                $a = $kode . "-00" . $digit;
            } else if ($digit >= 10 and $digit <= 99) {
                $a = $kode . "-0" . $digit;
            } else {
                $a = $kode . "-" . $digit;
            }
        } else {
            $kodedefault = $kode . "-001";
            $a = $kodedefault;
        }

        return $a;
    }

    public function index()
    {
        $data['judul'] = "Data Jurusan";
        $data['kd_jurusan'] = $this->getKodeOtomatis("KJR", "jurusan");

        $this->load->view('base/header', $data);
        $this->load->view('base/sidebar');
        $this->load->view('base/navbar');
        $this->load->view('jurusan/index', $data);
        $this->load->view('base/footer');
    }

    public function get_jurusan()
    {

        $this->datatables->select('kd_jurusan, nm_jurusan');
        $this->datatables->from('jurusan');
        $this->datatables->add_column(
            'aksi',
            '<span data-toggle="tooltip" data-placement="top" title="Edit Kategori"><a href="javascript:void(0);" class="edit_record btn btn-sm btn-primary" data-id="$1" data-backdrop="static" data-keyboard="false">
                <i class="fas fa-edit"></i> </a> </span>
                <span data-toggle="tooltip" data-placement="top" title="Hapus Kategori"><a href="javascript:void(0);" class="hapus_record btn btn-sm btn-danger" data-id="$1" data-backdrop="static" data-keyboard="false">
                <i class="fas fa-trash"></i> </a>',
            'kd_jurusan'
        );
        return print_r($this->datatables->generate());
    }

    public function add_jurusan()
    {
        $data = [
            'kd_jurusan' => $this->input->post('kd_jurusan'),
            'nm_jurusan' => $this->input->post('nm_jurusan'),
        ];
        $this->db->insert('jurusan', $data);

        if ($this->db->affected_rows() > 0) {
            $data = ['toast' => toast('success', 'Berhasil Tambah Data Jurusan!'), 'kd_jurusan' => $this->getKodeOtomatis("KJR", "jurusan")];
        } else {
            $data = ['toast' => toast('error', 'Gagal Tambah Data Jurusan!'), 'kd_jurusan' => null];
        }

        echo json_encode($data);
    }

    public function getJurusanById()
    {
        $id = $this->input->post('kd_jurusan');
        $data = $this->db->get_where('jurusan', ['kd_jurusan' => $id])->row_array();

        $this->session->set_userdata('kd_jurusan', $id);

        echo json_encode($data);
    }

    public function edit_jurusan()
    {
        $where = ['kd_jurusan' => $this->session->userdata('kd_jurusan')];
        $data = [
            'nm_jurusan' => $this->input->post('nm_jurusan'),
        ];

        $this->db->update('jurusan', $data, $where);

        if ($this->db->affected_rows() >= 0) {
            $data = toast('success', 'Berhasil Ubah Data Jurusan!');
        } else {
            $data = toast('error', 'Gagal Ubah Data Jurusan!');
        }

        $this->session->unset_userdata('kd_matkul');

        echo json_encode($data);
    }

    public function delete_jurusan()
    {
        $where = ['kd_jurusan' => $this->session->userdata('kd_jurusan')];

        $this->db->delete('jurusan', $where);

        if ($this->db->affected_rows() > 0) {
            $data = toast('success', 'Berhasil Hapus Data Jurusan!');
        } else {
            $data = toast('error', 'Gagal Hapus Data Jurusan!');
        }

        $this->session->unset_userdata('kd_jurusan');

        echo json_encode($data);
    }

    public function get_json()
    {
        // Search term
        $searchTerm = $this->input->post('searchTerm');

        // Get users
        $response = $this->ModelJurusan->getJurusanjson($searchTerm);

        echo json_encode($response);
    }
}
