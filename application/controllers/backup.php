<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->dbutil();
    }

    public function database_backup() {
        $prefs = array(
            'format' => 'zip',
            'filename' => 'dbSikosipi.sql'
        );

        $backup = $this->dbutil->backup($prefs);
        $db_name = 'backup-on-' . date("Y-m-d-H-i-s") . '.zip';
        $save = 'C:/backup/' . $db_name;

        $this->load->helper('file');
        write_file($save, $backup);

        echo "Database backup completed: " . $save;
    }
}
