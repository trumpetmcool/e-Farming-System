<?php

class Users extends CI_Controller
{
	function Users()
	{
		//parent::Controller(); // Code igniter 1.x
		parent::__construct();
		
		$this->load->model('users_model');
		//$this->output->cache(120);
	}
	
	function Register()
	{
		$data['logged'] = $this->isLoggedIn();
		if (!$data['logged'])
		{
			// $this->input->post('username');
			$this->form_validation->set_rules('first_name',  'First Name',  'required');
			$this->form_validation->set_rules('last_name',  'Last Name',  'required');
			$this->form_validation->set_rules('username',  'Username',  'required');
			$this->form_validation->set_rules('email',  'Email',  'required|valid_email');
			$this->form_validation->set_rules('password',  'Password',  'required|min_length[5]');
			$this->form_validation->set_rules('confirm_password',  'Confirm password',  'required|min_length[5]|matches[password]');
			//$this->form_validation->set_rules('captcha',  'Captcha',  'required|callback_captcha_check');
			if ($this->form_validation->run() == FALSE)
			{
				foreach ($_POST as $key => $val)
						$data[$key] = $val;
				$data['title'] = 'Register';
				$this->load->view('users/register_view', $data);
			}
			else
			{
				//encrypt the password
				$fields = array('first_name', 'last_name', 'username', 'password', 'email');
				foreach ($_POST as $key => $val)
				{
					if (in_array($key, $fields))
						$dbdata[$key] = htmlspecialchars($val, ENT_QUOTES);
				}
				// hash password for security
				$dbdata['password'] = sha1($dbdata['password']);
				// generate random string to confirm email
				$dbdata['registration_code'] = random_string('alnum', 6);
				//insert the $_POST array into database.
				$this->users_model->AddUser($dbdata);
				$data['title'] = 'Registered Successfully';
				$this->load->view('users/regsuccess_view', $data);
				//redirect to login
				redirect('users/login');
			}
		}
		else
		{
			$data['title'] = 'Error: Already Registered';
			$data['error'] = 'You are already registered.';
			$this->load->view('error', $data);
		}
	}
	
	function Login()
	{
		$data['logged'] = $this->isLoggedIn();
		if (!$data['logged'])
		{
			$this->form_validation->set_rules('username',  'Username',  'required');
			$this->form_validation->set_rules('password',  'Password',  'required');
			$valid = true;
			if (isset($_POST['submit']))
			{
				$cuser = $this->users_model->getUser($_POST);
				if (sha1($_POST['password']) != $cuser['password'])
					$valid = false;
			}
		
			if ($this->form_validation->run() == FALSE || !$valid)
			{
				$data['title'] = 'Login';
				if (!$valid)
					$data['message'] = 'Incorrect username or password';
				$this->load->view('users/login_view', $data);
			}
			else
			{
				$sdata['username'] = $cuser['username'];
				$sdata['password'] = $cuser['password'];
				$sdata['id'] = $cuser['user_id'];
				$sdata['logged'] = true;
				
				if (isset($_POST['remember']))
				{
					// set cookie
					$this->input->set_cookie('username', $cuser['username'], 86400);
					$this->input->set_cookie('password', $cuser['password'], 86400);
					$this->input->set_cookie('logged', true, 86400);
				}
				//login the  user to his account
				$this->session->set_userdata($sdata);
				//redirect to home
				redirect(base_url());
		}
		}
		else
		{
			$data['title'] = 'Error: Already Logged In';
			$data['error'] = 'You are already logged in.';
			$this->load->view('error', $data);
		}
	}
	
