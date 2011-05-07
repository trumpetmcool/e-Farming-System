<?php

class Home extends CI_Controller
{
	var $welcome = '';
	function Home()
	{
		parent::__construct();
		$this->load->model('users_model');
	}
	
	function isLoggedIn()
	{
		$logged_in = $this->session->userdata('logged');
		$clogged_in = $this->input->cookie('logged', TRUE);
		if ( (!isset($logged_in) || $logged_in != true) && (!isset($clogged_in) || $clogged_in != true) )
		{
			return 0;
		}
		else
		{
			$username = $this->session->userdata('username');
			$password = $this->session->userdata('password');
			$cusername = $this->input->cookie('username', TRUE);
			$cpassword = $this->input->cookie('password', TRUE);
			$data['username'] = $username;
			$user = $this->users_model->getUser($data);
			$data['username'] = $cusername;
			$cuser = $this->users_model->getUser($data);
			if ( (!$user || $password != $user['password']) && (!$cuser || $cpassword != $cuser['password']) )
				return 0;
			else
			{
				if ($user)
					$this->welcome = $user['first_name'];
				else
					$this->welcome = $cuser['first_name'];
				//$this->load->view('users/loginsuccess_view', $data);
				return 1;
			}
		}
	}
	
	function index()
	{
		$data['title'] = 'Home';
		$data['logged'] = $this->isLoggedIn();
		$this->load->view('header', $data);
		
		//echo "Welcome to e-Farming<br />";
		if (!empty($this->welcome))
		{
			$data['first_name'] = $this->welcome;
			$this->load->view('users/loginsuccess_view', $data);
		}
		//$this->load->view('menu', $data);
		$this->load->view('welcome');
		
		$this->load->view('footer');
	}
}