<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function login()
	{
		$username = $this->input->post('username');
		$passwd = $this->input->post('password');
		$q = $this 
					->db
					->where ('username', $username)
					->where ('password', md5($passwd))
					->get('ng_users');
		//Check if it returns only one row
		if ($q->num_rows()  == 1 )
		{
			//DO SOMETHING
			return true;
		}
		//If more then there is an error
		else if ( $q->num_rows() > 1)
		{
			echo ' SOMETHING WRONG ';
		}
		else
		{
			return false;
		}
	}

	function register_user(){
		$data = array(
			'uid'			=>	'',
			'username'			=>	$this->input->post('username'),
			'password' 		=> 	md5($this->input->post('password')),
			'username' 		=> 	$this->input->post('username'),
			'first_name' 	=> 	$this->input->post('first_name'),
			'last_name' 	=> 	$this->input->post('last_name'),
			'about_you' 	=> 	"",
			'location'		=>	"",
			'website' 		=> 	"",
			'profile_pic' 	=> 	"assets/img/default.jpg",
			// 'creation_date'	=>	"CURRENT_TIMESTAMP()",
			'DOB'			=>	$this->input->post('DOB'),
			'gender' 		=> 	"",
			'nick_name' 	=> 	$this->input->post('username'));

		$this->db->insert('users', $data);
		
		$query = $this->db->query("SELECT uid FROM users WHERE username='".($this->input->post('username'))."'" );
		$row = $query->row();
		
		$selectedInterests = $this->input->post('interests');
		
		for($i=0; $i<count($selectedInterests); $i++){
			$interestData = array(
				'uid' => $row->uid,
				'label' => $selectedInterests[$i]
			);
		
			$this->db->insert('interests', $interestData);
		}
	}
}
?>
