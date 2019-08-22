<?php
require_once __DIR__ . '/autoload.php';

if(isset($_POST['searchTxt'])){
	$code = (new App\Core\Code)->search($_POST['searchTxt']);
	echo trim($code['code_block']);
}