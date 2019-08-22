<?php
require_once __DIR__ . '/autoload.php';

if(isset($_POST['code_title'])){
	try{
		(new App\Core\Code)->insertCode($_POST['code_title'], $_POST['code_block'], $_POST['code_section']);
		echo $_POST['code_title'].' Saved';
	}catch(Exception $e){
		echo json_encode(array(
			'error' => true,
			'reason'  => $e->getMessage(),
		));
	}
}