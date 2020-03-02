<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			// validasi sukses
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			//jika user ada
			if ($user['is_active'] == 1) {
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];

					$this->session->set_userdata($data);
					if ($user['role_id'] == 1) {
						redirect('admin');
					} else {
						redirect('user');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Salah Password!
					</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				User tidak aktif!
				</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Email belum terdaftar!
			</div>');
			redirect('auth');
		}
	}

	public function registration()
	{
		$this->form_validation->set_rules('name', 'Nama', 'required|trim');
		$this->form_validation->set_rules('email', 'E-Mail', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'User sudah terdaftar!'
		]);
		$this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'password tidak sama!',
			'min_length' => 'panjang password kurang dari 3 karakter!'
		]);
		$this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Registration';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {
			$data = [
				'name' => htmlspecialchars($this->input->post('name')),
				'email' => htmlspecialchars($this->input->post('email')),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 1,
				'date_created' => time()
			];

			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			User telah dibuat, Silahkan Login!
			</div>');

			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
		Anda telah keluar!
		</div>');
		redirect('auth');
	}


	public function blocked()
	{
		$data['title'] = 'Blocked';

		$this->load->view('templates/header', $data);
		$this->load->view('auth/blocked');
		$this->load->view('templates/footer');
	}
}
