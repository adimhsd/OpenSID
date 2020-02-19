<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Data_persil extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('header_model');
		$this->load->model('config_model');
		$this->load->model('data_persil_model');
		$this->load->model('penduduk_model');
		$this->controller = 'data_persil';
		$this->modul_ini = 7;
	}

	public function clear()
	{
		unset($_SESSION['cari']);
		$_SESSION['per_page'] = 20;
		redirect('data_persil');
	}

	public function index($kat=0, $mana=0, $page=1, $o=0)
	{
		$header = $this->header_model->get_data();
		$data['kat'] = $kat;
		$data['mana'] = $mana;
		$header['minsidebar'] = 1;

		$this->load->view('header', $header);

		if (isset($_SESSION['cari']))
			$data['cari'] = $_SESSION['cari'];
		else $data['cari'] = '';

		if (isset($_POST['per_page']))
			$_SESSION['per_page']=$_POST['per_page'];
		$data['per_page'] = $_SESSION['per_page'];

		$data["desa"] = $this->config_model->get_data();
		$data['paging']  = $this->data_persil_model->paging_c_desa($kat, $mana, $page);
		$data["persil"] = $this->data_persil_model->list_c_desa($kat, $mana, $data['paging']->offset, $data['paging']->per_page);
		$data["persil_peruntukan"] = $this->data_persil_model->list_persil_peruntukan();
		$data["persil_jenis"] = $this->data_persil_model->list_persil_jenis();
		$data["persil_kelas"] = $this->data_persil_model->list_persil_kelas();
		$data['keyword'] = $this->data_persil_model->autocomplete();
		$nav['act'] = 7;
		$this->load->view('nav', $nav);
		$this->load->view('data_persil/c_desa', $data);
		$this->load->view('footer');
	}

	public function persil($kat=0, $mana=0, $page=1, $o=0)
	{
		$header = $this->header_model->get_data();
		$data['kat'] = $kat;
		$data['mana'] = $mana;
		$header['minsidebar'] = 1;

		$this->load->view('header', $header);

		if (isset($_SESSION['cari']))
			$data['cari'] = $_SESSION['cari'];
		else $data['cari'] = '';

		if (isset($_POST['per_page']))
			$_SESSION['per_page']=$_POST['per_page'];
		$data['per_page'] = $_SESSION['per_page'];

		$data["desa"] = $this->config_model->get_data();
		$data['paging']  = $this->data_persil_model->paging($kat, $mana, $page);
		$data["persil"] = $this->data_persil_model->list_persil($kat, $mana, $data['paging']->offset, $data['paging']->per_page);
		$data["persil_peruntukan"] = $this->data_persil_model->list_persil_peruntukan();
		$data["persil_jenis"] = $this->data_persil_model->list_persil_jenis();
		$data["persil_kelas"] = $this->data_persil_model->list_persil_kelas();
		$data['keyword'] = $this->data_persil_model->autocomplete();
		$nav['act'] = 7;
		$data["title"] = $kat." ".$data["persil_$kat"][$mana][0];
		$this->load->view('nav', $nav);
		$this->load->view('data_persil/persil', $data);
		$this->load->view('footer');
	}

	public function import()
	{
		$data['form_action'] = site_url("data_persil/import_proses");
		$this->load->view('data_persil/import', $data);
	}

	public function search(){
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari']=$cari;
		else unset($_SESSION['cari']);
		redirect('data_persil');
	}

	public function detail($id=0)
	{
		$header = $this->header_model->get_data();
		$header['minsidebar'] = 1;
		$this->load->view('header', $header);

		$data["c_desa_detail"] = $this->data_persil_model->get_c_desa($id);
		$data["persil_detail"] = $this->data_persil_model->list_detail_c_desa($id);
		$data["persil_lokasi"] = $this->data_persil_model->list_dusunrwrt();
		$data["persil_peruntukan"] = $this->data_persil_model->list_persil_peruntukan();
		$data["persil_jenis"] = $this->data_persil_model->list_persil_jenis();
		$data["persil_kelas"] = $this->data_persil_model->list_persil_kelas($data["persil_detail"]["persil_jenis_id"]);
		$nav['act'] = 7;
		$this->load->view('nav',$nav);
		$this->load->view('data_persil/detail', $data);
		$this->load->view('footer');
	}

		public function detail_persil($id=0)
	{
		$header = $this->header_model->get_data();
		$header['minsidebar'] = 1;
		$this->load->view('header', $header);

		$data["persil_detail"] = $this->data_persil_model->get_persil($id);
		$data["persil_lokasi"] = $this->data_persil_model->list_dusunrwrt();
		$data["persil_peruntukan"] = $this->data_persil_model->list_persil_peruntukan();
		$data["persil_jenis"] = $this->data_persil_model->list_persil_jenis();
		$data["persil_kelas"] = $this->data_persil_model->list_persil_kelas($data["persil_detail"]["persil_jenis_id"]);
		$nav['act'] = 7;
		$this->load->view('nav',$nav);
		$this->load->view('data_persil/detail_persil', $data);
		$this->load->view('footer');
	}

	public function create($mode=0, $id=0)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama Jenis Persil', 'required');

		$header = $this->header_model->get_data();
		$header['minsidebar'] = 1;
		$this->load->view('header', $header);

		$data["mode"] = $mode;
		$data["penduduk"] = $this->data_persil_model->list_penduduk();
		if ($mode === 'edit')
		{ 
			$data["persil_detail"] = $this->data_persil_model->get_persil($id);
		}
		elseif ($mode === 'add')
		{
			$data["persil_detail"] = $this->data_persil_model->get_c_desa($id);
		}
		if ($id > 0)
		{
			$data['pemilik'] = $this->data_persil_model->get_penduduk($data["persil_detail"]["id_pend"]);
			$data['pemilik']['nik_lama'] = $data['pemilik']['nik'];
		}
		else
		{
			$data['pemilik'] = false;
		}
		if (isset($_POST['nik']))
		{
			$data['pemilik'] = $this->data_persil_model->get_penduduk($_POST['nik'], $nik=true);
		}
		$data["persil_lokasi"] = $this->data_persil_model->list_dusunrwrt();
		$data["persil_peruntukan"] = $this->data_persil_model->list_persil_peruntukan();
		$data["persil_jenis"] = $this->data_persil_model->list_persil_jenis();
		$data["persil_kelas"] = $this->data_persil_model->list_persil_kelas($data["persil_detail"]["persil_jenis_id"]);
		$nav['act'] = 7;
		$this->load->view('nav', $nav);
		$this->load->view('data_persil/create', $data);
		$this->load->view('footer');
	}

	public function create_ext($mode=0, $id=0)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama Jenis Persil', 'required');

		$header = $this->header_model->get_data();
		$header['minsidebar'] = 1;
		$this->load->view('header', $header);

		$data["mode"] = $mode;
		if ($mode === 'edit')
		{ 
			$data["persil_detail"] = $this->data_persil_model->get_persil($id);
		}
		elseif ($mode === 'add')
		{
			$data["persil_detail"] = $this->data_persil_model->get_c_desa($id);
		}	

		$data["persil_lokasi"] = $this->data_persil_model->list_dusunrwrt();
		$data["persil_peruntukan"] = $this->data_persil_model->list_persil_peruntukan();
		$data["persil_jenis"] = $this->data_persil_model->list_persil_jenis();
		$data["persil_kelas"] = $this->data_persil_model->list_persil_kelas($data["persil_detail"]["persil_jenis_id"]);
		$nav['act'] = 7;
		$this->load->view('nav', $nav);
		$this->load->view('data_persil/create_ext', $data);
		$this->load->view('footer');
	}

	public function simpan_persil($page=1)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama Jenis Persil', 'required');

		$header = $this->header_model->get_data();
		$header['minsidebar'] = 1;
		$this->load->view('header', $header);

		$data["hasil"] = $this->data_persil_model->simpan_persil();
		redirect("data_persil/clear");
	}

	public function persil_jenis($id=0)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama Jenis Persil', 'required');
		$header = $this->header_model->get_data();
		$header['minsidebar'] = 1;
		$this->load->view('header', $header);
		$nav['act'] = 7;
		$this->load->view('nav', $nav);
		$data["id"] = $id;
		if ($this->form_validation->run() === FALSE)
		{
			$data["persil_peruntukan"] = $this->data_persil_model->list_persil_peruntukan();
			$data["persil_jenis"] = $this->data_persil_model->list_persil_jenis();
			$data["persil_kelas"] = $this->data_persil_model->list_persil_kelas();
			$data["persil_jenis_detail"] = $this->data_persil_model->get_persil_jenis($id);
			$data["hasil"] = false;
			$this->load->view('data_persil/persil_jenis', $data);
		}
		else
		{
			$data["hasil"] = $this->data_persil_model->update_persil_jenis($id);
			$data["persil_peruntukan"] = $this->data_persil_model->list_persil_peruntukan();
			$data["persil_jenis"] = $this->data_persil_model->list_persil_jenis();
			$data["persil_kelas"] = $this->data_persil_model->list_persil_kelas();
			$data["persil_jenis_detail"] = $this->data_persil_model->get_persil_jenis($id);
			$this->load->view('data_persil/persil_jenis', $data);
		}
		$this->load->view('footer');
	}

	public function hapus_persil_jenis($id){
		$this->redirect_hak_akses('h', "data_persil/persil_jenis");
		$this->data_persil_model->hapus_jenis($id);
		redirect("data_persil/persil_jenis");
	}

		public function persil_kelas($id=0)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama Jenis Persil', 'required');
		$header = $this->header_model->get_data();
		$header['minsidebar'] = 1;
		$this->load->view('header', $header);
		$nav['act'] = 7;
		$this->load->view('nav', $nav);
		$data["id"] = $id;
		if ($this->form_validation->run() === FALSE)
		{
			$data["persil_peruntukan"] = $this->data_persil_model->list_persil_peruntukan();
			$data["persil_jenis"] = $this->data_persil_model->list_persil_jenis();
			$data["persil_kelas"] = $this->data_persil_model->list_persil_kelas();
			$data["persil_kelas_detail"] = $this->data_persil_model->get_persil_kelas($id);
			$data["hasil"] = false;
			$this->load->view('data_persil/persil_kelas', $data);
		}
		else
		{
			$data["hasil"] = $this->data_persil_model->update_persil_kelas($id);
			$data["persil_peruntukan"] = $this->data_persil_model->list_persil_peruntukan();
			$data["persil_jenis"] = $this->data_persil_model->list_persil_jenis();
			$data["persil_kelas"] = $this->data_persil_model->list_persil_kelas();
			$data["persil_kelas_detail"] = $this->data_persil_model->get_persil_kelas($id);
			$this->load->view('data_persil/persil_kelas', $data);
		}
		$this->load->view('footer');
	}

	public function hapus_persil_kelas($id){
		$this->redirect_hak_akses('h', "data_persil/persil_kelas");
		$this->data_persil_model->hapus_kelas($id);
		redirect("data_persil/persil_kelas");
	}

	public function persil_peruntukan($id=0)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama Jenis Persil', 'required');
		$header = $this->header_model->get_data();
		$header['minsidebar'] = 1;
		$this->load->view('header', $header);
		$nav['act'] = 7;
		$this->load->view('nav', $nav);
		$data["id"] = $id;
		if ($this->form_validation->run() === FALSE)
		{
			$data["persil_peruntukan"] = $this->data_persil_model->list_persil_peruntukan();
			$data["persil_jenis"] = $this->data_persil_model->list_persil_jenis();
			$data["persil_peruntukan_detail"] = $this->data_persil_model->get_persil_peruntukan($id);
			$data["hasil"] = false;
			$this->load->view('data_persil/persil_peruntukan', $data);
		}
		else
		{
			$data["hasil"] = $this->data_persil_model->update_persil_peruntukan($id);
			$data["persil_peruntukan"] = $this->data_persil_model->list_persil_peruntukan();
			$data["persil_jenis"] = $this->data_persil_model->list_persil_jenis();
			$data["persil_peruntukan_detail"] = $this->data_persil_model->get_persil_peruntukan($id);
			$this->load->view('data_persil/persil_peruntukan', $data);
		}
		$this->load->view('footer');
	}

	public function panduan()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$header = $this->header_model->get_data();
		$header['minsidebar'] = 1;
		$this->load->view('header', $header);
		$nav['act'] = 7;
		$this->load->view('nav', $nav);
		$this->load->view('data_persil/panduan');
		$this->load->view('footer');
	}

	public function hapus_persil_peruntukan($id)
	{
		$this->redirect_hak_akses('h', "data_persil/persil_peruntukan");
		$this->data_persil_model->hapus_peruntukan($id);
		redirect("data_persil/persil_peruntukan");
	}

	public function hapus($id)
	{
		$this->redirect_hak_akses('h', "data_persil");
		$this->data_persil_model->hapus_c_desa($id);
		redirect("data_persil");
	}

		public function hapus_persil($id)
	{
		$this->redirect_hak_akses('h', "data_persil");
		$this->data_persil_model->hapus_persil($id);
		redirect("data_persil/persil");
	}

	public function import_proses()
	{
		$this->data_persil_model->impor_persil();
		redirect("data_persil");
	}

	public function cetak_persil($o=0)
	{
		$data['data_persil'] = $this->data_persil_model->list_persil('', $o, 0, 10000);
		$this->load->view('data_persil/persil_print', $data);
	}

	public function cetak($o=0)
	{
		$data['data_persil'] = $this->data_persil_model->list_c_desa('', $o, 0, 10000);
		$data["persil_jenis"] = $this->data_persil_model->list_persil_jenis();
		$this->load->view('data_persil/c_desa_print', $data);
	}

	public function form_c_desa($id=0)
	{
		$header = $this->header_model->get_data();
		$data['desa'] = $header['desa'];
		$data["persil_detail"] = $this->data_persil_model->get_c_desa($id);
		$data["persil_lokasi"] = $this->data_persil_model->list_dusunrwrt();
		$data["persil_peruntukan"] = $this->data_persil_model->list_persil_peruntukan();
		$data["persil_jenis"] = $this->data_persil_model->list_persil_jenis();
		foreach ($data["persil_jenis"] as $key => $item) {
			$data[$item[0]] = $this->data_persil_model->get_c_cetak($id, $key);
		}
		$data["persil_kelas"] = $this->data_persil_model->list_persil_kelas($data["persil_detail"]["persil_jenis_id"]);
		$this->load->view('data_persil/c_desa_form_print', $data);
	}

	public function excel($mode="", $o=0)
	{
		$data['mode'] = $mode;
		if($mode == 'persil')
			$data['data_persil'] = $this->data_persil_model->list_persil('', $o, 0, 10000);
		else
			$data['data_persil'] = $this->data_persil_model->list_c_desa('', $o, 0, 10000);
			$data["persil_jenis"] = $this->data_persil_model->list_persil_jenis();
		$this->load->view('data_persil/persil_excel', $data);
	}

	public function kelasid()
	{
		$data =[];
		$id = $this->input->post('id');
		$kelas = $this->data_persil_model->list_persil_kelas($id);
		foreach ($kelas as $key => $id) {
			$data[] = array('id' => $key, 'kode' => $id[0]);
		}
		echo json_encode($data);
	}

}

?>
