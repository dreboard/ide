<?php

use App\Core\Database;

if (file_exists(__DIR__.'/DEVMACHINE')){
    define("ENVIRONMENT", 'local');
} else {
    define("ENVIRONMENT", 'production');
}

define('_DEFVAR', 1);
$db = Database::instance();


try{
	$pdo = new PDO("sqlite:".__DIR__."/../db/live.sqlite");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create code table
    $sql = "CREATE TABLE IF NOT EXISTS `code` (
      `id` int(8) PRIMARY KEY,
      `code_title` varchar(70) NOT NULL,
      `code_section` VARCHAR(50) NOT NULL,
      `code_block` text NOT NULL,
      `code_date` TIMESTAMP
    )";

    if($pdo->exec($sql)){
        $sql2 = 'INSERT INTO code(code_title,code_block,code_section,code_date) '
            . 'VALUES(:code_title,:code_block,:code_section,:code_date)';

        $stmt = $pdo->prepare($sql2);
        $stmt->execute([
            ':code_title' => 'Hello World',
            ':code_block' => 'echo "Hello World";',
            ':code_section' => 'General',
            ':code_date' => time(),
        ]);

    } else {
        //echo "DB Table alredy exists";
    }


}catch(PDOException $e){
	echo $e->getMessage();
}



/*
try{
	$pdo = new PDO("sqlite:".__DIR__."/database.sqlite");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	
    // Create table messages
    $pdo->exec("CREATE TABLE IF NOT EXISTS code (
                    id INTEGER PRIMARY KEY, 
                    code_title VARCHAR(50) NOT NULL,
                    code_section VARCHAR(50) NOT NULL,
                    code_block text NOT NULL, 
                    code_date TIMESTAMP)");
	dropTbl($pdo);
	insertMsg($messages, $pdo);
	 
    $result = $pdo->query('SELECT * FROM code');
 
    foreach($result as $row) {
      echo "Id: " . $row['code_title'] . "";
      echo "Title: " . $row['code_block'] . "\n";
      echo "Message: " . $row['code_section'] . "\n";
      echo "Time: " . $row['code_date'] . "\n";
      echo "<br>";
    }
	
}catch(PDOException $e){
	echo $e->getMessage();
}*/