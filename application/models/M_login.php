<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class M_login extends CI_Model {
                        
public function cek_login($data){
    $query = $this->db->get_where('user', $data);         
    return $query;    
                                
}
                        
                            
                        
}
                        
/* End of file M_login.php */
    
                        