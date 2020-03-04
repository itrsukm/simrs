<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_login();
	}

	public function index()
	{
		$data['title'] = 'Menu Management';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu', 'Menu', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/index', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Menu ditambahkan.
			</div>');
			redirect('menu');
		}
	}

	public function submenu()
	{
		$data['title'] = 'Submenu Management';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->model('menu_model', 'menu');

		$data['subMenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/submenu', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')
			];


			$this->db->insert('user_sub_menu', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Submenu ditambahkan.
			</div>');
			redirect('menu/submenu');
		}
	}

	public function getEditSubmenu()
	{
		$id = $this->input->post('id');
		$data = $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();

		echo json_encode($data);
	}

	public function updateSubmenu()
	{
		$data['title'] = 'Submenu Management';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->model('menu_model', 'menu');

		$data['subMenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/submenu', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'id' => $this->input->post('id'),
				'title' => $this->input->post('title', TRUE),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url', TRUE),
				'icon' => $this->input->post('icon', TRUE),
				'is_active' => $this->input->post('is_active')
			];

			$this->db->set($data);
			$this->db->where('id', $data['id']);
			$this->db->update('user_sub_menu');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Submenu diubah.
			</div>');
			redirect('menu/submenu');
		}
	}

	public function deleteSubmenu($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('user_sub_menu');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Submenu telah dihapus!
			</div>');
		redirect('menu/submenu');
	}

	public function getEditMenu()
	{
		$id = $this->input->post('id');
		$data = $this->db->get_where('user_menu', ['id' => $id])->row_array();

		echo json_encode($data);
	}

	public function updateMenu()
	{
		$id = $this->input->post('id');
		$menu = $this->input->post('menu');

		$data['title'] = 'Menu Management';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu', 'Menu', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/index', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->set('menu', $menu);
			$this->db->where('id', $id);
			$this->db->update('user_menu');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Menu telah diubah.
			</div>');
			redirect('menu');
		}
	}

	public function deletemenu($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('user_menu');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Menu telah dihapus!
			</div>');
		redirect('menu');
	}
}
