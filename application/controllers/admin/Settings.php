<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property Settings_model $settings_model
 * @property CI_Input $input
 * @property CI_Upload $upload
 */

class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Upss </strong>Anda tidak memiliki akses, silahkan login kembali!</div>');
            redirect('login');
        }
        $this->load->model('settings_model');
    }

    public function index()
    {

        $data = array(
            'title' => 'JeWePe Wedding Organizer',
            'page' => 'admin/settings',
            'settings' => $this->settings_model->getSettings('1')->row()
        );

        $this->load->view('admin/template/main', $data);
    }

    public function updateData()
    {
        $post = $this->input->post();

        // var_dump($post);
        // die;

        if ($post) {
            $cek_id = $this->settings_model->getSettings($post['id'])->num_rows();

            if ($cek_id > 0) {
                $getSettings = $this->settings_model->getSettings($post['id'])->row();
                $fileName = date('Ymd') . '_' . rand();

                $datetime = date("Y-m-d H:i:s");
                $data = array(
                    'nama_website' => $post['nama_website'],
                    'nomor_telepon' => $post['nomor_telepon'],
                    'email' => $post['email'],
                    'alamat' => $post['alamat'],
                    'maps' => $post['maps'],
                    'facebook_url' => $post['facebook_url'],
                    'youtube_url' => $post['youtube_url'],
                    'instagram_url' => $post['instagram_url'],
                    'header_business_hour' => $post['header_business_hour'],
                    'time_business_hour' => $post['time_business_hour'],
                    'updated_at' => $datetime,
                );

                if (!empty($_FILES['logo']['name'])) {
                    //delete file
                    if (file_exists('./assets/files/profil/' . $getSettings->logo) && $getSettings->logo)
                        unlink('./assets/files/profil/' . $getSettings->logo);

                    $upload = $this->_do_upload($fileName);
                    $data['logo'] = $upload;
                }

                $update = $this->settings_model->update($post['id'], $data);

                if ($update) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success </strong>data berhasil di-update! <i class="remove ti-close" data-dismiss="alert"></i></div>');
                    redirect('admin/Settings');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>UPSS! </strong>data gagal di-update <i class="remove ti-close" data-dismiss="alert"></i></div>');
                    redirect('admin/Settings');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>UPSS! </strong>maaf id tidak ditemukan. <i class="remove ti-close" data-dismiss="alert"></i></div>');
                redirect('admin/Settings');
            }
        } else {
            redirect('admin/Settings');
        }
    }

    private function _do_upload($fileName)
	{
		$config['file_name'] 		= $fileName;
		$config['upload_path']  	= './assets/files/profil';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png|PNG|JPG|JPEG';
		$config['max_size']			= 5000; //set max siz allowed in Kilobyte
		$config['create_thumb']		= FALSE;
		$config['quality']			= '90%';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('logo')) //upload and validate
		{
			$data['inputerror'][] = 'logo';
			$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}
}
