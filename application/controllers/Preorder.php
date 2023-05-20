<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Preorder extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_preorder');
        
    }
    

public function index()
{
    $data['dataPaket'] = $this->M_preorder->getPekerjaan()->result();
    $this->load->view('admin/_partials/header');
    $this->load->view('admin/_partials/sidebar');
    $this->load->view('admin/_partials/topbar');
    $this->load->view('admin/preorder');
    $this->load->view('admin/_partials/footer');
}

public function selesai()
{
    $this->load->view('admin/_partials/header');
    $this->load->view('admin/_partials/sidebar');
    $this->load->view('admin/_partials/topbar');
    $this->load->view('admin/preorder_selesai');
    $this->load->view('admin/_partials/footer');    
}

public function masalah()
{
    $this->load->view('admin/_partials/header');
    $this->load->view('admin/_partials/sidebar');
    $this->load->view('admin/_partials/topbar');
    $this->load->view('admin/preorder_masalah');
    $this->load->view('admin/_partials/footer');    
}
        
}
        
    /* End of file Preorder.php */
        
                            