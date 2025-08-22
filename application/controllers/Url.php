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

class Url extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
    $this->load->model('Url_model');
  }

  public function index()
  {
    $data['shortened_url'] = '';
    $this->load->view('url_form', $data);
  }

  public function shorten()
  {
    $this->load->library('form_validation');

    // Aturan validasi
    $this->form_validation->set_rules('original_url', 'URL asli', 'required|valid_url');
    $this->form_validation->set_rules('custom_alias', 'Alias kustom', 'trim|alpha_dash|max_length[20]');

    if ($this->form_validation->run() === FALSE) {
      $data['shortened_url'] = '';
      $this->load->view('url_form', $data);
    } else {
      $original_url = $this->input->post('original_url');
      $custom_alias = $this->input->post('custom_alias');

      if (!empty($custom_alias)) {
        // Jika alias kustom sudah ada, kirim pesan error
        if ($this->Url_model->check_alias_exists($custom_alias)) {
          $data['error'] = 'Alias ini sudah digunakan. Mohon pilih yang lain.';
          $this->load->view('url_form', $data);
          return;
        }
        $shortId = $custom_alias;
      } else {
        // Buat ID acak jika tidak ada alias kustom
        do {
          $shortId = substr(md5(uniqid(rand(), true)), 0, 7);
        } while ($this->Url_model->check_alias_exists($shortId));
      }

      // Simpan ke database
      if ($this->Url_model->save_link($shortId, $original_url)) {
        $data['shortened_url'] = base_url($shortId);
        $this->load->view('url_form', $data);
      } else {
        $data['error'] = 'Gagal memendekkan URL. Silakan coba lagi.';
        $this->load->view('url_form', $data);
      }
    }
  }

  public function redirect_url($short_url)
  {
    $original_url = $this->Url_model->get_original_url($short_url);
    if ($original_url) {
      redirect($original_url, 'refresh');
    } else {
      show_404();
    }
  }
}
