<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function index()
	{
		$this->load->view('auth/login');
	}

	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('users', ['username' => $email])->row();

		if ($user) {
			if (password_verify($password, $user->password)) {
				$data = array('username' => $user->username);

				$this->session->set_userdata($data);

				echo 1;
			} else {
				echo 2;
			}
		} else {
			echo 2;
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		redirect('auth');
	}
}
