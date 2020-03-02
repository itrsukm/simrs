<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_login();
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

	public function role()
	{
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get('role')->result_array();

		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->insert('role', ['role' => $this->input->post('role')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Role Telah ditambahkan.
			</div>');
			redirect('admin/role');
		}
	}

	public function roleAccess($role_id)
	{
		$data['title'] = 'Role Access';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get_where('role', ['id' => $role_id])->row_array();

		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('templates/footer');
	}

	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
		Access telah diubah.
		</div>');
	}

	public function getEditRole()
	{
		$id = $this->input->post('id');
		$data = $this->db->get_where('role', ['id' => $id])->row_array();

		echo json_encode($data);
	}

	public function updaterole()
	{
		$id = $this->input->post('id');
		$role = $this->input->post('role');

		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get('role')->result_array();

		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->set('role', $role);
			$this->db->where('id', $id);
			$this->db->update('role');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Role telah diubah.
			</div>');
			redirect('admin/role');
		}
	}

	public function deleterole($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('role');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Role telah dihapus!
			</div>');
		redirect('admin/role');
	}

	public function addUser()
	{ }
}
