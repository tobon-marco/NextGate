<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
	function __construct()
	{
		parent::__construct();
		$this->data['meta_title'] = "NextGate Music Database";
	}

	public function index()
	{
		$this->data['meta_title'] = "NextGate Music Database";
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in !== true)
		{
			redirect('Welcome/index');
		}

		$this->load->view('template/header', $this->data);
		$this->load->view('opening_page');
		$this->load->view('template/footer');
	}
	public function root()
	{
		$this->data['meta_title'] = "NextGate Music Database";
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in !== true)
		{
			redirect('Welcome/index');
		}

		$this->load->view('template/root_header', $this->data);
		$this->load->view('opening_page');
		$this->load->view('template/footer');
	}
	public function addUser_view()
	{
		$this->data['meta_title'] = "Add User";
		$this->load->view('template/root_header', $this->data);
		$this->load->view('add_user');
		$this->load->view('template/footer');
	}

	//==================== SEARCH FUCNTION FOR THE USER ==============================================
	function search()
	{
		$terms = $this->input->post('search');
		$terms_arr = array();
		$terms_arr = preg_split("/[\s,]+/", $terms); //split terms by spaces into array

		$this->load->model('user_model');
		$res_arr = $this->user_model->get_results($terms_arr);
		
		$this->data = array("albums" => $res_arr[0], "singers" => $res_arr[1]);
		$this->data['meta_title'] = "Results Data";
		if ($this->session->userdata['username'] == 'ckim')
		{
			$this->load->view('template/root_header', $this->data);
		}
		else
			$this->load->view('template/nav_header', $this->data);

		$this->load->view('search_result', $this->data);
		$this->load->view('template/footer');
	}
	//=========================LOGOUT ================================
	function logout()
	{
		$this->data['meta_title'] = "Login Page";
		$this->session->sess_destroy();
		redirect('Welcome/index', $this->data);
	}
	function add_user()
	{
		$this->data['meta_title'] = "Add User";
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[ng_users.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		if($this->form_validation->run())
		{
			$this->load->model('user_model');
			$this->user_model->register_user();
			$this->data['meta_title'] = "NextGate Music Database";
			redirect('user/root');
		}
		$this->load->view('template/root_header', $this->data);
		$this->load->view('add_user');
		$this->load->view('template/footer');
		
		
	}
	function add_music()
	{
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
