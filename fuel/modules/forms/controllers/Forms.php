<?php
class Forms extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('ajax');
		$this->load->library('session');
	}

	public function process($slug) 
	{ 
		$form = NULL;
		try
		{
			$form = $this->fuel->forms->get($slug);
		}
		catch (Throwable $e)
		{
		}

		$return_url = ($this->input->get_post('return_url')) ? $this->input->get_post('return_url') : (($form) ? $form->return_url : site_url());
		$form_url = $this->input->get_post('form_url');
		$processed = FALSE;

		if ($form)
		{
			try
			{
				$processed = $form->process();
			}
			catch (Throwable $e)
			{
			}
		}
              
		if ($form AND $processed)
		{ 
			if (is_ajax())
			{
				// Set a 200 (okay) response code.
				set_status_header('200');
				echo $form->after_submit_text;
				exit();
			}
			else
			{ 
				$this->session->set_flashdata('success', TRUE);
				redirect($return_url);
			}
		}
		else
		{
			$this->session->set_flashdata('posted', $this->input->post());

			if (is_ajax())
			{    
				$errors = ($form) ? $form->errors() : array('Das Formular konnte nicht geladen werden.');

				// Validation/submission errors are client-side form issues, not server crashes.
				set_status_header('422');
				echo is_array($errors) ? display_errors($errors, '') : $errors;
				exit();
			}
			else
			{
				if (!empty($form_url) && ($form_url != $return_url))
				{
					$return_url = $form_url; // update to post back to the correct page when there's an error
				}

				if ($form)
				{
					$this->session->set_flashdata('error', $form->errors());
				}
				else
				{
					$this->session->set_flashdata('error', array('Das Formular konnte nicht geladen werden.'));
				}
				redirect($return_url);
			}
		}

	}
}