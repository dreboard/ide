<?php

use App\Core\Api;

require_once __DIR__ . '/autoload.php';

//var_dump(file_get_contents('php://input'));
//$output = var_export($_REQUEST, true);
//error_log($output, 0, "request.log");

$rawData = file_get_contents("php://input");
$post = json_decode($rawData, true);
//echo file_get_contents("php://input");

if(isset($post['uri']) || isset($_POST['uri'])){
    //echo 'Request';
    $url = $post['uri'] ?? filter_var($_POST['uri'], FILTER_VALIDATE_URL);
    $method = $post['request_method'] ?? filter_var($_POST['request_method'], FILTER_SANITIZE_STRING);
    $data = $post['postData'] ?? filter_var($_POST['postData'], FILTER_SANITIZE_STRING);
    var_dump($method, $url, $data);die;
    echo Api::callAPI($method, $url, $data);
    //echo \App\Core\Api::processPost($query, $data); // file_get_contents("php://input"); //$query; //
}

