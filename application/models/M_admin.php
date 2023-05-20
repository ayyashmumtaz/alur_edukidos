<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class M_admin extends CI_Model {
                        
    public function simpanPekerjaan($data, $table)
    {
        $this->db->insert($table, $data);
    }

                        
}
                        
/* End of file M_admin.php */
    
                        