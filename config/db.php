<?php

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
	//dropTbl($pdo);
	//insertMsg($messages, $pdo);
	 
    $result = $pdo->query('SELECT * FROM code');
 
    foreach($result as $row) {
      echo "Id: " . $row['code_title'] . "";
      echo "Title: " . $row['code_block'] . "\n";
      echo "Message: " . $row['code_section'] . "\n";
      echo "Time: " . $row['code_date'] . "\n";
      echo "<br>";
    }	
	
}catch(PDOException $e){
	error_log( $e->getMessage() );
	echo $e->getMessage();
}