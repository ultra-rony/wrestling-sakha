<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Service.php");

class AddNews extends Service {

    public function index()
    {
        $data = $this->getData();

        if ($this->news->getKey($data['dt']['add_news']['key'])) {
            $this->news->add($data['dt']['add_news']);
            $data['response'] = $this->sup->getResponse(true);
        }
        print(json_encode($data['response']));
    }

}