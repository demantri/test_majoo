<?php
	class Login_model extends CI_Model
	{
		public function checkLogin($table, $where)
		{
			return $this->db->get_where($table,$where);
		}
	}
?>
