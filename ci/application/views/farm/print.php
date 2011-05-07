<?php
$this->load->view('header');

// pass the data array from controller with what you want $maps to print out
// by doing $data['maps'] = ...
// then call $this->load->view('print', $data); in the controller
echo $maps;

$this->load->view('footer');
?>