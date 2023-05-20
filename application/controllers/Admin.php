<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Admin extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
        
        $status = $this->session->userdata('role');
        if ($status != "admin") {
            redirect('login');
        }
        
    }
    

public function index()
{
   
   $this->load->view('admin/_partials/header');
   $this->load->view('admin/_partials/sidebar');
    $this->load->view('admin/_partials/topbar');
    $this->load->view('admin/admin_home');
    $this->load->view('admin/_partials/footer');
   
}

public function karyawan()
{
    $this->load->model('M_karyawan');
    $data['dataKaryawan'] = $this->M_karyawan->getKaryawan()->result();
    $this->load->view('admin/_partials/header');
    $this->load->view('admin/_partials/sidebar');
    $this->load->view('admin/_partials/topbar');
    $this->load->view('admin/data_karyawan',$data);
    $this->load->view('admin/_partials/footer');
}

public function addKaryawan()
{
    $this->load->view('admin/_partials/header');
    $this->load->view('admin/_partials/sidebar');
    $this->load->view('admin/_partials/topbar');
    $this->load->view('admin/add_karyawan');
    $this->load->view('admin/_partials/footer');

}

public function simpanPekerjaan()
{
    date_default_timezone_set('Asia/Jakarta');
    $id_kerja = uniqid();
    $target = $this->input->post('target');
    $paket_pekerjaan = $this->input->post('paket_pekerjaan');
    $jumlah = $this->input->post('jumlah');
    $pekerja = $this->input->post('pekerja');
    $status = $this->input->post('status');
    $data = array(
        'id_kerja' => $id_kerja,
        'waktu' => date('H:i:s'),
        'target' => $target,
        'paket_pekerjaan' => $paket_pekerjaan,
        'jumlah' => $jumlah,
        'pekerja' => $pekerja,
        'status' => $status
    );
    $this->M_admin->simpanPekerjaan($data, 'pekerjaan');
    $this->session->set_flashdata('pesan', '');
    redirect('preorder');
}


public function editKaryawan($id)
{
    $this->load->model('M_karyawan');
    $data['dataKaryawan'] = $this->M_karyawan->getKaryawanById($id)->row();
    $this->load->view('admin/_partials/header');
    $this->load->view('admin/_partials/sidebar');
    $this->load->view('admin/_partials/topbar');
    $this->load->view('admin/edit_karyawan',$data);
    $this->load->view('admin/_partials/footer');

}

public function editKaryawanAction()
{
    $this->load->model('M_karyawan');
    $this->M_karyawan->editKaryawan();
    redirect('admin/karyawan');

}

public function deleteKaryawan($id)
{
    $this->load->model('M_karyawan');
    $this->M_karyawan->deleteKaryawan($id);
    redirect('admin/karyawan');
}

public function addPekerjaan()
{

    $this->load->view('admin/_partials/header');
    $this->load->view('admin/_partials/sidebar');
    $this->load->view('admin/_partials/topbar');
    $this->load->view('admin/add_pekerjaan');
    $this->load->view('admin/_partials/footer');
}



}
        
    /* End of file  Admin.php */
        
                            