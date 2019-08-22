<?php
require_once __DIR__ . '/autoload.php';

//var_dump(file_get_contents('php://input'));
//$output = var_export($_REQUEST, true);
//error_log($output, 0, "request.log");

$rawData = file_get_contents("php://input");
$post = json_decode($rawData, true);
echo file_get_contents("php://input");

if(isset($post['test']) || isset($_POST['test'])){
    $query = filter_input(INPUT_POST, 'test', FILTER_SANITIZE_SPECIAL_CHARS) ?? filter_var($post['test'], FILTER_SANITIZE_NUMBER_INT);
    echo $query; //file_get_contents("php://input");
}

if(isset($post['code_id']) || isset($_POST['code_id'])){
    try{
        //header("Access-Control-Allow-Origin: *");//this allows coors
        //header('Content-Type: application/json');
        $query = filter_input(INPUT_POST, 'code_id', FILTER_SANITIZE_SPECIAL_CHARS) ?? filter_var($post['code_id'], FILTER_SANITIZE_NUMBER_INT);
        //$query = filter_var($post['code_id'], FILTER_SANITIZE_NUMBER_INT);
        $code = (new App\Core\Code)->find($query);

        error_log(json_encode($code));die;

        echo json_encode($code); //json_encode(['code' =>$code]);

    }catch(Exception $e){
        echo $e->getMessage();
    }
    //$code = (new App\Core\Code)->insertCode($code_title, $code_block, $code_section);
}

if(isset($_GET['get_all'])){
    //var_dump($_GET['get_all']);die;
    try{
        $section = filter_input(INPUT_GET, 'get_all', FILTER_SANITIZE_SPECIAL_CHARS);
        $code = (new App\Core\Code)->findAll($section);
        echo json_encode($code);
    }catch(Exception $e){
        echo $e->getMessage();
    }
}


if(isset($_POST['delete_id'])){
    try{
        $delete_id = filter_input(INPUT_POST, 'delete_id', FILTER_SANITIZE_SPECIAL_CHARS);
        $code = (new App\Core\Code)->delete($delete_id);
        echo $delete_id.' ID Deleted';
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
