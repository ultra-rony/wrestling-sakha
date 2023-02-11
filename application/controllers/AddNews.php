<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Service.php");

class AddNews extends Service {

    public function index()
    {
        $data = $this->getData();

        $resp = $this->news->add($data['dt']['add_news']);
        if ((int)$resp != null) {
            $data['response'] = $this->sup->getResponse(true);
        }
        print(json_encode($data['response']));
    }

}