<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		$this->data['meta_title'] = "Login Page";
		if($this->is_logged_in())
		{
			redirect('user/index');
		}
		$this->load->view('template/header', $this->data);
		$this->load->view('login_view');
		$this->load->view('template/footer');
	}

	//================================ Chexks to see if data entered is true ========================================
	public function login()
	{
		$this->data['meta_title'] = "Login Page";
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|callback_username_check');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if($this->form_validation->run())
		{
			$data = array(
						'username' => $this->input->post('username'),
						'is_logged_in' => true
					);
			$this->session->set_userdata($data);
			if ($this->session->userdata['username'] == 'ckim')
				redirect('user/root');
			else
				redirect('user/index');
		}
		$this->load->view('template/header', $this->data);
		$this->load->view('login_view');
		$this->load->view('template/footer');
	}

	//============================This is used for the log in form validation ====================================
	function username_check()
	{
		$this->load->model('user_model');
		$result = $this->user_model->login();
		if($result)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('username_check', 'You have entered an incorrect username or password');
			return false;
		}
	}

	//=============================== ARE YOU LOGGED IN ===================================
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if (!isset($is_logged_in) || $is_logged_in !== true)
		{
			return false;
		}
		return true;
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

