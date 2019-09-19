<?php

class Videos extends CI_Model {
    public $table = "videos";

    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllVideos()
    {
        $this->db->order_by('uploaded_date', 'ASC');
        return $this->db->get('videos')->result();
    }

    public function getMyVideos($id)
    {
        $this->db->where('uploader_id', $id);
        return $this->db->get('videos')->result();
    }

    public function delVideo($video_id) 
    {
        if ($this->getVideoInfo($video_id)) 
        {
            $this->db->where('id', $video_id);
            $this->db->select('uploaded_filename');
            $filename = $this->db->get('videos')->result();
            $this->db->where('id', $video_id);
            $this->db->delete('videos');
            return $filename[0]->uploaded_filename;
        } 
        else 
        {
            return false;
        }
    }

    public function uploadVideo($data)
    {
        $data = array(
            'origin_filename' => $data['origin'],
            'uploaded_filename' => $data['upload'],
            // 'contents' => $data['contents'],
            'copy_url' => $data['path'],
            'uploader_id' => $data['uploader']
        );
        $this->db->insert('videos', $data);
        return true;
    }

    public function editInfos($data) 
    {
        $data_update = array(
            'contents' => $data['contents'],
            'origin_filename' => $data['origin']
        );
        $this->db->where('id', $data['id']);
        $this->db->update('videos', $data_update);
        return true;
    }

    private function getVideoInfo($id) 
    {
        $this->db->where('id', $id);
        $result = $this->db->get('videos')->result();
        if (count($result) == 0)
            return false;
        else 
            return true;
    }
}