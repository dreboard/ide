<?php

namespace App\Core;

use App\Core\Database;
use PDO;
use Throwable;

/**
 * Class Code
 * @package App\Core
 */
abstract class Api
{
    /* @var Database */
    protected $db;

    /**
     * @var string
     */
    protected static $uri = 'http://localhost/_PROJECTS/ide/public/requests/api.php';


    /**
     * Call an API
     * @param $method
     * @param $url
     * @param $data
     * @return array|bool
     */
    public static function callAPI($method, $url, $data){

        $curl = curl_init();

        switch ($method){
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'APIKEY: 111111111111111111111',
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        //$result = curl_exec($curl);
        $result = [];
        $result['body'] = curl_exec($curl);
        $result['headers'] = curl_getinfo($curl);

        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if (in_array($http_status, range(400, 599))){
            return self::checkResponse($http_status);
        }
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
    }

    /**
     * @param $http_status
     * @return array|bool
     */
    public static function checkResponse($http_status)
    {
        switch ($http_status){
            case "405":
                return ['error' => 'Method not allowed'];
                break;
            case "405":
                return ['error' => 'Method not allowed'];
                break;
            case "500":
                return ['error' => 'Server error'];
                break;
            default:
                return true;
        }
    }

    /**
     * @param $method
     * @param $url
     * @param $data
     * @return array|bool
     */
    public static function sendPostRequest($method, $url, $data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        if ($data){
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'APIKEY: 111111111111111111111',
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        //$result = curl_exec($curl);
        $result = [];
        $result['body'] = curl_exec($curl);
        $result['headers'] = curl_getinfo($curl);

        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if (in_array($http_status, range(400, 599))){
            return self::checkResponse($http_status);
        }
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;

    }


    /**
     * @param $url
     * @param $data
     * @return array|bool
     */
    public static function sendGetRequest($url, $data)
    {
        $curl = curl_init();
        if ($data){
            $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'APIKEY: 111111111111111111111',
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        //$result = curl_exec($curl);
        $result = [];
        $result['body'] = curl_exec($curl);
        $result['headers'] = curl_getinfo($curl);

        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if (in_array($http_status, range(400, 599))){
            return self::checkResponse($http_status);
        }
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;

    }
}