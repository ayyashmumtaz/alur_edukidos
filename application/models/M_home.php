<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class M_home extends CI_Model {
                            
        public function getKaryawan()
        {
            $this->db->select('*');
            $this->db->from('karyawan');
            $query = $this->db->get();
            return $query;
        }
         
        public function getPekerjaan()
        {
            $this->db->select('*');
            $this->db->from('pekerjaan');
            $query = $this->db->get();
            return $query;
        }
       
        public function getKerja() {
            $this->db->select('*');
            $this->db->from('pekerjaan');
            $query = $this->db->get();
            return $query->result();
        }

        public function getDataPekerjaan() {
            // Lakukan query ke database untuk mengambil data
            // Contoh:
            $query = $this->db->query('SELECT * FROM pekerjaan');
            return $query->result_array();
        }

        function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
                            
                    

                        
                            
                        
}
                        
/* End of file M_home.php */
    
                        