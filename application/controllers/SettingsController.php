<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * class  : UsersController
 * explain: This class is controller for login, register, manage users.
 * Author : Kevin Lee
 * Date   : 06/Jun/2019
 */

class SettingsController extends CI_Controller {
  
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model('settings');
        $this->load->helper('url');
    }

    // Actions of this controller
    public function index()
    {
        if (empty($this->session->userdata('username')))
            redirect('user/logout');
        else {
            $data['realname'] = $this->session->userdata('realname');
            $data['permission'] = $this->session->userdata('permission');
            $data['page'] = "settings";
            $setting['settingInfo'] = $this->settings->getData();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('settings/index', $setting);
            $this->load->view('templates/footer');
        }
    }

    // methods for ajax
    public function changeData() 
    {
        $data['error'] = "success";
        $this->settings->changeData($_POST);
        echo json_encode($data);
    }
}
