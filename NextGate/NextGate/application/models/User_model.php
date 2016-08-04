<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	//USER LOGIN FUNCTION =================================
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

	//TO BE USED FOR A USER CALLED ROOT ===============================================
	function register_user()
	{
		$data = array(
			'ng_users_id'			=>	'',
			'username'			=>	$this->input->post('username'),
			'password' 		=> 	md5($this->input->post('password')),
		);

		$this->db->insert('ng_users', $data);
		
	}
	//TO BE USED FOR A USER CALLED ROOT ===============================================
	function add_music()
	{
		$data = array(
			'ng_singers_id'			=>	'',
			'name'			=>	$this->input->post('username'),
			'' 		=> 	md5($this->input->post('password')),
		);

		$this->db->insert('ng_users', $data);
		
	}
	//GET RESULTS FROM SEARCH BOX =====================================================
	function get_results($terms_arr)
	{
		$albums = array();
		$singers = array();
		$singers_albums = array();
		//print_r($terms_arr);
		foreach ($terms_arr as $term)
		{
			$curr_singer;
			//SEARCH IN ALBUM_NAME RELEASE_YEAR AND COMPANY ONLY DISTINCTS -----------------------------------------
			$res = $this->db->query("SELECT ng_singers_id, album_name, release_year, record_company FROM ng_albums WHERE album_name LIKE '%".($term)."%' 
									UNION
									SELECT ng_singers_id, album_name, release_year, record_company FROM ng_albums WHERE release_year LIKE '%".($term)."%'
									UNION
									SELECT ng_singers_id, album_name, release_year, record_company FROM ng_albums WHERE record_company LIKE '%".($term)."%';
									");
			foreach ($res->result() as $row) 
			{
				$curr_singer = $row->ng_singers_id;
				$keyword_string = "{$row->album_name}|{$row->release_year}|{$row->record_company}"; //concatenate all keywords with spacing
				if (!array_key_exists($curr_singer, $albums))
				{
					$albums[$curr_singer] = array();
				}
				array_push( $albums[$curr_singer] , $keyword_string); //maps the name to singers information
				//GET SINGER FROM ALBUMS --------------------------------------------------
				foreach ($albums as $key => $val)
				{
					$res2 = $this->db->query("SELECT S.name as n, S.dob, S.sex FROM ng_singers S, ng_albums A WHERE S.ng_singers_id='".($key)."';");
					$row = $res2->result();
					$keyword_string = "{$row[0]->n}|{$row[0]->dob}|{$row[0]->sex}"; //concatenate all keywords with spacing
					if (!array_key_exists($row[0]->n, $singers))
					{
						$singers[$row[0]->n] = array();
					}
					if (!in_array($keyword_string, $singers[$row[0]->n]))
					{
						array_push( $singers[$row[0]->n] , $keyword_string); //maps the name to singers information
					}
				}
			}
			//======================================================================================================================================================================
			//SEARCH IN NAME DOB SEX ONLY DISTINCTS -----------------------------------------
			$res = $this->db->query("SELECT name, dob, sex FROM ng_singers WHERE name LIKE '%".($term)."%' 
									UNION
									SELECT name, dob, sex FROM ng_singers WHERE dob LIKE '%".($term)."%'
									UNION
									SELECT name, dob, sex FROM ng_singers WHERE sex LIKE '%".($term)."%'
									");
			foreach ($res->result() as $row) 
			{
				$curr_singer_name = $row->name;
				$keyword_string = "{$row->name}|{$row->dob}|{$row->sex}"; //concatenate all keywords with spacing
				if (!array_key_exists($curr_singer_name, $singers))
				{
					$singers[$curr_singer_name] = array();
				}
				//ADDED
				if (!in_array($keyword_string, $singers[$curr_singer_name]))
				{
					array_push( $singers[$curr_singer_name] , $keyword_string); //maps the name to singers information
				}
				//array_push($singers[$curr_singer_name] , $keyword_string); //maps the name to singers information
				
				//GET ALBUMS FROM SINGER --------------------------------------------------
				
				$res2 = $this->db->query("SELECT S.ng_singers_id as n, A.album_name, A.release_year, A.record_company FROM ng_albums A, ng_singers S WHERE S.name LIKE '%".($term)."%' AND S.ng_singers_id=A.ng_singers_id");
				foreach ($res2->result() as $row) 
				{
					$keyword_string = "{$row->album_name}|{$row->release_year}|{$row->record_company}"; //concatenate all keywords with spacing
					if (!array_key_exists($row->n, $albums))
					{
						$albums[$row->n] = array();
					}
					//ADDED
					if (!in_array($keyword_string, $albums[$row->n]))
					{
						array_push( $albums[$row->n] , $keyword_string); //maps the name to singers information
					}
					//array_push( $albums[$row->n] , $keyword_string); //maps the name to singers information
				}
				
			}
			//=======================================================================================================================================================================
		}
		//REPLACE ID WITH ACTUAL SINGER NAME
		foreach ( $albums as $key => $val)
		{
			$res = $this->db->query("SELECT name as n FROM ng_singers WHERE ng_singers_id ='".($key)."'");
			$r = $res->result();
			//print_r($key);
			$albums[$r[0]->n] = $albums[$key];
			unset($albums[$key]);
		}
		$data_arr = array($albums, $singers);
		return $data_arr;
	}
}
?>
