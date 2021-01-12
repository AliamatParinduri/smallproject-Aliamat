<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mata_kuliah extends CI_Controller
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
		$data['judul'] = "Data Mata Kuliah";
		$data['kd_matkul'] = $this->getKodeOtomatis("KDMK", "mata_kuliah");
		$data['jurusan'] = $this->db->get('jurusan')->result();

		$this->load->view('base/header', $data);
		$this->load->view('base/sidebar');
		$this->load->view('base/navbar');
		$this->load->view('matkul/index', $data);
		$this->load->view('base/footer');
	}

	public function get_matakuliah()
	{

		$this->datatables->select('mata_kuliah.kd_mata_kuliah,mata_kuliah.sks, mata_kuliah.nm_matkul, mata_kuliah.semester, mata_kuliah.jurusan, jurusan.nm_jurusan');
		$this->datatables->from('mata_kuliah');
		$this->datatables->join('jurusan', 'jurusan.kd_jurusan=mata_kuliah.jurusan');
		$this->datatables->add_column(
			'aksi',
			'<span data-toggle="tooltip" data-placement="top" title="Edit Kategori"><a href="javascript:void(0);" class="edit_record btn btn-sm btn-primary" data-id="$1" data-backdrop="static" data-keyboard="false">
                <i class="fas fa-edit"></i> </a> </span>
                <span data-toggle="tooltip" data-placement="top" title="Hapus Kategori"><a href="javascript:void(0);" class="hapus_record btn btn-sm btn-danger" data-id="$1" data-backdrop="static" data-keyboard="false">
                <i class="fas fa-trash"></i> </a>',
			'kd_mata_kuliah'
		);
		return print_r($this->datatables->generate());
	}

	public function add_mata_kuliah()
	{
		$data = [
			'kd_mata_kuliah' => $this->input->post('kd_matkul'),
			'nm_matkul' => $this->input->post('nm_matkul'),
			'sks' => $this->input->post('sks'),
			'jurusan' => $this->input->post('jurusan'),
			'semester' => $this->input->post('semester'),
		];
		$this->db->insert('mata_kuliah', $data);

		if ($this->db->affected_rows() > 0) {
			$data = ['toast' => toast('success', 'Berhasil Tambah Data Mata Kuliah!'), 'kd_matkul' => $this->getKodeOtomatis("KDMK", "mata_kuliah")];
		} else {
			$data = ['toast' => toast('error', 'Gagal Tambah Data Mata Kuliah!'), 'kd_matkul' => null];
		}

		echo json_encode($data);
	}

	public function getMataKuliahById()
	{
		$id = $this->input->post('kd_mata_kuliah');
		$data = $this->db->get_where('mata_kuliah', ['kd_mata_kuliah' => $id])->row_array();

		$this->session->set_userdata('kd_matkul', $id);

		echo json_encode($data);
	}

	public function edit_mata_kuliah()
	{
		$where = ['kd_mata_kuliah' => $this->session->userdata('kd_matkul')];
		$data = [
			'nm_matkul' => $this->input->post('nm_matkul'),
			'sks' => $this->input->post('sks'),
			'jurusan' => $this->input->post('jurusan'),
			'semester' => $this->input->post('semester'),
		];

		$this->db->update('mata_kuliah', $data, $where);

		if ($this->db->affected_rows() >= 0) {
			$data = toast('success', 'Berhasil Ubah Data Mata Kuliah!');
		} else {
			$data = toast('error', 'Gagal Ubah Data Mata Kuliah!');
		}

		$this->session->unset_userdata('kd_matkul');

		echo json_encode($data);
	}

	public function delete_mata_kuliah()
	{
		$where = ['kd_mata_kuliah' => $this->session->userdata('kd_matkul')];

		$this->db->delete('mata_kuliah', $where);

		if ($this->db->affected_rows() > 0) {
			$data = toast('success', 'Berhasil Hapus Data Mata Kuliah!');
		} else {
			$data = toast('error', 'Gagal Hapus Data Mata Kuliah!');
		}

		$this->session->unset_userdata('kd_matkul');

		echo json_encode($data);
	}

	public function get_json()
	{
		// Search term
		$searchTerm = $this->input->post('searchTerm');

		// Get users
		$response = $this->ModelMataKuliah->getMataKuliahjson($searchTerm);

		echo json_encode($response);
	}

	public function get_json_where()
	{
		// Search term
		$searchTerm = $this->input->post('searchTerm');
		$no_mahasiswa = $this->input->post('no_mahasiswa');
		$semester = $this->input->post('semester');

		// Get users
		$response = $this->ModelMataKuliah->getMataKuliahWherejson($searchTerm, $no_mahasiswa, $semester);

		echo json_encode($response);
	}
}
