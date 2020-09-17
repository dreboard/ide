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
     * Call the API
     * @param $method
     * @param $url
     * @param $data
     * @return array|bool
     */
    public static function callAPI(string $method, string $url, $data){

        try{
            switch ($method){
                case "POST":
                case "PUT":
                $result = self::sendPostRequest($url, $data);
                    break;
                case "GET":
                    $result = self::sendGetRequest($url, $data);
                    break;
                default:
                    if ($data)
                        $url = sprintf("%s?%s", $url, http_build_query($data));
            }

            return $result;
        }catch (Throwable $e){
            error_log($e->getMessage());
            return 'Api call not made';
        }

    }

    /**
     * Send GET request
     * @param $url
     * @param $data
     * @return array|bool
     */
    public static function sendGetRequest($url, $data)
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            $result = curl_exec($ch);

            if(curl_errno($ch)){
                error_log('Request Error:' . curl_error($ch));
            }
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (in_array($http_status, range(400, 599))){
                return self::checkResponse($http_status);
            }

            curl_close($ch);
            return $result;
        }catch (Throwable $e){

        }

    }



    /**
     * Send POST request
     * @param $method
     * @param $url
     * @param $data
     * @return array|bool
     */
    public static function sendPostRequest($url, $data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        if ($data){
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'APIKEY: 111111111111111111111',
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

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
     * Log error message for 400 and 500 errors
     * @param $http_status
     * @return array|bool
     */
    public static function checkResponse($http_status)
    {
        switch ($http_status){
            case "404":
                error_log('Check API server logs, client page not found');
                return ['error' => 'Method not allowed'];
                break;
            case "405":
                return ['error' => 'Method not allowed'];
                break;
            case "500":
            case "502":
            case "503":
                error_log('Check API server logs, client has a 500 error');
                return ['error' => 'Server error'];
                break;
            default:
                error_log('Check API server logs, '.$http_status.' error');
                return ['error' => $http_status.' error'];
                break;
        }
    }

}
