<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    public function index()
    {
        $mahasiswa = $this->input->post('mahasiswa');

        $this->db->select("*");
        $this->db->from("transkrip_nilai");
        $this->db->join("detail_transkrip_nilai", "transkrip_nilai.kd_transkrip_nilai=detail_transkrip_nilai.kd_transkrip_nilai");
        $this->db->join("mahasiswa", "transkrip_nilai.no_mahasiswa=mahasiswa.no_mahasiswa");
        $this->db->join("jurusan", "mahasiswa.jurusan=jurusan.kd_jurusan");
        $this->db->join("mata_kuliah", "jurusan.kd_jurusan=mata_kuliah.jurusan");

        $data['data'] = $this->db->get()->result_array();

        $data['judul'] = "Halaman Report Mahasiswa";
        $this->load->view('base/header', $data);
        $this->load->view('base/sidebar');
        $this->load->view('base/navbar');
        $this->load->view('report/index', $data);
        $this->load->view('base/footer');
    }

    public function get_datatable_mahasiswa()
    {
        $mahasiswa = $this->input->post('mahasiswa');

        $this->datatables->select('transkrip_nilai.kd_transkrip_nilai,transkrip_nilai.no_mahasiswa, transkrip_nilai.nm_mahasiswa, transkrip_nilai.semester, jurusan.nm_jurusan');
        $this->datatables->from('transkrip_nilai');
        $this->datatables->join('mahasiswa', "transkrip_nilai.no_mahasiswa=mahasiswa.no_mahasiswa");
        $this->datatables->join('jurusan', "mahasiswa.jurusan=jurusan.kd_jurusan");
        if ($mahasiswa) {
            $this->datatables->where(['mahasiswa.no_mahasiswa' => $mahasiswa]);
        }
        $this->datatables->add_column(
            'aksi',
            '<span data-toggle="tooltip" data-placement="top" title="Edit Kategori"><a href="javascript:void(0);" class="edit_record btn btn-sm btn-primary" data-id="$1" data-backdrop="static" data-keyboard="false">
                <i class="fas fa-edit"></i> </a> </span>
                <span data-toggle="tooltip" data-placement="top" title="Edit Kategori"><a href="javascript:void(0);" class="detail_record btn btn-sm btn-success" data-id="$1" data-backdrop="static" data-keyboard="false">
                <i class="fas fa-eye"></i> </a> </span>
                <span data-toggle="tooltip" data-placement="top" title="Hapus Kategori"><a href="javascript:void(0);" class="hapus_record btn btn-sm btn-danger" data-id="$1" data-backdrop="static" data-keyboard="false">
                <i class="fas fa-trash"></i> </a>',
            'kd_transkrip_nilai'
        );
        return print_r($this->datatables->generate());
    }

    public function pdf_mahasiswa($mahasiswa)
    {
        $this->db->select("*");
        $this->db->from("mahasiswa");
        $this->db->join("jurusan", "mahasiswa.jurusan=jurusan.kd_jurusan");
        if ($mahasiswa) {
            $this->datatables->where(['mahasiswa.no_mahasiswa' => $mahasiswa]);
        }
        $this->db->group_by('mahasiswa.no_mahasiswa', "DESC");

        $data['mahasiswa'] = $this->db->get()->result_array();

        $dt = $this->db->get_where('transkrip_nilai', ['no_mahasiswa' => $data['mahasiswa'][0]['no_mahasiswa']])->row_array();

        if ($dt) {
            $data['judul'] = "Report Mahasiswa";

            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'landscape');
            $this->pdf->atch = array("Attachment" => TRUE);
            $this->pdf->filename = "laporan-Report-Mahasiswa.pdf";
            $this->pdf->load_view('report/pdf_laporan_mahasiswa', $data);
        } else {
            echo "<script>alert('Data Yang Anda Pilih Tidak Memiliki Transkrip Nilai')</script>";
            echo "<script>window.history.go(-1);</script>";
        }
    }
}
