<?php

class Api_model extends CI_Model
{
    private $db_instance;
    private $allowed_ips = ['127.0.0.1', '192.168.1.7', '110.138.91.114']; // IP yang diizinkan akses POST

    public function __construct($db = null)
    {
        parent::__construct();
        // $this->db_instance = $db ?? $this->db;
        $this->db_instance = $this->loadDatabase($db) ?? $this->db;

        if (!$this->db_instance) {
            throw new Exception('Database instance is not initialized.');
        }
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
            // 'db_debug' => FALSE,
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

    // Fungsi untuk menghitung total baris data
    private function get_total_rows($db, $table)
    {
        return $this->db_instance->count_all($table);
    }

    public function get_public_ip()
    {
        // Menggunakan file_get_contents untuk memanggil API
        $ip = file_get_contents('https://api.ipify.org');
        // $ip = file_get_contents('https://ifconfig.me/ip');
        // $ip = json_decode(file_get_contents('https://ipinfo.io/json'));

        // Atau menggunakan cURL
        /*
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.ipify.org');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $ip = curl_exec($ch);
        curl_close($ch);
        */

        return $ip; // Mengembalikan alamat IP publik
    }

    public function getIpUser(){
        // Mendapatkan alamat IP pengguna
        $user_ip = $this->input->ip_address();
        if ($user_ip === '::1') {
            // Jika IP adalah ::1, ganti dengan 127.0.0.1
            $user_ip = '127.0.0.1';
        }
        return $user_ip;
    }

    public function checkIp(){

        // Mendapatkan alamat IP pengguna
        $user_ip = $this->input->ip_address();
        $public_ip = $this->get_public_ip();
        // Jika IP adalah ::1, ganti dengan 127.0.0.1
        if ($user_ip === '::1') {
            $user_ip = '127.0.0.1';
        }

        $get_ip = new stdClass();
        $get_ip->ip_valid = false;
        $get_ip->ip_private = $user_ip;
        $get_ip->ip_public = $public_ip;
        $get_ip->allowed_ips = $this->allowed_ips;
        
        // Memeriksa apakah IP pengguna termasuk dalam daftar yang diizinkan
        if (!in_array($public_ip, $this->allowed_ips)) {
            return "Unauthorized IP Public address.";
        } else if (!in_array($user_ip, $this->allowed_ips)) {
            return "Unauthorized IP Private address.";
        } else {
            $get_ip->ip_valid = true;
            return $get_ip;
            // return true;
        }
    }

    public function list_databases()
    {
        // This query might vary based on your DBMS. 
        // For MySQL, you can use:
        $query = $this->db_instance->query('SHOW DATABASES');
        $all_db = [];
        foreach ($query->result() as $item) {
            $get_db = $item->Database;
            array_push($all_db, $get_db);
        }
        // return $query->result();
        return $all_db;
    }

    public function list_tables($db_name)
    {
        $this->db_instance = $this->loadDatabase($db_name);
        // This query might vary based on your DBMS.
        // For MySQL, you can use:
        $query = $this->db_instance->query('SHOW TABLES');
        $callback = new stdClass();
        $callback->db_name = $db_name;
        $callback->check_ip_user = $this->checkIp();
        $callback->tb_name = array();

        foreach ($query->result() as $value) {
            $name = $value->{'Tables_in_' . $db_name}; // Mengakses kolom secara dinamis
            array_push($callback->tb_name, $name);
        }
        // return $query->result();
        return $callback;
    }

    public function get_data($db_name, $table)
    {
        $this->db_instance = $this->loadDatabase($db_name);
        $limit = (int) $this->input->get('limit') ?: 100;  // Batas data per halaman (default 100)
        $offset = (int) $this->input->get('offset') ?: 0;  // Mulai dari data ke berapa

        $query = $this->db_instance->limit($limit, $offset)->get($table);
        $data = $query->result();
        // return $this->db_instance->get($table)->result();
        $callback = new stdClass();
        $callback->total_all_data = $this->get_total_rows($db_name, $table);
        $callback->data_limit = $limit;
        $callback->starting_from = ($offset === 0) ? 1 : $offset+1;
        $callback->result = $data;
        // $callback = [
        //     'data' => $data,
        //     'total' => $this->get_total_rows($db_name, $table),
        //     'limit' => $limit,
        //     'offset' => $offset,
        // ];
        return $callback;
        // return $data;
    }
    
    public function filter_data($db_name, $table, $filters)
    {
        if (empty($filters)) {
            throw new Exception('Filters cannot be empty.');
            return null;
        }

        try {
            $this->db_instance = $this->loadDatabase($db_name);
            $limit = (int) $this->input->get('limit') ?: 100;  // Batas data per halaman (default 100)
            $offset = (int) $this->input->get('offset') ?: 0;  // Mulai dari data ke berapa
            
            $query = $this->db_instance->limit($limit, $offset)->get_where($table, $filters);
            $data = $query->result();
            $total_all = $this->db_instance->get_where($table, $filters)->num_rows();
            
            $callback = new stdClass();
            $callback->total_all_data = $total_all;
            $callback->data_limit = $limit;
            $callback->starting_from = ($offset === 0) ? 1 : $offset + 1;
            $callback->filters = $filters;
            $callback->result = $data;
            return $callback;
            // return $this->db_instance->get_where($table, $filters)->result();
        } catch (Exception $e) {
            // Tangkap error dan kembalikan dalam format JSON
            return [
                'code'    => 500,
                'status'  => 'error',
                'message' => $e->getMessage(),
                'trace'   => $e->getTrace(), // Berikan trace error lengkap
                'traceStr'   => $e->getTraceAsString(), // Berikan trace error lengkap
            ];
        }
    }
    
    public function search_data($db_name, $table, $keyword)
    {
        if (empty($keyword)) {
            throw new Exception('Keyword cannot be empty.');
        }

        // $this->db_instance = $this->loadDatabase($db_name);
        // $this->db_instance->like($name, $keyword);
        // return $this->db_instance->get($table)->result();

        $this->db_instance = $this->loadDatabase($db_name);
        $limit = (int) $this->input->get('limit') ?: 100;  // Batas data per halaman (default 100)
        $offset = (int) $this->input->get('offset') ?: 0;  // Mulai dari data ke berapa

        // Apply multi-field LIKE search
        foreach ($keyword as $field => $value) {
            $this->db_instance->like($field,
                $value
            );
        }

        // Get the limited results with pagination
        $query = $this->db_instance->limit($limit, $offset)->get($table);
        $data = $query->result();

        // Get the total number of matching records
        foreach ($keyword as $field => $value) {
            $this->db_instance->like($field, $value);
        }
        $total_all = $this->db_instance->count_all_results($table);

        // Prepare response data
        $callback = new stdClass();
        $callback->total_all_data = $total_all;
        $callback->data_limit = $limit;
        $callback->starting_from = ($offset === 0) ? 1 : $offset + 1;
        $callback->keyword = $keyword;
        $callback->result = $data;
        return $callback;
    }
    
    public function insert_data($db_name, $table, $data)
    {
        $this->db_instance = $this->loadDatabase($db_name);
        $this->db_instance->insert($table, $data);
        return $this->db_instance->affected_rows();
    }
    
    public function update_data($db_name, $table, $data)
    {
        if (!isset($data['id'])) {
            throw new Exception('ID is required for update.');
        }
        
        $this->db_instance = $this->loadDatabase($db_name);
        $this->db_instance->update($table, $data, ['id' => $data['id']]);
        return $this->db_instance->affected_rows();
    }
    
    public function delete_data($db_name, $table, $id)
    {
        $this->db_instance = $this->loadDatabase($db_name);
        $this->db_instance->delete($table, ['id' => $id]);
        return $this->db_instance->affected_rows();
    }
}
