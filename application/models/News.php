<?php

/**
 * 
 */
class News extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
    }

    public function add($dt)
    {
        $this->db->insert('news', $dt);
        $insertId = $this->db->insert_id();
        return  $insertId;
    }

    public function get($page)
    {
        $page = (int)$page * 10;
        return $this->db->select("n.id,n.title,n.date_added,n.images")
            ->from("news n")
            ->order_by("n.date_added", "DESC")
            ->limit(10, $page)
            ->get()
            ->result_array();
    }
    
    public function getFull($newsId)
    {
        return $this->db->select("n.id,n.title,n.date_added,n.images,n.description,n.link")
            ->from("news n")
            ->where("n.id", (int)$newsId)
            ->get()
            ->row_array();
    }
}