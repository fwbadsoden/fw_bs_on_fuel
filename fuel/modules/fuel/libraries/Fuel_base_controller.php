<?php
define('FUEL_ADMIN', TRUE);

class Fuel_base_controller extends Controller {
	
	public $js_controller = 'BaseFuelController';
	public $js_controller_path = 'jqx_config.jsPath + "fuel/controller/"';
	public $js_controller_params = array();
	public $nav_selected;
	
	function __construct($validate = TRUE)
	{
		parent::Controller();

		$this->load->library('form');
		$this->load->helper('convert');
		$this->load->helper('ajax');
		$this->load->helper('cookie');
		$this->load->helper('inflector');
		$this->load->helper('string');
		$this->load->helper('text');

		$this->config->load('fuel', TRUE);
		$this->load->module_language(FUEL_FOLDER, 'fuel', $this->config->item('language'));
		$this->config->load('asset');
		
		$this->load->module_library(FUEL_FOLDER, 'fuel_modules');
		$this->load->module_helper(FUEL_FOLDER, 'fuel');
		
		// check any remote host or IP restrictions first
		if (!$this->config->item('admin_enabled', 'fuel') OR ($this->config->item('restrict_to_remote_ip', 'fuel') AND !in_array($_SERVER['REMOTE_ADDR'], $this->config->item('restrict_to_remote_ip', 'fuel'))))
		{
			show_404();
		}
		// set asset output settings
		$this->asset->assets_output = $this->config->item('fuel_assets_output', 'fuel');
		
		if ($validate) $this->_check_login();
		
		$this->load->module_model(FUEL_FOLDER, 'logs_model');
		$this->load->helpers(array('ajax','date'));
		
		// set up default variables
		$load_vars = array(
			'js' => '', 
			'css' => $this->_load_css(),
			'js_controller_params' => array(), 
			'keyboard_shortcuts' => $this->config->item('keyboard_shortcuts', 'fuel'),
			'nav' => $this->_nav(),
			'modules_allowed' => $this->config->item('modules_allowed', 'fuel'),
			'page_title' => $this->_page_title()
			);
			
		if ($validate)
		{
			$load_vars['user'] = $this->fuel_auth->user_data();
			$load_vars['session_key'] = $this->fuel_auth->get_session_namespace();
		}

		$this->load->vars($load_vars);

		
		// set configuration paths. site paths are used for the preview since
		$this->asset->assets_modul ='fuel';

		$this->_last_page();
		
	}
	protected function _check_login()
	{
		// load this after the the above because it needs a database connection. Avoids a database connection error if there isn't one'
		$this->load->module_library(FUEL_FOLDER, 'fuel_auth');
		
		// check if logged in
		if (!$this->fuel_auth->is_logged_in() OR !is_fuelified())
		{
			$login = $this->config->item('fuel_path', 'fuel').'login';
			$cookie = array(
				'name' => $this->fuel_auth->get_fuel_trigger_cookie_name(), 
				'path' => WEB_PATH
			);
			delete_cookie($cookie);
			if (!is_ajax())
			{
				redirect($login.'/'.uri_safe_encode($this->uri->uri_string()));
			}
			else 
			{
				$output = "<script type=\"text/javascript\" charset=\"utf-8\">\n";
				$output .= "top.window.location = '".site_url($login)."'\n";
				$output .= "</script>\n";
				$this->output->set_output($output);
				return;
			}
		}

		
	}
	protected function _validate_user($permission, $type = 'edit', $show_error = TRUE)
	{
		if (!$this->fuel_auth->has_permission($permission, $type))
		{
			if ($show_error)
			{
				show_error(lang('error_no_access'));
			}
			else
			{
				exit();
			}
		}
	}
	
	protected function _has_module($module)
	{
		if ($module == 'fuel') return TRUE;
		return (file_exists(APPPATH.MODULES_FOLDER.'/'.$module) && in_array($module, $this->config->item('modules_allowed', 'fuel')));
	}
	
	protected function _last_page($key = NULL)
	{
		if (!isset($key)) $key = uri_path(FALSE);
		$invalid = array(
			fuel_uri('recent')
		);
		$session_key = $this->fuel_auth->get_session_namespace();
		$user_data = $this->fuel_auth->user_data();
		
		if (!is_ajax() AND empty($_POST) AND !in_array($key, $invalid))
		{
			$user_data['last_page'] = $key;
			$this->session->set_userdata($session_key, $user_data);
		}
	}
	
	protected function _recent_pages($link, $name, $type)
	{
		$this->load->helper('array');
		$session_key = $this->fuel_auth->get_session_namespace();
		$user_data = $this->fuel_auth->user_data();
		
		if (!isset($user_data['recent'])) $user_data['recent'] = array();
		$already_included = false;
		foreach($user_data['recent'] as $key => $pages)
		{
			if ($pages['link'] == $link AND $pages['name'] == $name AND $pages['type'] == $type)
			{
				$user_data['recent'][$key]['last_visited'] = time();
				$already_included = TRUE;
			}
		}

		if (!$already_included)
		{
			if (strlen($name) > 100) $name = substr($name, 0, 100).'&hellip;';
			$val = array('name' => $name, 'link' => $link, 'last_visited' => time(), 'type' => $type);
			array_unshift($user_data['recent'], $val);
		}

		if (count($user_data['recent']) > $this->config->item('max_recent_pages', 'fuel'))
		{
			array_pop($user_data['recent']);
		}
		$user_data['recent'] = array_sorter($user_data['recent'], 'last_visited', 'desc', TRUE);
		$this->session->set_userdata($session_key, $user_data);
		
	}
	
