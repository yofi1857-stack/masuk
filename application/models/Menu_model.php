<?php
defined('BASEPATH') or exit('NOdirect script access allowed');
class Menu_model extends CI_Model
{
  public function getSubMenu()
  {
    $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
              FROM `user_sub_menu` JOIN `user_menu`
              ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
              WHERE `user_sub_menu`.`is_active` = 1";
    return $this->db->query($query)->result_array();
  }

  public function getMenu()
  {
    $query = "SELECT * FROM `user_menu`";
    $this->db->query($query);
    return $this->db->result_array();
  }




  //   public function addMenu($data)
  //   {
  //     $this->db->insert('user_menu', $data);
  //   }

  //   public function deleteMenu($id)
  //   {
  //     $this->db->delete('user_menu', ['id' => $id]);
  //   }

  //   public function updateMenu($id, $data)
  //   {
  //     $this->db->where('id', $id);
  //     $this->db->update('user_menu', $data);
  // }
}
