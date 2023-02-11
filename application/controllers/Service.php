<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('support', 'sup');
        $this->load->model('news');
    }

    public function getData()
    {
        $data = $this->sup->getResponse(false);
        $receive = file_get_contents('php://input');
        $s = json_decode($receive, true);
        $dt = array(
            'add_news' => array(
                'id' => null,
                'title' => $s['title'] ?? null,
                'description' => $s['description'] ?? null,
                'images' => $s['images'] ?? null,
                'date_added' => $data['current_time'],
                'status' => 1,
                'link' => $s['link'] ?? null
            ),
        );
        return array(
            'response' => $data,
            'dt' => $dt
        );
    }

}