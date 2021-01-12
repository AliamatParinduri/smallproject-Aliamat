<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{

	public function getKodeOtomatis($kode = null, $tabel = null)
	{
		$this->db->select('*');
		$this->db->from("$tabel");
		$query = $this->db->get_compiled_select();
		$sql = $this->db->query($query . " where LEFT(no_$tabel, " . strlen($kode) . ") = '$kode' ORDER BY no_$tabel DESC ")->row_array();
		$kode = $kode;
		$tahun = date('y', time());

		if ($sql != Null && substr($sql["no_$tabel"], -7, 2) == $tahun) {

			$number = (int) substr($sql["no_$tabel"], -5);
			$digit = intval($number) + 1;

			if ($digit >= 1 and $digit <= 9) {
				$a = $kode . $tahun . "00" . $digit;
			} else if ($digit >= 10 and $digit <= 99) {
				$a = $kode . $tahun . "0" . $digit;
			} else {
				$a = $kode . $tahun . $digit;
			}
		} else {
			$kodedefault = $kode . $tahun . "00001";
			$a = $kodedefault;
		}

		return $a;
	}

	public function index()
	{
		$data['judul'] = "Data Mahasiswa";
		$data['kd_mahasiswa'] = $this->getKodeOtomatis("12", "mahasiswa");
		$data['jurusan'] = $this->db->get('jurusan')->result();

		$this->load->view('base/header', $data);
		$this->load->view('base/sidebar');
		$this->load->view('base/navbar');
		$this->load->view('mahasiswa/index', $data);
		$this->load->view('base/footer');
	}

	public function get_mahasiswa()
	{

		$this->datatables->select('mahasiswa.no_mahasiswa, mahasiswa.nm_mahasiswa, mahasiswa.semester, mahasiswa.jurusan, jurusan.nm_jurusan');
		$this->datatables->from('mahasiswa');
		$this->datatables->join('jurusan', 'mahasiswa.jurusan=jurusan.kd_jurusan');
		$this->datatables->add_column(
			'aksi',
			'<span data-toggle="tooltip" data-placement="top" title="Edit Kategori"><a href="javascript:void(0);" class="edit_record btn btn-sm btn-primary" data-id="$1" data-backdrop="static" data-keyboard="false">
                <i class="fas fa-edit"></i> </a> </span>
                <span data-toggle="tooltip" data-placement="top" title="Hapus Kategori"><a href="javascript:void(0);" class="hapus_record btn btn-sm btn-danger" data-id="$1" data-backdrop="static" data-keyboard="false">
                <i class="fas fa-trash"></i> </a>',
			'no_mahasiswa'
		);
		return print_r($this->datatables->generate());
	}

	public function add_mahasiswa()
	{
		$data = [
			'no_mahasiswa' => $this->input->post('kd_mahasiswa'),
			'nm_mahasiswa' => $this->input->post('nm_mahasiswa'),
			'jurusan' => $this->input->post('jurusan'),
			'semester' => $this->input->post('semester'),
		];
		$this->db->insert('mahasiswa', $data);

		if ($this->db->affected_rows() > 0) {
			$data = ['toast' => toast('success', 'Berhasil Tambah Data Mahasiswa!'), 'kd_matkul' => $this->getKodeOtomatis("12", "mahasiswa")];
		} else {
			$data = ['toast' => toast('error', 'Gagal Tambah Data Mahasiswa!'), 'kd_matkul' => null];
		}

		echo json_encode($data);
	}

	public function getMahasiswaById()
	{
		$id = $this->input->post('kd_mahasiswa');
		$data = $this->db->get_where('mahasiswa', ['no_mahasiswa' => $id])->row_array();

		$this->session->set_userdata('kd_mahasiswa', $id);

		echo json_encode($data);
	}

	public function edit_mahasiswa()
	{
		$where = ['no_mahasiswa' => $this->session->userdata('kd_mahasiswa')];
		$data = [
			'nm_mahasiswa' => $this->input->post('nm_mahasiswa'),
			'jurusan' => $this->input->post('jurusan'),
			'semester' => $this->input->post('semester'),
		];

		$this->db->update('mahasiswa', $data, $where);

		if ($this->db->affected_rows() >= 0) {
			$data = toast('success', 'Berhasil Ubah Data Mahasiswa!');
		} else {
			$data = toast('error', 'Gagal Ubah Data Mahasiswa!');
		}

		$this->session->unset_userdata('kd_matkul');

		echo json_encode($data);
	}

	public function delete_mahasiswa()
	{
		$where = ['no_mahasiswa' => $this->session->userdata('kd_mahasiswa')];

		$this->db->delete('mahasiswa', $where);

		if ($this->db->affected_rows() > 0) {
			$data = toast('success', 'Berhasil Hapus Data Mahasiswa!');
		} else {
			$data = toast('error', 'Gagal Hapus Data Mahasiswa!');
		}

		$this->session->unset_userdata('kd_mahasiswa');

		echo json_encode($data);
	}

	public function get_json()
	{
		// Search term
		$searchTerm = $this->input->post('searchTerm');

		// Get users
		$response = $this->ModelMahasiswa->getMahasiswajson($searchTerm);

		echo json_encode($response);
	}
}
