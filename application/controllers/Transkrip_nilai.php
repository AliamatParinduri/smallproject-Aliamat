<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transkrip_nilai extends CI_Controller
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
        $data['judul'] = "Data Transkrip Nilai";
        $data['mahasiswa'] = $this->db->get('mahasiswa')->result_array();
        $data['transkrip'] = $this->db->get('detail_transkrip_nilai')->result_array();

        $this->load->view('base/header', $data);
        $this->load->view('base/sidebar');
        $this->load->view('base/navbar');
        $this->load->view('transkrip/index', $data);
        $this->load->view('base/footer');
    }

    public function get_transkrip()
    {

        $this->datatables->select('transkrip_nilai.kd_transkrip_nilai,transkrip_nilai.no_mahasiswa, transkrip_nilai.nm_mahasiswa, transkrip_nilai.semester, jurusan.nm_jurusan');
        $this->datatables->from('transkrip_nilai');
        $this->datatables->join('mahasiswa', "transkrip_nilai.no_mahasiswa=mahasiswa.no_mahasiswa");
        $this->datatables->join('jurusan', "mahasiswa.jurusan=jurusan.kd_jurusan");
        $this->datatables->add_column(
            'aksi',
            '<span data-toggle="tooltip" data-placement="top" title="Edit Kategori"><a href="javascript:void(0);" class="detail_record btn btn-sm btn-success" data-id="$1" data-backdrop="static" data-keyboard="false">
                <i class="fas fa-eye"></i> </a> </span>
                <span data-toggle="tooltip" data-placement="top" title="Hapus Kategori"><a href="javascript:void(0);" class="hapus_record btn btn-sm btn-danger" data-id="$1" data-backdrop="static" data-keyboard="false">
                <i class="fas fa-trash"></i> </a>',
            'kd_transkrip_nilai'
        );
        return print_r($this->datatables->generate());
    }

    public function getTranskripById()
    {
        $kd_transkrip = $this->input->post('kd_transkrip');

        $this->db->select("*");
        $this->db->from("transkrip_nilai");
        $this->db->join("detail_transkrip_nilai", "transkrip_nilai.kd_transkrip_nilai=detail_transkrip_nilai.kd_transkrip_nilai");
        $this->db->join("mata_kuliah", "detail_transkrip_nilai.kd_matkul=mata_kuliah.kd_mata_kuliah");
        $this->db->join("mahasiswa", "transkrip_nilai.no_mahasiswa=mahasiswa.no_mahasiswa");
        $this->db->join("jurusan", "mahasiswa.jurusan=jurusan.kd_jurusan");
        $this->db->where(['transkrip_nilai.kd_transkrip_nilai' => $kd_transkrip]);
        $data = $this->db->get()->result_array();

        $this->session->set_userdata('kd_transkrip', $kd_transkrip);

        echo json_encode($data);
    }

    public function add_transkrip()
    {
        $data['judul'] = "Tambah Data Transkrip Nilai";
        $data['kd_transkrip'] = $this->getKodeOtomatis("TRS", "transkrip_nilai");

        $this->load->view('base/header', $data);
        $this->load->view('base/sidebar');
        $this->load->view('base/navbar');
        $this->load->view('transkrip/add', $data);
        $this->load->view('base/footer');
    }

    public function cari_data()
    {
        $semester = $this->input->post('semester');

        $this->session->set_userdata('semester', $semester);

        $data = $this->db->get_where('mata_kuliah', ['semester' => $semester])->result_array();

        echo json_encode($data);
    }

    public function add_transkrip_nilai()
    {

        $no_mhs = $this->input->post('mahasiswa');
        $kd_transkrip_nilai = $this->input->post('kd_transkrip');
        $mata_kuliah = $this->input->post('mata_kuliah');

        if ($mata_kuliah && !empty($no_mhs) && !empty($mata_kuliah)) {
            $dt = $this->db->get_where('mahasiswa', ['no_mahasiswa' => $no_mhs])->row_array();

            $data = [
                'kd_transkrip_nilai' => $kd_transkrip_nilai,
                'no_mahasiswa'       => $no_mhs,
                'nm_mahasiswa'       => $dt['nm_mahasiswa'],
                'semester'           => $this->input->post('semester'),
            ];

            $this->db->insert('transkrip_nilai', $data);

            for ($i = 0; $i < count($mata_kuliah); $i++) {
                $dataDetail = [
                    'kd_transkrip_nilai' => $kd_transkrip_nilai,
                    'kd_matkul'          => $mata_kuliah[$i],
                    'mutu_matkul'        => $this->input->post('jml_mutu')[$i]
                ];

                $this->db->insert('detail_transkrip_nilai', $dataDetail);
            }
        }

        if ($this->db->affected_rows() > 0) {
            $data = toast('success', 'Berhasil Tambah Data Transkrip Nilai!');
        } else {
            $data = toast('error', 'Gagal Tambah Data Transkrip Nilai!');
        }

        echo json_encode($data);
    }

    public function edit_transkrip_nilai()
    {
        $emata_kuliah = $this->input->post('emata_kuliah');
        $ejml_mutu = $this->input->post('ejml_mutu');

        $mata_kuliah = $this->input->post('mata_kuliah');
        $jml_mutu = $this->input->post('jml_mutu');

        $tmpng_detail_hapus = $this->input->post('tmpng_detail_hapus');

        if ($tmpng_detail_hapus) {
            for ($i = 0; $i < count($tmpng_detail_hapus); $i++) {
                $this->db->delete('detail_transkrip_nilai', ['kd_detail' => $tmpng_detail_hapus[$i]]);
            }
        }

        for ($i = 0; $i < count($emata_kuliah); $i++) {
            $dataUpdate = [
                'kd_matkul' => $emata_kuliah[$i],
                'mutu_matkul' => $ejml_mutu[$i],
            ];
            $this->db->update('detail_transkrip_nilai', $dataUpdate, ['kd_detail' => $this->input->post('kd_detail_transkrip')[$i]]);
        }

        if ($jml_mutu) {
            for ($i = 0; $i < count($mata_kuliah); $i++) {
                $dataInsert = [
                    'kd_transkrip_nilai' => $this->session->userdata('kd_transkrip'),
                    'kd_matkul' => $mata_kuliah[$i],
                    'mutu_matkul' => $jml_mutu[$i],
                ];
                $this->db->insert('detail_transkrip_nilai', $dataInsert);
            }
        }

        if ($this->db->affected_rows() >= 0) {
            $data = toast('success', 'Berhasil Ubah Data Transkrip Nilai!');
        } else {
            $data = toast('error', 'Gagal Ubah Data Transkrip Nilai!');
        }

        $this->session->unset_userdata('kd_transkrip');

        echo json_encode($data);
    }

    public function delete_transkrip_nilai()
    {
        $where = ['kd_transkrip_nilai' => $this->session->userdata('kd_transkrip')];

        $this->db->delete('transkrip_nilai', $where);
        $this->db->delete('detail_transkrip_nilai', $where);

        if ($this->db->affected_rows() > 0) {
            $data = toast('success', 'Berhasil Hapus Data Transkrip Nilai!');
        } else {
            $data = toast('error', 'Gagal Hapus Data Transkrip Nilai!');
        }

        $this->session->unset_userdata('kd_transkrip');

        echo json_encode($data);
    }
}
