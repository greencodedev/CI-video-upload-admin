<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * class  : UsersController
 * explain: This class is controller for login, register, manage users.
 * Author : Kevin Lee
 * Date   : 06/Jun/2019
 */
class UsersController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model('users');
        $this->load->helper('url');
    }

    // Actions of this controller
	public function index()
	{        
        $this->load->view('users/login');
    }

    public function userInfos() 
    {
        if (empty($this->session->userdata('username')))
            redirect('user/logout');
        else 
        {
            $data['realname'] = $this->session->userdata('realname');
            $data['page'] = "manage_user";
            $data['permission'] = $this->session->userdata('permission');
            $users['userinfos'] = $this->getAllUserInfo(); 
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('users/userinfos', $users);
            $this->load->view('templates/footer');
        }
    }

    public function logout() 
    {
        $array_items = array('id', 'username', 'realname', 'password', 'email');
        $this->session->unset_userdata($array_items);
        redirect("");
    }

    // methods for ajax
    public function login()
    {
        $data['error'] = "failed";
        $userinfo = $this->users->login($_POST['username'], $_POST['password']);
        if ($userinfo['error'] == false) {           /// if login is succeeded...
            $this->session->set_userdata($userinfo);
            $data['permission'] = $userinfo['permission'];
            $data['error'] = "success";
        }
        echo json_encode($data);
    }   

    public function register() 
    {
        $data['error'] = $this->users->addUserInfo($_POST);
        echo json_encode($data);
    }

    public function changePermission() 
    {
        $data['error'] = $this->users->changeUserPermission($_POST['user_id'], $_POST['permission']);
        echo json_encode($data);
    }

    public function deleteUser()
    {
        $id = $_POST['user_id'];
        $data['error'] = $this->users->deleteUserInfo($id);
        echo json_encode($data);
    }

    // functions for process
    private function getAllUserInfo() 
    {
        return $this->users->getAllInfos($this->session->userdata['user_id']);
    }
}
