<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class M_karyawan extends CI_Model {

    public function getKaryawan()
    {
        $this->db->select('*');
        $this->db->from('karyawan');
        $query = $this->db->get();
        return $query;
    }

}
                        
/* End of file M_karyawan.php */
    
                        