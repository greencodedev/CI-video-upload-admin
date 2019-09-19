<?php 

class Users extends CI_Model {
    public $table = "users";

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function login($username, $password)
    {
        $data['error'] = true;
        $user = $this->db->get_where('users', array('username' => $username));
        foreach ($user->result() as $row)
        {
            if ($row->password == md5($password))
            {
                $data['error'] = false;
                $data['username'] = $row->username;
                $data['realname'] = $row->realname;
                $data['user_id'] = $row->id;
                $data['permission'] = $row->permission;
                return $data;
            }
        }
        return $data;
    }

    public function addUserInfo($data) 
    {
        $insertData = array(
            'username'=> $data['username'],
            'realname'=> $data['realname'],
            'password'=> md5($data['password']),
            'address' => $data['address'],
            'phonenum'=> $data['phonenum'],
            'email'=> $data['email'],
            'permission'=> 0
        );
        $this->db->insert('users', $insertData);
        return "success";
    }

    public function changeUserPermission($user_id, $permission)
    {
        if ($this->getUserInfo($user_id)) 
        {
            $data = array(
                'permission' => $permission
            );
            $this->db->where('id', $user_id);
            $this->db->update('users', $data);
            return "success";
        } 
        else 
        {
            return "failed";
        }
    }

    public function getAllInfos($id) 
    {
        $this->db->where('id !=', $id);
        return $this->db->get('users')->result();
    }

    public function deleteUserInfo($id)
    {
        if ($this->getUserInfo($id)) 
        {
            $this->db->where('id', $id);
            $this->db->delete('users');
            return "success";
        } 
        else 
        {
            return "failed";
        }
    }

    private function getUserInfo($id) 
    {
        $this->db->where('id', $id);
        $result = $this->db->get('users')->result();
        if (count($result) == 0)
            return false;
        else 
            return true;
    }
}