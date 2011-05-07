<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Helloworld extends CI_Controller
{
	function index()
	{
		$this->load->model('helloworld_model');
		
		$data['result'] = $this->helloworld_model->getData();
		$data['page_title'] = "CI Hello World App";
		
		$this->load->view('helloworld_view', $data);
	}
}
?>