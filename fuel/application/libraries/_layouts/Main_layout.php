<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('Base_layout.php');

class Main_layout extends Base_layout {

    /**
     * Hook used for processing variables specific to a layout
     *
     * @access  public
     * @param   array   variables for the view
     * @return  array
     */
    function pre_process($vars)
    { 
        $vars = parent::pre_process($vars);
        
        // Variablen für bestimmte Inhaltsseiten laden
        
        // MFW
        if(strpos(uri_string(), "menschen/minifeuerwehr") !== false) {
            $vars["articles"] = $this->_get_mfw_pressarticles();
        }
        
        // Jugend
        if(strpos(uri_string(), "menschen/jugend") !== false) {
            $vars["articles"] = $this->_get_jugend_pressarticles();
        }
        
        return $vars;
    } 
    
    private function _get_jugend_pressarticles() {
        
        $CI =& get_instance();
        $CI->db->select("id");
        $CI->db->where("slug", "jugendfeuerwehr");
        $query = $CI->db->get("categories");
        $row = $query->row();
        $id = $row->id;
        
        $articles = fuel_model('pressarticles', array('find' => 'all', 'order' => ('datum desc'), 'where' => array('category_id' => $id)));
        
        return $articles;
    }
    
    private function _get_mfw_pressarticles() {
        
        $CI =& get_instance();
        $CI->db->select("id");
        $CI->db->where("slug", "minifeuerwehr");
        $query = $CI->db->get("categories");
        $row = $query->row();
        $id = $row->id;
        
        $articles = fuel_model('pressarticles', array('find' => 'all', 'order' => ('datum desc'), 'where' => array('category_id' => $id)));
        
        return $articles;
    }
}

?>