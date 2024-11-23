<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property Katalog_model $katalog_model
 * @property CI_Input $input
 * @property CI_Upload $upload
 */

class Katalog extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('username'))) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role-"alert"><strong>Upss </strong>Anda tidak memiliki Akses, silahkan login!</div>');
			redirect('login');
		}
		$this->load->model('katalog_model');
	}

	public function index()
	{
		$data = array(
			'title' => 'JeWePe Wedding Organizer',
			'page' => 'admin/katalog',
			'getAllKatalog' => $this->katalog_model->get_all_katalog()->result()
		);

		$this->load->view('admin/template/main', $data);
	}

	public function add()
	{
		$data = array(
			'title' => 'JeWePe Wedding Organizer',
			'page' => 'admin/add_katalog'
		);

		$this->load->view('admin/template/main', $data);
	}

	public function edit()
	{
		if ($this->input->get('id')) {

			$cek_data = $this->katalog_model->get_katalog_by_id($this->input->get('id'))->num_rows();

			if ($cek_data > 0) {
				$data = array(
					'title' => 'JeWePe Wedding Organizer',
					'page' => 'admin/edit_katalog',
					'katalog' => $this->katalog_model->get_katalog_by_id($this->input->get('id'))->row()
				);

				$this->load->view('admin/template/main', $data);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show"
					role="alert"><strong>Success </strong>data tidak tersedia! <i class="remove ti-close" data-dismiss="alert"></i></div>');
				redirect('admin/Katalog');
			}
		} else {
			redirect('admin/Katalog');
		}
	}

	public function addData()
	{
		if ($this->input->post()) {

			$post = $this->input->post();

			// var_dump($post);
			// die;
			$datetime = date("Y-m-d H:i:s");
			$fileName = date('Ymd') . '_' . rand();

			$data = array(
				'judul_katalog' => $post['package_name'],
				'isi_katalog' => $post['description'],
				'harga' => $post['price'],
				'status' => $post['status_publish'],
				'id_user' => $this->session->userdata('id_user'),
				'created_at' => $datetime,
			);

			if (!empty($_FILES['gambar']['name'])) {
				//delete file
				if (file_exists('./assets/files/katalog/' . $_FILES['gambar']['name']) && $_FILES['gambar']['name'])
					unlink('./assets/files/katalog/' . $_FILES['gambar']['name']);

				$upload = $this->_do_upload($fileName);
				$data['gambar'] = $upload;
			}

			$insert = $this->katalog_model->insert($data);

			if ($insert) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show"
					role="alert"><strong>Success </strong>data berhasil disimpan! <i class="remove ti-close" data-dismiss="alert"></i></div>');
				redirect('admin/Katalog');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show"
					role="alert"><strong>Success </strong>data gagal disimpan! <i class="remove ti-close" data-dismiss="alert"></i></div>');
				redirect('admin/Katalog');
			}
		} else {
			redirect('admin/Katalog');
		}
	}

	public function updateData()
	{
		if ($this->input->post()) {

			$post = $this->input->post();
			$cek_data = $this->katalog_model->get_katalog_by_id($post['id'])->num_rows();

			if ($cek_data > 0) {

				$getKatalog = $this->katalog_model->get_katalog_by_id($post['id'])->row();
				$datetime = date("Y-m-d H:i:s");
				$fileName = date('Ymd') . '_' . rand();

				$data = array(
					'judul_katalog' => $post['package_name'],
					'isi_katalog' => $post['description'],
					'harga' => $post['price'],
					'status' => $post['status_publish'],
					'id_user' => $this->session->userdata('id_user'),
					'updated_at' => $datetime,
				);

				if (!empty($_FILES['gambar']['name'])) {
					//delete file
					if (file_exists('./assets/files/katalog/' . $getKatalog->gambar) && $getKatalog->gambar)
						unlink('./assets/files/katalog/' . $getKatalog->gambar);

					$upload = $this->_do_upload($fileName);
					$data['gambar'] = $upload;
				}

				$update = $this->katalog_model->update($post['id'], $data);

				if ($update) {
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show"
					role="alert"><strong>Success </strong>data berhasil disimpan! <i class="remove ti-close" data-dismiss="alert"></i></div>');
					redirect('admin/Katalog');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show"
					role="alert"><strong>Success </strong>data gagal disimpan! <i class="remove ti-close" data-dismiss="alert"></i></div>');
					redirect('admin/Katalog');
				}
			}
		} else {
			redirect('admin/Katalog');
		}
	}

	public function delete()
	{
		if (!empty($this->input->get('id', true))) {

			$Katalog = $this->katalog_model->get_katalog_by_id($this->input->get('id', true))->row();

			if (file_exists('./assets/files/katalog/' . $Katalog->gambar) && $Katalog->gambar)
				unlink('./assets/files/katalog/' . $Katalog->gambar);

			$delete = $this->katalog_model->delete_by_id($this->input->get('id', true));

			if ($delete) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show"
					role-"alert"><strong>Success </strong>data berhasil dihapus!
					<i class="remove ti-close" data-dismiss-"alert"></i></div>');
				redirect("admin/Katalog");
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show"
					role-"alert"><strong>Uppss </strong>data gagal dihapus!
					<i class="remove ti-close" data-dismiss-"alert"></i></div>');
				redirect("admin/Katalog");
				}
		} else {
			redirect('admin/Katalog');
		}
	}

	private function _do_upload($fileName)
	{
		$config['file_name'] 		= $fileName;
		$config['upload_path']  	= './assets/files/katalog';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png|PNG|JPG|JPEG';
		$config['max_size']			= 5000; //set max siz allowed in Kilobyte
		$config['create_thumb']		= FALSE;
		$config['quality']			= '90%';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('gambar')) //upload and validate
		{
			$data['inputerror'][] = 'gambar';
			$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}
}
