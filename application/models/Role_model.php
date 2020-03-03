<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

	public function getRole()
	{
		$query = "SELECT `user`.*, `role`.`role`
				  FROM `user` JOIN `role`
				  ON `user`.`role_id` = `role`.`id`
		";

		return $this->db->query($query)->result_array();
	}
}
