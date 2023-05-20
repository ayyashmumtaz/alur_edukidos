<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Home extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_home');
        
       
        
    }
    

public function index()
{
        $data['pekerjaan'] = $this->M_home->getKerja();
        $data['dataOrderan'] = $this->M_home->getKaryawan();
        $this->load->view('admin/_partials/header');
         $this->load->view('admin/index', $data);
         $this->load->view('admin/_partials/footer');
    
}

public function getDataPekerjaan() {
    // Panggil model untuk mengambil data dari database
    $data = $this->M_home->getDataPekerjaan();

    // Format data ke dalam format yang diterima DataTable
    // Return data dalam format JSON
    echo json_encode($data);
}

public function getPekerjaanTable()

{

    $data = $this->M_home->getDataPekerjaan();

    $output = array(
        'draw' => intval($this->input->get('draw')),
        'recordsTotal' => count($data),
        'recordsFiltered' => count($data),
        'data' => $data
    );

    // Return data dalam format JSON
    echo json_encode($output);
}

public function kerjakan()
    {
    $id = $this->input->post('id');
    // $status = 'proses';
    $status = array('status' => 'proses');

    $this->db->where('id_kerja', $id);
    $this->db->update('pekerjaan', $status);

    // Mengirim respons kembali ke permintaan Ajax
    $response = array('status' => 'success', 'message' => 'Data berhasil diperbarui, Segera kerjakan!');
    echo json_encode($response);
    }



        
}
        
    /* End of file  Home.php */
        
                            