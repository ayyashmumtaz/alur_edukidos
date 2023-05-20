<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class M_preorder extends CI_Model {
                        
    public function getPekerjaan(){
    $query = $this->db->get('pekerjaan');         
    return $query;    
    }                           
                        
                            
                        
}
                        
/* End of file M_preorder.php */
    
                        