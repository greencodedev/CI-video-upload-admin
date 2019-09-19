<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Upload extends CI_Controller {    
    public function __construct()
    {
        parent::__construct();        
        $this->load->helper('url');
        $this->load->model('settings');
        $this->load->model('videos');
        $this->load->library("session");        
    }

    public function index() 
    {
        $upload_path = realpath(dirname(__FILE__)."/../../")."/uploads/videos";
        if (!file_exists($upload_path)) 
        {
            mkdir($upload_path);
        }        
        if ($_FILES['files']['name'] != '') 
        {
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = "avi|mpeg|mpg|mp4";
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            for ($i = 0; $i < count($_FILES['files']['name']); $i++)
            {
                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                if ($this->upload->do_upload('file')) {
                    $upload_data = $this->upload->data();
                    // $upload_data['contents'] = $_POST['content'];
                    $this->sendFileFTP($upload_data, $upload_path);
                }
            }
        }
        

        echo "success";
    }

    public function sendFileFTP($upload_data, $upload_path) 
    {
        $fileName = $upload_data['file_name'];
        $fileext = $upload_data['file_ext'];
        $source = $upload_data['full_path'];
        $this->load->library('ftp');
        
        $settings = $this->settings->getData();
        //FTP configuration
        $ftp_config['hostname'] = $settings['ftp_hostname']; 
        $ftp_config['username'] = $settings['ftp_username'];
        $ftp_config['password'] = $settings['ftp_password'];
        $ftp_config['debug']    = TRUE;
        
        //Connect to the remote server
        $this->ftp->connect($ftp_config);
        
        //File upload path of remote server
        if (empty($this->ftp->list_files("./".$settings['upload_path']))) {   
            $this->ftp->mkdir("./".$settings['upload_path']);
        }
        $time = time();
        $destination = "./".$settings['upload_path']."/".$time.$fileext;

        $this->ftp->upload($source, $destination, 'ascii', 0775);
        
        //Close FTP connection
        $this->ftp->close();

        // save data in database
        $data = array(
            'origin' => $fileName,
            'upload' => $time.$fileext, 
            'path' => $settings['upload_path'],
            // 'contents' => $upload_data['contents'],
            'uploader' => $this->session->userdata['user_id']
        );
        $this->videos->uploadVideo($data);
    }
}