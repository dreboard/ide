<?php

namespace App\Core;

use App\Core\Database;
use PDO;
use Throwable;

/**
 * Class Code
 * @package App\Core
 */
class Api
{
    /* @var Database */
    protected $db;

    protected static $uri = 'http://localhost/_PROJECTS/ide/public/requests/api.php';

    /**
     * Code constructor.
     */
    public function __construct()
    {
        $this->db = Database::instance();
        $this->uri = 'http://localhost/_PROJECTS/ide/public/requests/api.php';
    }

    public static function processPost2(string $uri, $data)
    {
        $data = array(
            'uri' => self::$uri,
            'text' => 'Hello World'
        );
        return json_encode($data);
    }

    /**
     * Process cURL URI request
     *
     * @param string $uri
     * @param array $data
     * @return
     */
    public static function processPost($uri, $data)
    {
        $result = [];
        $data = array(
            'uri' => $uri,
            'password' => '012345678'
        );
        try{
            $ch = curl_init(self::$uri);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);


            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen(json_encode($data)))
            );

            $result['body'] = curl_exec($ch);
            $result['headers'] = curl_getinfo($ch);

            curl_close($ch);
            //var_dump($uri);die;
            return json_encode($result, JSON_PRETTY_PRINT);
        } catch (Throwable $e) {
            return json_decode($e->getMessage());
        }

    }



}