<?php 
	require_once('../conexion/conexion.php');

	$iditem = isset($_GET['item_id']) ? $_GET['item_id']: 0;
	$variables = 'DELETE FROM item WHERE item_id = ?';

	$statement = $pdo->prepare($variables);
	$statement->execute(array($iditem));

	$results = $statement->fetchAll();
	header('Location: eliminar-editar-itm.php');
 ?>