<?php

include_once($_ENV["DOC_ROOT"] . "/fuel/modules/fuel/controllers/page_router.php");

class My_page_router extends Page_router {

    public function _remap($method) {
        if (!array_key_exists(uri_path(TRUE), $this->fuel->pages->cms()) && uri_path(TRUE) != "offline") {
            $this->location = "404notfound";
        } else {
            $this->location = uri_path(TRUE);
        }

        // if the rerouted file can't be found, look for the non-routed file'
        if (!file_exists(APPPATH . 'views/' . $this->location . EXT)) {
            $non_routed_uri = uri_path(FALSE);

            if (file_exists(APPPATH . 'views/' . $non_routed_uri . EXT)) {
                $this->location = $non_routed_uri;
            }

            unset($non_routed_uri);
        }

        if (empty($this->location))
            $this->location = $this->fuel->config('default_home_view');

        $config = array();
        $config['location'] = $this->location;

        if ($this->fuel->pages->mode() == 'views') {
            $config['render_mode'] = 'views';
            $page = $this->fuel->pages->create($config);

            $this->_remap_variables($page);
        }
        // using FUEL admin
        else {
            if ($this->fuel->pages->mode() != 'cms') {
                $config['render_mode'] = 'auto';

                if ($this->fuel->config('uri_view_overwrites')) {
                    // loop through the pages array looking for wild-cards
                    foreach ($this->fuel->config('uri_view_overwrites') as $val) {
                        // convert wild-cards to RegEx
                        $key = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $val));

                        // does the RegEx match?
                        if (preg_match('#^' . $val . '$#', $config['location'])) {
                            $config['render_mode'] = 'views';
                        }
                    }
                }
                
                $page = $this->fuel->pages->create($config);

                if ((!$page->has_cms_data() AND $config['render_mode'] == 'auto') OR $config['render_mode'] == 'views') {
                    $this->_remap_variables($page);
                    return;
                }
            } else {
                $config['render_mode'] = 'cms';
                $page = $this->fuel->pages->create($config);
            }

            $this->_remap_cms($page);
        }
    }

}
