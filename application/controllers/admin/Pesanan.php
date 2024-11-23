<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property Pesanan_model $pesanan_model
 * @property CI_Input $input
 */

class Pesanan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('username'))) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role-"alert"><strong>Upss </strong>Anda tidak memiliki Akses, silahkan login!</div>');
			redirect('login');
		}
		$this->load->model('pesanan_model');
	}

	public function index()
	{

		$data = array(
			'title' => 'JeWePe Wedding Organizer',
			'page' => 'admin/pesanan',
			'getAllPesanan' => $this->pesanan_model->get_all_pesanan()->result()
		);

		$this->load->view('admin/template/main', $data);
	}

	public function updateStatus()
	{

		if ($this->input->get()) {
			$get = $this->input->get();
			$cek_data = $this->pesanan_model->get_pesanan_by_id($get['id'])->num_rows();

			if ($cek_data > 0) {

				$datetime = date("Y-m-d H:i:s");
				$data = array(
					'status_pesanan' => $get['status_pesanan'],
					'id_user' => $this->session->userdata('id_user'),
					'updated_at' => $datetime,
				);

				$update = $this->pesanan_model->update($get['id'], $data);

				if ($update) {
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success </strong>Status berhasil diubah!</div>');
					redirect('admin/Pesanan');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Success </strong>Status gagal diubah!</div>');
					redirect('admin/Pesanan');
				}
			} else {
				redirect('admin/Pesanan');
			}
		} else {
			redirect('admin/Pesanan');
		}
	}
}
