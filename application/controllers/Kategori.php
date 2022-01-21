<?php class Kategori extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
        $this->load->model('Kategori_model','kategori');
    }

	public function index()
	{
		$this->template->load('template/index', 'kategori/index');
	}

	public function kategori_list()
	{
		$list = $this->kategori->get_datatables();
        $data = array();
        $no = $_POST['start'];
		// $button = '<button class="btn btn-warning btn-sm">Edit</button>';
        foreach ($list as $kategori) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $kategori->nama_kategori;
			$row[] = '<a href="javascript:void(0)" onclick="edit('.$kategori->id.')" class="btn btn-sm btn-warning">Edit</a>';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->kategori->count_all(),
                        "recordsFiltered" => $this->kategori->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
	}

	public function fetchdatabyid()
	{
		$id = $this->input->post('id');
		$data = $this->kategori->get_by_id($id)->row();
		echo json_encode($data);
	}

	public function post()
	{
		$id = $this->input->post('id_kategori');
		// print_r($id);exit;
		$nama_kategori = $this->input->post('kat_produk');
		if (empty($id)) {
			$data = array(
				'nama_kategori' => $nama_kategori
			);
			$this->db->insert('kategori', $data);
		} else {
			// edit
			$data = array(
				'nama_kategori' => $nama_kategori
			);
			$this->db->where('id', $id);
			$this->db->update('kategori', $data);
		}
		redirect('kategori');
	}
}
?>
