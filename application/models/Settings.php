<?php

class Settings extends CI_Model {
    public $table = "settings";

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function changeData($data)
    {
        $update_data = array(
            'upload_path' => $data['upload_path'],
            'ftp_hostname' => $data['ftp_server'],
            'ftp_username' => $data['ftp_username'],
            'ftp_password' => $data['ftp_password']
        );
        if ($this->isEmpty())
            $this->db->insert('settings', $update_data);
        else {
            $this->db->where('id', 1);
            $this->db->update('settings', $update_data);
        }
    }

    public function getData() 
    {
        if (count($this->db->get('settings')->result()) == 0)
            return array(
                'upload_path' => "",
                'ftp_hostname' => "",
                'ftp_username' => "",
                'ftp_password' => ""
            );
        else {
            $data = $this->db->get('settings')->result_array();
            return $data[0];
        }
    }

    private function isEmpty()
    {
        if (count($this->db->get('settings')->result()) == 0)
            return true;
        else 
            return false;
    }
}