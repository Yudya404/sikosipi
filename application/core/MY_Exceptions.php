<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show_404($page = '', $log_error = TRUE)
    {
        if (is_cli())
        {
            echo "404 Page Not Found: " . $page . PHP_EOL;
            return;
        }

        $CI =& get_instance();
        $CI->output->set_status_header('404');
        $CI->load->view('errors/html/error_404');
        echo $CI->output->get_output();
        exit(4); // EXIT_UNKNOWN_FILE
    }
}
