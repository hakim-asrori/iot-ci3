<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();

		if (empty($this->session->userdata('username'))) {
			redirect('auth');
		}
	}

	public function index()
	{
		$data = [
			'konten' => 'admin/dashboard'
		];
		$this->load->view('layout/konten', $data);
	}

	public function karyawan()
	{
		$data = [
			'konten' => 'admin/karyawan'
		];
		$this->load->view('layout/konten', $data);
	}

	public function jenis()
	{
		$data = [
			'konten' => 'admin/jenis'
		];
		$this->load->view('layout/konten', $data);
	}

	public function kendaraan()
	{
		$data = [
			'konten' => 'admin/kendaraan'
		];
		$this->load->view('layout/konten', $data);
	}
}
