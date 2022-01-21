<?php class Produk extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
        $this->load->model('Produk_model','produk');
    }

	public function index()
	{
		$kategori = $this->db->get('kategori')->result();
		$data = [
			'kategori' => $kategori,
		];
		$this->template->load('template/index', 'produk/index', $data);
	}

	public function post()
	{
		$id = $this->input->post('id');
		$kat_produk = $this->input->post('kat_produk');
		$nama_produk = ucwords($this->input->post('nama_produk'));
		$deskripsi = $this->input->post('deskripsi');
		$harga_produk = $this->input->post('harga_produk');
		$config = array(
			array(
				'field' => 'nama_produk',
				'label' => 'Nama produk',
				'rules' => 'is_unique[produk.nama_produk] | required', 
				'errors' => array (
					'is_unique' => '%s sudah terdaftar sebelumnya.',
					'required' => '%s tidak boleh kosong.',
                ),
			),
			array(
				'field' => 'kat_produk',
				'label' => 'Kategori produk',
				'rules' => 'required', 
				'errors' => array (
					'required' => '%s tidak boleh kosong.',
                ),
			),
			array(
				'field' => 'deskripsi',
				'label' => 'Deskripsi produk',
				'rules' => 'required', 
				'errors' => array (
					'required' => '%s tidak boleh kosong.',
                ),
			),
			array(
				'field' => 'harga_produk',
				'label' => 'Harga produk',
				'rules' => 'required', 
				'errors' => array (
					'required' => '%s tidak boleh kosong.',
                ),
			),
		);
		
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			// gagal
			$this->index();
		}
		else
		{
			// sukses
			if ($id) {
				// update
				$data = [
					'detail_kategori' => $kat_produk,
					'nama_produk' => $nama_produk,
					'deskripsi_produk' => $deskripsi,
					'harga_produk' => $harga_produk,
				];
				$this->db->where('id', $id);
				$this->db->update('produk', $data);
			} else {
				// insert
				$data = [
					'detail_kategori' => $kat_produk,
					'nama_produk' => $nama_produk,
					'deskripsi_produk' => $deskripsi,
					'harga_produk' => $harga_produk,
				];
				$this->db->insert('produk', $data);
			}
			$this->session->set_flashdata('success','<div class="alert alert-success">Data berhasil disimpan.</div>');
			redirect('produk');
		}

		// if ($id) {
		// 	// update
		// 	$data = [
		// 		'detail_kategori' => $kat_produk,
		// 		'nama_produk' => $nama_produk,
		// 		'deskripsi_produk' => $deskripsi,
		// 		'harga_produk' => $harga_produk,
		// 	];
		// 	$this->db->where('id', $id);
		// 	$this->db->update('produk', $data);
		// } else {
		// 	// insert
		// 	$data = [
		// 		'detail_kategori' => $kat_produk,
		// 		'nama_produk' => $nama_produk,
		// 		'deskripsi_produk' => $deskripsi,
		// 		'harga_produk' => $harga_produk,
		// 	];
		// 	$this->db->insert('produk', $data);
		// }
		// redirect('produk');
	}

	public function produk_list()
	{
		$list = $this->produk->get_datatables();
        $data = array();
        $no = $_POST['start'];
		// $button = '<button class="btn btn-warning btn-sm">Edit</button>';
        foreach ($list as $produk) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $produk->nama_produk;
            $row[] = $produk->nama_kategori;
            $row[] = $produk->deskripsi_produk;
            $row[] = format_rp($produk->harga_produk);
			$row[] = '<a href="javascript:void(0)" class="btn btn-sm btn-warning" onclick="edit('.$produk->id.')">Edit</a>';
            $data[] = $row;
        }
 
        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->produk->count_all(),
			"recordsFiltered" => $this->produk->count_filtered(),
			"data" => $data,
		);
        echo json_encode($output);
	}

	public function fetchdatabyid()
	{
		$id = $this->input->post('id');
		$data = $this->produk->get_by_id($id)->row();
		echo json_encode($data);
	}

	public function daftar_produk()
	{
		$this->template->load('template/index', 'produk/daftar_produk');
	}
}
?>
