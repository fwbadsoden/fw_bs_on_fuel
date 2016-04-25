<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Weather extends Fuel_base_library {
 
    private $api_key = "d5d53504c51b8b9c8eb40a3ef8bb911e";
    private $city_id_bad_soden = "2953339";
    private $url = "http://api.openweathermap.org/data/2.5/weather?";
    
    private function is_reload($date1, $date2) {
        
        $interval = $date1->diff($date2);
        
        if($interval->y > 0 || $interval->m > 0 || $interval->d > 0 || $interval->h > 1) return true;
        
        if($interval->h == 1 && $interval->m < 50) return true;
            
        if($interval->m > 10) return true;
        
        return false;
    }
 
    public function get_weather() {
        
        $CI =& get_instance();
        $query = $CI->db->get("weather");
        $json = "";
        $now = new DateTime("now");
      
        if($query->num_rows() == 0) {
            $insert = true;
            $reload = true;
        } else {
            $row = $query->row();  
            $insert = false;
        
            $last_call = $row->last_call;

            $reload = $this->is_reload(new DateTime($last_call), $now);
        }
            
        if($reload) {        
            // call openweather API
            $query_params = array('id' => $this->city_id_bad_soden, 
                                  'APPID' => $this->api_key,
                                  'lang' => 'de',
                                  'units' => 'metric');
            $url = $this->url.http_build_query($query_params);
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $json = curl_exec($ch);
            curl_close($ch);
            
            $data = array('last_call' => $now->format("Y-m-d H:i:s"), 'json' => $json);
            
            if($insert) {
                $CI->db->insert('weather', $data);
            } else {
                $CI->db->where('id', $row->id);
                $CI->db->update('weather', $data);
            }
        } else {
            $json = $row->json;
        }
        
        $weather_obj = json_decode($json);
        $weather["temperature"] = $weather_obj->main->temp;
        $weather["description"] = $weather_obj->weather[0]->description;
        $weather["image"] = "<img src='http://openweathermap.org/img/w/".$weather_obj->weather[0]->icon.".png'>";
        
        return $weather;
    }    
}

/* End of file Weather.php */
/* Location: ./application/libraries/Weather.php */