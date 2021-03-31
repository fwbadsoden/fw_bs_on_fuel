<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/fuel/modules/fuel/controllers/Page_router.php");

class My_page_router extends Page_router {

    public function _remap($method = NULL) {
        if (!in_array(uri_path(TRUE), $this->fuel->pages->cms()) && uri_path(TRUE) != "offline") {
            $uri_path = uri_path(TRUE);
            if (substr($uri_path, -1) == "/") {
                $uri_path = rtrim($uri_path, "/");
            } elseif (is_numeric(substr($uri_path, strrpos($uri_path, "/") + 1))) {
                $uri_path = rtrim($uri_path, substr($uri_path, strrpos($uri_path, "/")));
            }
            if (!in_array($uri_path, $this->fuel->pages->cms())) {
                $this->location = "404_error";
            } else {
                $this->location = uri_path(TRUE);
            }
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
