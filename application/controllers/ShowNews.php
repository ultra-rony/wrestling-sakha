<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Service.php");

class ShowNews extends Service {

    public function getNews($page)
    {
        $data = $this->getData();
        $data['response'] = $this->sup->getResponse(true);
        $data['response']['news'] = $this->news->get($page);
        print(json_encode($data['response']));
    }

    public function getFullNews($id)
    {
        $data = $this->getData();
        $data['response'] = $this->sup->getResponse(true);
        $data['response']['full_news'] = $this->news->getFull($id);
        print(json_encode($data['response']));
    }

}