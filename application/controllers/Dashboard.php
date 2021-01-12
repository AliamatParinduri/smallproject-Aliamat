<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function index()
	{
		$data['judul'] = "Dashboard";
		$this->load->view('base/header', $data);
		$this->load->view('base/sidebar');
		$this->load->view('base/navbar');
		$this->load->view('welcome_message');
		$this->load->view('base/footer');
	}
}
