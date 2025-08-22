<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Auth
 * @property CI_Form_validation $form_validation
 * @property CI_Session $session
 * // Tambahkan juga properti CodeIgniter umum lainnya yang sering Anda gunakan untuk autocompletion yang lebih baik
 * @property CI_Input $input
 * @property CI_DB_query_builder $db
 * @property CI_URI $uri
 */

class Menu extends CI_Controller
{
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
      // log_message('debug', 'Form validation passed. Attempting to insert menu: ' . $this->input->post('menu'));
      $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
      redirect('menu');
    }
  }
  public function submenu()
  {
    $data['title'] = 'Submenu Management';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('Menu_model', 'menu');
    $data['submenu'] = $this->menu->getSubMenu();
    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('menu_id', 'Menu', 'required');
    $this->form_validation->set_rules('url', 'URL', 'required');
    $this->form_validation->set_rules('icon', 'icon', 'required');
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
        'is_active' => $this->input->post('is_active')
      ];
      $this->db->insert('user_sub_menu', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New submenu added!</div>');
      redirect('menu/submenu');
    }
  }
  public function editmenu($id)
  {
    $data['title'] = 'Edit Menu';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['menu'] = $this->db->get_where('user_menu', ['id' => $id])->row_array();

    $this->form_validation->set_rules('menu', 'Menu', 'required');
    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('menu/editmenu', $data);
      $this->load->view('templates/footer');
    } else {
      // log_message('debug', 'Form validation passed. Attempting to update menu: ' . $this->input->post('menu'));
      $this->db->set('menu', $this->input->post('menu'));
      $this->db->where('id', $id);
      $this->db->update('user_menu');
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu updated!</div>');
      redirect('menu');
    }
  }
  public function deleteMenu($id)
  {
    $this->db->delete('user_menu', ['id' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu deleted!</div>');
    redirect('menu');
  }

  // public function addMenu()
  // {
  //   $this->form_validation->set_rules('menu', 'Menu', 'required|trim');

  //     $this->index();
  //   } else {
  //     $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
  //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
  //     redirect('menu');
  //   }
  // }

}
