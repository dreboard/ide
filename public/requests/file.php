<?php
require_once __DIR__ . '/autoload.php';
if (isset($_POST['newFile'])) {
    try {
        $query = filter_input(INPUT_POST, 'newFile', FILTER_SANITIZE_SPECIAL_CHARS);
        $code = (new App\Core\Files)->findAll('file');
        echo json_encode($code);
        //$code = (new App\Core\Fies)->create($_POST['code_id']);
        //echo json_encode(['code' => $code]);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    //$code = (new App\Core\Code)->insertCode($code_title, $code_block, $code_section);
}
if (isset($_POST['loadFile'])) {
    try {
        $file = filter_input(INPUT_POST, 'loadFile', FILTER_SANITIZE_SPECIAL_CHARS);
        $code = (new App\Core\Files)->loadFile($file);
        echo json_encode(['code' => $code]);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    //$code = (new App\Core\Code)->insertCode($code_title, $code_block, $code_section);
}
if(isset($_GET['get_all'])){
    try{
        $files = (new App\Core\Files)->findAll('file');
        echo json_encode(['files' => $files]);
    }catch(Exception $e){
        echo $e->getMessage();
    }
}

if(isset($_FILES['loadFile']['tmp_name'])){
    try{
        echo(file_get_contents($_FILES['loadFile']['tmp_name']));
    }catch(Exception $e){
        echo $e->getMessage();
    }
}