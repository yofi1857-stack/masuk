<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Url_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function save_link($short_url, $original_url)
  {
    $data = array(
      'short_url'    => $short_url,
      'original_url' => $original_url
    );
    return $this->db->insert('links', $data);
  }

  public function get_original_url($short_url)
  {
    $query = $this->db->get_where('links', array('short_url' => $short_url));
    if ($query->num_rows() > 0) {
      return $query->row()->original_url;
    }
    return false;
  }

  public function check_alias_exists($alias)
  {
    $query = $this->db->get_where('links', array('short_url' => $alias));
    return $query->num_rows() > 0;
  }
}
