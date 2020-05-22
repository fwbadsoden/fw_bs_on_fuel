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
        
        $articles = fuel_model('Pressarticles', array('find' => 'all', 'order' => ('datum desc'), 'where' => array('category_id' => $id)));
        $articles_arr = array();
        foreach($articles as $article) {
            $article_arr["name"] = $article->name;
            $article_arr["datum"] = $article->datum;
            $article_arr["online_article"] = $article->online_article;
            $article_arr["asset"] = $article->asset;
            $article_arr["source_name"] = $article->source->name;
            array_push($articles_arr, $article_arr);
        }
        return $articles_arr;
    }
    
    private function _get_mfw_pressarticles() {
        
        $CI =& get_instance();
        $CI->db->select("id");
        $CI->db->where("slug", "minifeuerwehr");
        $query = $CI->db->get("categories");
        $row = $query->row();
        $id = $row->id;
        
        $articles = fuel_model('Pressarticles', array('find' => 'all','order' => ('datum desc'), 'where' => array('category_id' => $id)));
        $articles_arr = array();
        foreach($articles as $article) {
            $article_arr["name"] = $article->name;
            $article_arr["datum"] = $article->datum;
            $article_arr["online_article"] = $article->online_article;
            $article_arr["asset"] = $article->asset;
            $article_arr["source_name"] = $article->source->name;
            array_push($articles_arr, $article_arr);
        }
        return $articles_arr;
    }
}

?>