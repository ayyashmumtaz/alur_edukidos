<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Login extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
        
    }
    

public function index()
{
    
    $this->load->view('login/index');
    
}

public function aksi_login()
{
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $data = array(
        'username' => $username,
        'password' => $password
        );
    $hasil = $this->M_login->cek_login($data);
    if ($hasil->num_rows() == 1) {
        foreach ($hasil->result() as $sess) {
            $sess_data['logged_in'] = 'yes';
            $sess_data['id_user'] = $sess->id_user;
            $sess_data['nama'] = $sess->nama;
            $sess_data['username'] = $sess->username;
            $sess_data['role'] = $sess->role;
            $this->session->set_userdata($sess_data);
        }
        if ($this->session->userdata('role')=='admin') {
            redirect('admin');
        }
        }
 
        echo "pw salah";
    
    
}
        
}
        
    /* End of file  Login.php */
        
                            