	function Logout()
	{
		$this->session->sess_destroy();
		$this->input->set_cookie('username', 0, -1);
		$this->input->set_cookie('password', 0, -1);
		$this->input->set_cookie('logged', 0, -1);
		$this->index();
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
	
	function UpdateProfile()
	{
		$data['logged'] = $this->isLoggedIn();
		if ($data['logged'])
		{
			$this->form_validation->set_rules('first_name',  'First Name',  'required');
			$this->form_validation->set_rules('last_name',  'Last Name',  'required');
			$this->form_validation->set_rules('username',  'Username',  'required');
			$this->form_validation->set_rules('email',  'Email',  'required|valid_email');
			$this->form_validation->set_rules('password',  'Password',  'required|min_length[5]');
			$this->form_validation->set_rules('confirm_password',  'Confirm password',  'required|min_length[5]|matches[password]');
			if ($this->form_validation->run() == FALSE)
			{
				foreach ($_POST as $key => $val)
						$data[$key] = $val;
				$data['title'] = 'Update Profile';
				$this->load->view('users/update_view', $data);
			}
			else
			{
				//encrypt the password
				$fields = array('first_name', 'last_name', 'username', 'password', 'email');
				foreach ($_POST as $key => $val)
				{
					if (in_array($key, $fields))
						$dbdata[$key] = htmlspecialchars($val, ENT_QUOTES);
				}
				$_POST['password'] = sha1($_POST['password']);
				$this->users_model->UpdateUser($dbdata);
				$data['title'] = 'Successfully Edited Profile';
				$this->load->view('users/updatesuccess', $data);
				//redirect to home
				redirect(base_url());
				//redirect('users/login');
		}
		}
		else
		{
			$data['title'] = 'Error: Not Logged In';
			$data['error'] = 'You are not logged in. Please '.anchor('/users/login', 'Login', 'title="Login"').' first';
			$this->load->view('error', $data);
		}
	}
	
	// admin?
	function DeleteUser()
	{
		$data['logged'] = $this->isLoggedIn();
		if ($data['logged'])
		{
			$data['title'] = 'Delete User';
			$this->load->view('users/deleteuser_view', $data);
		}
		else
		{
			$data['title'] = 'Error: Not Logged In';
			$data['error'] = 'You are not logged in. Please '.anchor('/users/login', 'Login', 'title="Login"').' first';
			$this->load->view('error', $data);
		}
	}
	
	function ViewFarm()
	{
		$data['logged'] = $this->isLoggedIn();
		if ($data['logged'])
		{
			$data['title'] = 'Farm View';
			$this->load->view('farm/farm_view', $data);
		}
		else
		{
			$data['title'] = 'Error: Not logged in';
			$data['error'] = 'You are not logged in. Please '.anchor('/users/login', 'Login', 'title="Login"').' first';
			$this->load->view('error', $data);
		}
	}
	
	function RequestFeature()
	{
		$data['title'] = 'Request a Feature';
		$data['logged'] = $this->isLoggedIn();
		$this->form_validation->set_rules('subject',  'Subject',  'required');
		$this->form_validation->set_rules('request',  'Message',  'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['title'] = 'Request a Feature';
			$this->load->view('farm/requestfeat_view', $data);
		}
		else
		{
			$userinfo = $this->users_model->getUser($this->session->userdata('username'));
			send_email('cmckni3@lsu.edu', htmlspecialchars($_POST['subject'], ENT_QUOTES), htmlspecialchars($_POST['request']."\n\n".$userinfo['email'], ENT_QUOTES));
			send_email('ahowic1@lsu.edu', htmlspecialchars($_POST['subject'], ENT_QUOTES), htmlspecialchars($_POST['request'], ENT_QUOTES));
			$data['title'] = 'Feature Requested';
			$this->load->view('farm/successfeat_view', $data);
		}
	}
	
	// admin
	function DeleteFarm()
	{
		$data['title'] = 'Delete Farm';
		$data['logged'] = $this->isLoggedIn();
		$this->load->view('farm/deletefarm_view', $data);
	}
	
	function username_check($str)
	{
		$userinfo = $this->users_model->checkUsername($str);
		if ($userinfo == 1)
		{
			$this->form_validation->set_message('username_check', 'The %s is already taken');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function email_check($str)
	{
		$userinfo = $this->users_model->checkEmail($str);
		if ($userinfo == 1)
		{
			$this->form_validation->set_message('email_check', 'The %s is already taken');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function index()
	{
		redirect(base_url());
	}
}
?>