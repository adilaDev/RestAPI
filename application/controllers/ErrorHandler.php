<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

define('CREDENTIALS_PATH', '~/php-yt-oauth2.json');

date_default_timezone_set('Asia/Jakarta');

class ErrorHandler extends CI_Controller
{

    public $lang;
    public $m_lang;
    public $db;
    public $config;
    public $session;
    public $input;
    public $output;
    public $email;
    public $form_validation;

    public function __construct()
    {
        parent::__construct();
        // load Session Library
        $this->load->library('session');
        $this->load->helper('url', 'form', 'file');
        $this->load->database();

        // $this->load->model('M_Auth');
        // $this->load->model('M_Curl', 'm_curl');
        $this->load->model('M_Lang', 'm_lang');

        // https://stackoverflow.com/questions/39486862/codeigniter-3-issue-in-changing-default-language-dynamically
        $lang = $this->session->userdata('language');
        if ($lang == "en") {
            $lang = "english";
        } else {
            $lang = "indonesia";
        }
        // ubah bahasa untuk form_validation CI
        $this->config->set_item('language', $lang);

        // jika change language blm di pilih, tampilkan default language
        $dl = $this->session->userdata('data_lang');
        if (!isset($dl) || $dl == null) {
            $this->m_lang->default_lang();
        }

        log_message('debug', 'Accessing maintenance hook!');

        // if ($this->config->item('maintenance_mode') == TRUE) {
        //     $this->output->set_status_header(503);
        //     $this->load->view('errors/v_maintenance');
        //     die();
        // }

        // if ($this->session->userdata('data_login') == '' || $this->session->userdata('data_login') == null) {
        //     $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Silahkan Login Terlebih Dahulu</div>');
        //     redirect(base_url('login'));
        // }
    }

    public function e404()
    {
        $this->output->set_status_header(404);
        $this->load->view('errors/404');
    }

    public function e500()
    {
        $this->output->set_status_header(500);
        $this->load->view('errors/500');
    }

    public function maintenance()
    {
        $this->output->set_status_header(503);
        $this->load->view('errors/v_maintenance');
    }
}
