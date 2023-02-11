<?php

/**
 * Модель помощник
 */
class Support extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
    }
    // CORS
    public function onSetting()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept");
	}

    public function getResponse($resp = false)
    {
        header("Content-Type: application/json");
        return array(
            'auth' => $resp,
            'message' => $this->getMessage($resp),
            'error' => $this->getErrorMessage($resp),
            'current_time' => $this->getCurrentDateTime(),
            'time_zone' => date_default_timezone_get(),
            'time_format' => "+09:00"
        );
    }
    
	public function getCurrentDateTime()
	{
		// time zone
        # add your city to set local time zone
        date_default_timezone_set('Asia/Yakutsk');
		$now = date('Y-m-d H:i:s');
		return $now;
	}

    public function getMessage($resp)
    {
        if ($resp == true) {
			return "Successful connection";
		}
		return "Wrong token or wrong request";
    }

    public function getErrorMessage($resp)
    {
        if ($resp == true) {
			return "SUCCESS_TOKEN";
		}
		return "INVALID_TOKEN";
    }
    
    public function getQuery($request)
    {
        return $this->input->get($request, true);
    }

    public function getQueryPost($request)
    {
        return $this->input->post($request, true);
    }
    // Сортировка массива по date_time asc
    // Пример вызова $this->support->getSortDateTime($array, 'time');
    public function getSortDateTime(&$array, $column, $direction = SORT_ASC) {
        $reference_array = array();
        foreach($array as $key => $row) {
            $reference_array[$key] = $row['data'][$column];
        }
        array_multisort($reference_array, $direction, $array);
    }

    public function getGenerationToken($length = 73)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
    }
    // Удаление дубликатов
    public function getRemoveDuplicates($arr)
    {
        $elCounts = array_count_values($arr);
        $result = array();
        for ($i = 0; $i < count($arr); ++$i) {
            foreach ($elCounts as $k => $v) {
                if ($arr[$i] == $k && $v == 1) {
                    $result[] = $arr[$i];
                    break;
                }
            }
        }
        return $result;
    }

}