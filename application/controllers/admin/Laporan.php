<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * @property CI_Session $session
 * @property Pesanan_model $pesanan_model
 */

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Upss </strong>Anda tidak memiliki akses, silahkan login kembali!</div>');
            redirect('login');
        }
        $this->load->model('katalog_model');
        $this->load->model('pesanan_model');
    }

    public function index()
    {
        $data = array(
            'title' => 'JeWePe Wedding Organizer',
            'page' => 'admin/laporan',
            'getAllLaporan' => $this->pesanan_model->get_all_laporan()->result()
        );

        $this->load->view('admin/template/main', $data);
    }

    public function exportToExcel()
    {
        // Ambil data pesanan
        $getAllLaporan = $this->pesanan_model->get_all_laporan()->result_array();

        // Load Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set Header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Gambar');
        $sheet->setCellValue('C1', 'Nama Katalog');
        $sheet->setCellValue('D1', 'Harga');
        $sheet->setCellValue('E1', 'Jumlah Pesanan');
        $sheet->setCellValue('F1', 'Status Pesanan');

        // Set Data
        $rowCount = 2;
        $no = 1;
        foreach ($getAllLaporan as $row) {
            $sheet->setCellValue('A' . $rowCount, $no++);
            $sheet->setCellValue('B' . $rowCount, $row['gambar']);
            $sheet->setCellValue('C' . $rowCount, $row['judul_katalog']);
            $sheet->setCellValue('D' . $rowCount, $row['harga']);
            $sheet->setCellValue('E' . $rowCount, $row['jumlah_pesanan']);
            $sheet->setCellValue('F' . $rowCount, $row['status_pesanan']);
            $rowCount++;
        }

        // Simpan file ke output
        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Pesanan_' . date('YmdHis') . '.xlsx';

        // Set headers
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Save Excel 2007 file
        $writer->save('php://output');
        exit();
    }
}
