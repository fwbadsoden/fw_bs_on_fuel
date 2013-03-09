<?php
require_once('module.php');

class Blocks extends Module {
	
	function __construct()
	{
		parent::__construct();
	}

	function _form_vars($id = NULL, $fields = NULL, $log_to_recent = TRUE, $display_normal_submit_cancel = TRUE)
	{
		$vars = parent::_form_vars($id, $fields, $log_to_recent, $display_normal_submit_cancel);
		$saved = $vars['data'];
		$import_view = FALSE;
		$warning_window = '';
		if (!empty($saved['name'])) {
			$view_twin = APPPATH.'views/_blocks/'.$saved['name'].EXT;
			if (file_exists($view_twin))
			{
				$this->load->helper('file');
				$view_twin_info = get_file_info($view_twin);
				if (!empty($saved)) 
				{
					$tz = date('T');
					if ($view_twin_info['date'] > strtotime($saved['last_modified'].' '.$tz) OR 
						$saved['last_modified'] == $saved['date_added'])
					{
						$warning_window = lang('blocks_updated_view', $view_twin);
					}
				}
			}
		}
		$vars['warning_window'] = $warning_window;
		return $vars;
	}
	
	function import_view_cancel()
	{
		if ($this->input->post('id')){

			// don't need to pass anything because it will automatically update last_modified'
			$save['id'] = $this->input->post('id');
			$save['name'] = $this->input->post('name');
			$save['last_modified'] = datetime_now();

			if ($this->model->save($save))
			{
				$this->output->set_output('success');
				return;
			}
		}
		$this->output->set_output('error');
	}
	
	function import_view()
	{
		$out = 'error';
		if (!empty($_POST['id']))
		{
			$out = $this->fuel->blocks->upload($this->input->post('id'), $this->sanitize_input);
		}
		$this->output->set_output($out);
	}
	
	function upload($inline = FALSE)
	{
		$this->load->helper('file');
		$this->load->helper('security');
		$this->load->library('form_builder');

		$this->js_controller_params['method'] = 'upload';
		
		if (!empty($_POST))
		{
			if (!empty($_FILES['file']['name']))
			{
				
				$error = FALSE;
				$file_info = $_FILES['file'];

				// read in the file so we can filter it
				$file = read_file($file_info['tmp_name']);
				
				// sanitize the file before saving
				$file = $this->_sanitize($file);
				$id = $this->input->post('id', TRUE);
				$name =  $this->input->post('name', TRUE);
				$language =  $this->input->post('language', TRUE);

				if (empty($name))
				{
					$name = current(explode('.', $file_info['name']));
				}

				if ($id)
				{
					$save['id'] = $id;
				}

				$save['name'] = $name;
				$save['view'] = $file;
				$save['language'] = $language;
				$save['date_added'] = datetime_now();

				$id  = $this->model->save($save);
				if (!$id)
				{
					add_error(lang('error_upload'));
				}
				else
				{
					// change list view page state to show the selected group id
					$this->fuel->admin->set_notification(lang('blocks_success_upload'), Fuel_admin::NOTIFICATION_SUCCESS);
					
					redirect(fuel_url('blocks/edit/'.$id));
				}
				
			}
			else if (!empty($_FILES['file']['error']))
			{
				add_error(lang('error_upload'));
			}
		}

		$fields = array();
		$blocks = $this->model->options_list('id', 'name', array('published' => 'yes'), 'name');
		
		$fields['name'] = array('label' => lang('form_label_name'), 'type' => 'inline_edit', 'options' => $blocks, 'module' => 'blocks');
		$fields['file'] = array('type' => 'file', 'accept' => '', 'required' => TRUE);
		$fields['id'] = array('type' => 'hidden');
		$fields['language'] = array('type' => 'hidden');
		
		$common_fields = $this->_common_fields();
		$fields = array_merge($fields, $common_fields);
		
		
		$this->form_builder->hidden = array();
		$this->form_builder->set_fields($fields);
		$this->form_builder->set_field_values($_POST);
		$this->form_builder->submit_value = '';
		$this->form_builder->use_form_tag = FALSE;
		$vars['instructions'] = lang('blocks_upload_instructions');
		$vars['form'] = $this->form_builder->render();
		$vars['back_action'] = ($this->fuel->admin->last_page() AND $this->fuel->admin->is_inline()) ? $this->fuel->admin->last_page() : fuel_uri($this->module_uri);
		//$vars['back_action'] = fuel_uri($this->module_uri);
		
		$crumbs = array($this->module_uri => $this->module_name, lang('action_upload'));
		$this->fuel->admin->set_titlebar($crumbs);
		
		$this->fuel->admin->render('upload', $vars, Fuel_admin::DISPLAY_NO_ACTION);
	}


	function layout_fields($layout, $id = NULL, $lang = NULL, $_context = NULL)
	{

		// check to make sure there is no conflict between page columns and layout vars
		$layout = $this->fuel->layouts->get($layout, 'block');
		if (!$layout)
		{
			return;
		}

		// sort of kludgy but not wanting to encode/unencode brackets
		if (empty($_context))
		{
			$_context = $this->input->get('context', TRUE);
		}
		if (!empty($_context))
		{
			$layout->set_context($_context);
		}
		
		$fields = $layout->fields();


		$this->load->module_model(FUEL_FOLDER, 'fuel_pagevariables_model');
		$this->load->library('form_builder');
		$this->form_builder->load_custom_fields(APPPATH.'config/custom_fields.php');
		
		$this->form_builder->question_keys = array();
		$this->form_builder->submit_value = '';
		$this->form_builder->cancel_value = '';
		$this->form_builder->use_form_tag = FALSE;
		$this->form_builder->name_prefix = 'vars';
		$this->form_builder->set_fields($fields);
		$this->form_builder->display_errors = FALSE;
		
		if (!empty($id))
		{
			$page_vars = $this->fuel_pagevariables_model->find_all_by_page_id($id, $lang);

			// the following will pre-populate fields of a different language to the default values
			if (empty($page_vars) AND $this->fuel->language->has_multiple() AND $lang != $this->fuel->language->default_option())
			{
				$page_vars = $this->fuel_pagevariables_model->find_all_by_page_id($id, $this->fuel->language->default_option());
			}
			// extract variables
			extract($page_vars);
			$_context_var = str_replace(array('[', ']'), array('["', '"]'), $_context);
			if (!empty($_context_var))
			{
				$_context_var_eval = '$_context = (isset($'.$_context_var.')) ? $'.$_context_var.' : "";';
				eval($_context_var_eval);
			}

			if (isset($_context))
			{
				$block_vars = $_context;
				$this->form_builder->set_field_values($block_vars);
			}

		}
		
		$form = $this->form_builder->render();
		$this->output->set_output($form);
	}
}