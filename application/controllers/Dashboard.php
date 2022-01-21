<?php class Dashboard extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
    }

	public function index()
	{
		$user = $this->session->userdata('status');
		// print_r($user);exit;
		$this->template->load('template/index', 'dashboard/index');
	}
}
?>
