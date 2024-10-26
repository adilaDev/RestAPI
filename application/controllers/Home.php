<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public $lang;
	public $db;
	public $config;
	public $session;
	public $input;
	public $output;
	public $email;
	public $form_validation;

	public function __construct() {
		parent::__construct();
		// Load Session Library
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('url', 'form');
		$this->load->helper('language');
		$this->load->database();
	}

	public function index()
	{
		$judul = array("judul" => "Documentation");
		$this->load->view('layouts/navbar', $judul);
		$this->load->view('home/welcome_message');
		$this->load->view('layouts/footer');
	}
	
	public function api_example(){
		$judul = array("judul" => "API Example");
		$this->load->view('layouts/navbar', $judul);
		$this->load->view('home/api_example');
		$this->load->view('layouts/footer');
	}
	
	public function role(){
		$judul = array("judul" => "Role");
		$this->load->view('layouts/navbar', $judul);
		$this->load->view('home/role');
		$this->load->view('layouts/footer');
	}
}
