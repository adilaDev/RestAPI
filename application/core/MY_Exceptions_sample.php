<?php

class MY_Exceptions extends CI_Exceptions
{
    public function show_exception($exception)
    {
        // Set header JSON
        header('Content-Type: application/json');

        $response = [
            'code'    => 500,
            'status'  => 'error',
            'message' => $exception->getMessage(),
            'trace'   => $exception->getTrace(),
            'traceStr'   => $exception->getTraceAsString(),
            // 'error' => $exception->getError(),
        ];

        // echo json_encode($response);
        echo json_encode($response, JSON_PRETTY_PRINT);
        exit; // Pastikan untuk menghentikan eksekusi
    }

    public function show_error($heading, $message, $template = 'error_general', $status_code = 500)
    {
        header('Content-Type: application/json');

        $response = [
            'code'    => $status_code,
            'status'  => 'error',
            'message_1' => strip_tags($message),
            'message' => is_array($message) ? implode(' ', $message) : $message,
        ];

        // echo json_encode($response);
        echo json_encode($response, JSON_PRETTY_PRINT);
        exit;
    }

    public function show_404($page = '', $log_error = TRUE)
    {
        header('Content-Type: application/json');

        $response = [
            'code'    => 404,
            'status'  => 'error',
            // 'message' => 'Page not found: ' . $page,
            'message' => 'The page you requested was not found: ' . $page,
        ];

        // echo json_encode($response);
        echo json_encode($response, JSON_PRETTY_PRINT);
        exit;
    }
}
