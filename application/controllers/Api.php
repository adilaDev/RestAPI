<?php
ini_set('memory_limit', '1G');

class Api extends CI_Controller
{
    private $allowed_ips = ['127.0.0.1', '192.168.1.7', '110.138.91.114']; // IP yang diizinkan akses POST
    public $lang;
    public $db;
    public $config;
    public $session;
    public $input;
    public $output;
    public $email;
    public $form_validation;
    
    public $encryption;
    public $auth;
    public $myAPI;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form');
        set_error_handler([$this, 'handle_error']);
    }

    private function loadDatabase($db_name)
    {
        $config = [
            'dsn'    => '',
            'hostname' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => $db_name,
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => FALSE,
            'db_debug' => (ENVIRONMENT !== 'production'),
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        ];
        return $this->load->database($config, TRUE); // Koneksi dinamis
    }

    public function index()
    {
        $type = $this->input->get('type');
        $db_name = $this->input->get('db_name');
        $tb_name = $this->input->get('tb_name');
        $db = $this->loadDatabase($db_name);
        
        try {
            $this->load->model('Api_model', 'myAPI', $db);
            
            switch ($type) {
                case 'get':
                    $data = $this->myAPI->get_data($db_name, $tb_name);
                    $this->json_response(200, 'success', $data);
                    break;

                case 'filter':
                    $filters = $this->input->get();
                    // hapus parameter yang tidak dibutuhkan, untuk metode filter
                    unset($filters['type'], $filters['db_name'], $filters['tb_name'], $filters['limit'], $filters['offset']);
                    $data = $this->myAPI->filter_data($db_name, $tb_name, $filters);
                    $this->json_response(200, 'success', $data);
                    break;

                case 'search':
                    // $keyword = $this->input->get('keyword');
                    $keyword = $this->input->get();
                    unset($keyword['type'], $keyword['db_name'], $keyword['tb_name'], $keyword['limit'], $keyword['offset']);
                    $data = $this->myAPI->search_data($db_name, $tb_name, $keyword);
                    $this->json_response(200, 'success', $data);
                    break;

                case 'insert':
                    $this->check_ip();
                    $this->check_method('POST');
                    $data = $this->input->post();
                    $this->myAPI->insert_data($db_name, $tb_name, $data);
                    $this->json_response(201, 'Data inserted successfully', $data);
                    break;

                case 'update':
                    $this->check_ip();
                    $this->check_method('PUT');
                    $data = json_decode($this->input->raw_input_stream, true);  // Mendapatkan data dari body request
                    $this->myAPI->update_data($db_name, $tb_name, $data);
                    $this->json_response(200, 'Data updated successfully', $data);
                    break;

                case 'delete':
                    $this->check_ip();
                    $this->check_method('DELETE');
                    $data = json_decode($this->input->raw_input_stream, true);  // Mendapatkan data dari body request
                    $id = $data['id'];  // Asumsi ID dikirim di dalam body request
                    $this->myAPI->delete_data($db_name, $tb_name, $id);
                    $this->json_response(200, 'Data deleted successfully', ['id' => $id]);
                    break;

                case 'list_db':
                    $databases = $this->myAPI->list_databases();
                    $this->json_response(200, 'success', $databases);
                    break;

                case 'list_tb':
                    if (empty($db_name)) {
                        $this->json_response(400, 'Database name is required for listing tables.');
                    }
                    $tables = $this->myAPI->list_tables($db_name);
                    $this->json_response(200, 'success', $tables);
                    break;

                default:
                    $this->json_response(400, 'Invalid type parameter.');
            }
        } catch (Exception $e) {
            // $this->json_response(500, 'An error occurred', $e->getMessage(), $db);
            $this->json_response(500, 'An error occurred', $e->getMessage());
        }
    }

    private function json_response($code = 200, $status, $data = null, $others = null)
    {
        $data = ['code' => $code, 'status' => $status, 'data' => $data, 'others' => $others];
        if (is_null($others)) {
            unset($data['others']); // hapus parameter others
        }

        $this->output->set_status_header($code)->set_content_type('application/json')->set_output(json_encode($data));
    }

    private function check_ip()
    {
        if (!in_array($this->input->ip_address(), $this->allowed_ips)) {
            $this->json_response(403, 'Unauthorized IP.');
            exit;
        }
    }

    private function check_method($method)
    {
        $allowed_methods = ['POST', 'PUT', 'DELETE'];
        if (!in_array($_SERVER['REQUEST_METHOD'], $allowed_methods)) {
            $this->json_response(405, 'Method Not Allowed.');
            exit;
        }
        // if ($_SERVER['REQUEST_METHOD'] !== $method) {
        //     $this->json_response(405, 'Method Not Allowed.');
        //     exit;
        // }
    }

    public function handle_error($severity, $message, $filepath, $line)
    {
        if (strpos($message, 'A Database Error Occurred') !== false) {
            $this->json_response(500, 'A Database Error Occurred', $message);
            exit;
        }
    }
}