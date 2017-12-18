<?php

$dsn = 'mysql:dbname=item;host=localhost';
$user = 'root';
$password = '';

try{

	$pdo = new PDO(	$dsn, 
					$user, 
					$password
					);

}catch( PDOException $e ){
	echo 'Error al conectarnos: ' . $e->getMessage();
}
?>