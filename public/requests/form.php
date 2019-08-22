<?php
require_once __DIR__ . '/autoload.php';

if(isset($_POST['code'])){
	try{
		(new App\Core\Code)->insertCode($_POST['code_title'], $_POST['code_block'], $_POST['code_section']);
		echo trim($_POST['code']);
	}catch(Exception $e){
		echo $e->getMessage();
	}
	//$code = (new App\Core\Code)->insertCode($code_title, $code_block, $code_section);
	
}


$code = (new App\Core\Code)->insertCode($taskName=null, $startDate=null, $code_section=null);