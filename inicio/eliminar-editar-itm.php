<?php 
	require_once('../conexion/conexion.php');

	if($_POST)
	{
	  	$modificar = 'UPDATE item SET item_id = ?, cantidad = ?, comprado_comprado_id = ?, pedido_pedido_id = ?, fabricado_fabricado_id = ? WHERE item_id = ?';

		$iditem = isset($_GET['item_id']) ? $_GET['item_id']: '';
		$iditem_2 = isset($_POST['item_id_2']) ? $_POST['item_id_2']: '';
  		$canditad = isset($_POST['cantidad']) ? $_POST['cantidad']: '';
  		$compra = isset($_POST['comprado_comprado_id']) ? $_POST['comprado_comprado_id']: '';
  		$pedi= isset($_POST['pedido_pedido_id']) ? $_POST['pedido_pedido_id']: '';
  		$fabric= isset($_POST['fabricado_fabricado_id']) ? $_POST['fabricado_fabricado_id']: '';
  		
	  	$statement_update_details = $pdo->prepare($modificar);
	  	$statement_update_details->execute(array($iditem_2,$canditad,$compra,$pedi,$fabric,$iditem));
	  	header('Location: eliminar-editar-itm.php');
	}

	if($_GET['item_id']){

		$show_form = TRUE;

		$cun = 'SELECT item.*,comprado.nombre,fabricado.nombres,pedido.fecha_pedido from item INNER JOIN comprado ON comprado.comprado_id = item.comprado_comprado_id INNER JOIN fabricado ON fabricado.fabricado_id = item.fabricado_fabricado_id INNER JOIN pedido ON pedido.pedido_id = item.pedido_pedido_id WHERE item_id = ?';
		$CHE = isset($_GET['item_id']) ? $_GET['item_id']: 0;

		$statement_update = $pdo->prepare($cun);
		$statement_update->execute(array($CHE));
		$result_details = $statement_update->fetchAll();
		$rv = $result_details[0];
	}
 ?>

 <?php 
$itemss = 'SELECT * FROM comprado';

	$statement = $pdo->prepare($itemss);
	$statement->execute();
	$results_comprado = $statement->fetchAll();



	$item = 'SELECT * FROM pedido';

	$statement = $pdo->prepare($item);
	$statement->execute();
	$results_pedido = $statement->fetchAll();



	$itemssss = 'SELECT * FROM fabricado';

	$statement = $pdo->prepare($itemssss);
	$statement->execute();
	$results_frabricado = $statement->fetchAll();


  ?>

	<?php 
	$contador = 'SELECT item.*,comprado.nombre,fabricado.nombres,pedido.fecha_pedido from item INNER JOIN comprado ON comprado.comprado_id = item.comprado_comprado_id INNER JOIN fabricado ON fabricado.fabricado_id = item.fabricado_fabricado_id INNER JOIN pedido ON pedido.pedido_id = item.pedido_pedido_id';

	$statement = $pdo->prepare($contador);
	$statement->execute();
	$results_item = $statement->fetchAll();
	 ?>

 <?php 
	include '../extend/header.php'
?>


<div class="container">
	<div class="row">
	<form method="post">
	<div class="row">
		<h5>Modificar</h5>

		<div class="input-field col s6">
          	<input value="<?php echo $rv['item_id'] ?>" name="item_id_2" type="text">
        </div>
        <div class="input-field col s6">
          	<input value="<?php echo $rv['cantidad'] ?>" name="cantidad" type="text">
        </div>
	</div>

	<div class="row">

	<div class=" input-field col s4">
		<select name="comprado_comprado_id">
			<option value="" disabled selected>Eliga lo comprado</option>
			                	<?php 
									foreach($results_comprado as $nl) {
								?>
<option value="<?php echo $nl['comprado_id']?>" <?php $selected = ($rv['nombre'] == $nl['nombre'])?"SELECTED":""; echo $selected?>><?php echo $nl['nombre']?>	
	  						</option>
		<?php 
		   	}
		   ?>
	    </select>
		<label>Comprado</label>

	</div>

<div class=" input-field col s4">
		<select name="pedido_pedido_id">
			<option value="" disabled selected>Eliga la fecha del pedido</option>
			                	<?php 
									foreach($results_pedido as $v) {
								?>
<option value="<?php echo $v['pedido_id']?>" <?php $selected = ($rv['fecha_pedido'] == $v['fecha_pedido'])?"SELECTED":""; echo $selected?>><?php echo $v['fecha_pedido']?>	
	  						</option>
		<?php 
		   	}
		   ?>
	    </select>
		<label>Pedido</label>

	</div>


	<div class=" input-field col s4">
		<select name="fabricado_fabricado_id">
			<option value="" disabled selected>Eliga la fecha del pedido</option>
			                	<?php 
									foreach($results_frabricado as $a) {
								?>
<option value="<?php echo $a['fabricado_id']?>" <?php $selected = ($rv['nombres'] == $a['nombres'])?"SELECTED":""; echo $selected?>><?php echo $a['nombres']?>	
	  						</option>
		<?php 
		   	}
		   ?>
	    </select>
		<label>Pedido</label>

	</div>
		

	</div>
	<input class="btn waves-effect waves-light" type="submit" value="Modifcar" />
	</form>
</div>
</div>
</div>

<div class="container">
	<div  class="col s12">
		<h5>registros item</h5>
		<table class="striped">
			<thead>
				<tr>
					<th>clave</th>
					<th>Cantidad</th>
					<th>Comprado</th>
					<th>Pedido</th>
					<th>Fabricado</th>
					<th class="center" colspan="2">Opciones</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($results_item as $mv) {
				 ?>
				 <tr>
				 	<td><?php echo $mv['item_id'] ?></td>
				 	<td><?php echo $mv['cantidad'] ?></td>
				 	<td><?php echo $mv['nombre'] ?></td>
				 	<td><?php echo $mv['fecha_pedido'] ?></td>
				 	<td><?php echo $mv['nombres'] ?></td>
				 	<td class="center">
							<a class="btn waves-effect waves-light cyan lighten-1" href="eliminar-editar-itm.php?item_id=<?php echo $mv['item_id']; ?>">Editar</a>
						</td>
						<td class="center">
							<a class="btn waves-effect waves-light red" onclick="eliminar_item(<?php echo $mv['item_id']; ?>)" href="#">ELIMINAR</a>
						</td>
				 </tr>
				 <?php 
				 	}
				  ?>
			</tbody>
		</table>
	</div>
</div>




<?php 
	include '../extend/footer.php';
?>