	protected function _render($view, $vars = array(), $module = NULL)
	{
		$this->_nav_selected();
		if (empty($vars['notifications']))
		{
			if (isset($this->model) AND is_a($this->model, 'MY_Model')) $vars['error'] = $this->model->get_errors();
			$vars['notifications'] = $this->load->module_view(FUEL_FOLDER, '_blocks/notifications', $vars, TRUE);
		}
		if (!isset($module))
		{
			$module = (!empty($this->view_location)) ? $this->view_location : FUEL_FOLDER;
		}
		
		$this->load->module_view(FUEL_FOLDER, '_blocks/fuel_header');
		$this->load->module_view($module, $view, $vars);
		$this->load->module_view(FUEL_FOLDER, '_blocks/fuel_footer');
	}
	
	protected function _nav()
	{
		$nav = $this->config->item('nav', 'fuel');
		$modules = array('fuel');
		$modules = array_merge($modules, $this->config->item('modules_allowed', 'fuel'));
		
		foreach($modules as $module)
		{
			$nav_path = APPPATH.MODULES_FOLDER.'/'.$module.'/config/'.$module.'.php';
			if (file_exists($nav_path))
			{
				include($nav_path);
				$nav = array_merge($nav, $config['nav']);
			}
		}
		
		// automatically include modules if set to AUTO
		if (is_string($nav['modules']) AND strtoupper($nav['modules']) == 'AUTO')
		{
			@include(APPPATH.'config/MY_fuel_modules.php');
			
			$nav['modules'] = array();
			
			if (!empty($config['modules']))
			{
				foreach($config['modules'] as $key => $module)
				{
					// if (in_array($key, $this->config->item('modules_allowed', 'fuel')))
					// {
						if (!empty($module['module_name']))
						{
							$nav['modules'][$key] = $module['module_name'];
						}
						else
						{
							$nav['modules'][$key] = humanize($key);
						}
					// }
				}
				
			}
		}
		return $nav;
	}
	
	// determine the left had nav selection
	protected function _nav_selected()
	{
		if (empty($this->nav_selected))
		{
			if (fuel_uri_segment(1) == '')
			{
				$this->nav_selected = 'dashboard';
			}
			else
			{
				$this->nav_selected = fuel_uri_segment(1);
			}
		}
	}
	
	// load the css files for the admin include from other modules
	protected function _load_css()
	{
		$modules = $this->config->item('modules_allowed', 'fuel');
		
		$css = array();
		foreach($modules as $module)
		{
			// check if there is a css module assets file and load it so it will be ready when the page is ajaxed in
			if (file_exists(APPPATH.MODULES_FOLDER.'/'.$module.'/assets/css/'.$module.'.css'))
			{
				$css[] = array($module => $module);
			}
		}
		if ($this->config->item('xtra_css', 'fuel'))
		{
			$css[] = array('' => $this->config->item('xtra_css', 'fuel'));
		}
		return $css;
	}

	// generate the page title
	protected function _page_title($segs = array(), $humanize = TRUE)
	{
		$CI =& get_instance();
		if (empty($segs))
		{
			$segs = $CI->uri->segment_array();
			array_shift($segs);
		}
		$page_segs = array();
		if (empty($segs)) $segs = array('dashboard');
		foreach($segs as $seg)
		{
			if (!is_numeric($seg))
			{
				if ($humanize) $seg =  humanize($seg);
				$page_segs[] = $seg;
			}
		}
		$page_title = 'FUEL CMS : '.implode(' : ', $page_segs);
		return $page_title;
	}

	function reset_page_state()
	{
		$state_key = $this->_get_state_key();
		if (!empty($state_key))
		{
			$session_key = $this->fuel_auth->get_session_namespace();
			$user_data = $this->fuel_auth->user_data();
			$user_data['page_state'] = array();
			$this->session->set_userdata($session_key, $user_data);
			redirect(fuel_url($state_key));
		}
	}
	
	protected function _save_page_state($vars = array())
	{
		$state_key = $this->_get_state_key();
		if (!empty($state_key))
		{
			$session_key = $this->fuel_auth->get_session_namespace();
			$user_data = $this->fuel_auth->user_data();
			if (!isset($user_data['page_state']))
			{
				$user_data['page_state'] = array();
			}
			$user_data['page_state'][$state_key] = $vars;
			$this->session->set_userdata($session_key, $user_data);
		}
		
	}

	protected function _get_page_state()
	{
		$state_key = $this->_get_state_key();
		if (!empty($state_key))
		{
			$user_data = $this->fuel_auth->user_data();
			return (isset($user_data['page_state'][$state_key])) ? $user_data['page_state'][$state_key] : array();
		}
	}
	
	protected function _get_state_key()
	{
		if (!empty($this->module))
		{
			return $this->module;
		}
		else
		{
			return FALSE;
		}
	}

}

/* End of file fuel_base.php */
/* Location: ./modules/fuel/controllers/Fuel_base_controller.php */