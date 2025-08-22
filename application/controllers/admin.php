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

class Admin extends CI_Controller
{
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
}
