<?php 
	class Login extends CI_Controller
	{

		public function __construct() {
			parent::__construct();	
			$this->load->model('Login_model');
		}

		public function index()
		{
			$this->load->view('layout/login');
		}

		public function doLogin()
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$where = array (
				'username' => $username,
				// 'password' => password_hash($password, PASSWORD_DEFAULT),
			);
			$cek = $this->Login_model->checkLogin("user", $where);
			// cek
			if ($cek->num_rows() > 0) {
				$cek1 = $cek->row();
				// print_r($cek1);exit;
				if (password_verify($password, $cek1->password)) {
					$data_session = array(
						'status' => 'login'
					);
					foreach ($cek->result() as $value) {
						$data_sess = array(
							'user_id' => $value->id,
							'username' => $value->username,
							'created_at' => $value->created_at
						);
						$this->session->set_userdata($data_sess);
					}
					// print_r($data_sess);exit;
					$this->session->set_userdata($data_session);
	
					// atur role disini kalo dipake
					// $role = $this->session->set_userdata('role');
					redirect(base_url('dashboard'));
				} else {
					# code...
					$this->session->set_flashdata('notif', '<div class="alert alert-danger">Password salah.</div>');
					$this->load->view('layout/login');
				}
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Username salah.</div>');
				$this->load->view('layout/login');
			}
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect(base_url('login'));
		}
	}
?>
