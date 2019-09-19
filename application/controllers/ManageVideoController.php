<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * class  : UsersController
 * explain: This class is controller for login, register, manage users.
 * Author : Kevin Lee
 * Date   : 06/Jun/2019
 */

class ManageVideoController extends CI_Controller {
  
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model('videos');
        $this->load->model('settings');
        $this->load->helper('url');
        $this->load->library('ftp');
    }

    // Actions of this controller
    public function index()
    {
        if (empty($this->session->userdata('username')))
            redirect('user/logout');
        else {
            $data['realname'] = $this->session->userdata('realname');
            $data['permission'] = $this->session->userdata('permission');
            $data['page'] = "upload_page";
            $settings = $this->settings->getData();
            $data['server_url'] = $settings['ftp_hostname'];
            if ($this->session->userdata['permission'] == 2) 
                $videos['videoInfos'] = $this->getAllVideos();
            else 
                $videos['videoInfos'] = $this->getMyVideos($this->session->userdata('user_id'));
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('video/allvideos', $videos);
            $this->load->view('templates/footer');
        }
    }

    public function upload() 
    {
        if (empty($this->session->userdata('username')))
            redirect('user/logout');
        else {
            $data['realname'] = $this->session->userdata('realname');
            $data['permission'] = $this->session->userdata('permission');
            $data['page'] = "upload_page";
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('video/upload');
            $this->load->view('templates/footer');
        }
    }

    // methods for ajax
    public function deleteVideo() 
    {
        $error = "success";
        $video_id = $_POST['id'];
        $data = $this->videos->delVideo($video_id);
        if ($data != false)
        {
            $this->deleteFileFTP($data);
            $error = "success";
        }
        else 
        {
            $error = "failed";
        }
        echo $error;
    }

    public function changeVideoInfo() 
    {
        $data['error'] = true;
        
    }

    public function changeData()
    {
        if ($this->videos->editInfos($_POST))
        {
            echo "success";
        }
        else 
        {
            echo "failed";
        }
    }

    // private functions
    private function getAllVideos()
    {
        return $this->videos->getAllVideos();
    }

    private function getMyVideos($id) 
    {
        return $this->videos->getMyVideos($id);
    }

    private function deleteFileFTP($fileName)
    {
        $settings = $this->settings->getData();
        //FTP configuration
        $ftp_config['hostname'] = $settings['ftp_hostname']; 
        $ftp_config['username'] = $settings['ftp_username'];
        $ftp_config['password'] = $settings['ftp_password'];
        $ftp_config['debug']    = TRUE;

        $this->ftp->connect($ftp_config);
        
        //File upload path of remote server
        $destination = $settings['upload_path']."/".$fileName;
        $this->ftp->delete_file($destination);
        
        //Close FTP connection
        $this->ftp->close();
    }
}


