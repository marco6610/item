<?php 
	require_once('../conexion/conexion.php');


	if( $_POST )
	{

$ejecucion_insertar = 'INSERT INTO item(item_id,cantidad,comprado_comprado_id,pedido_pedido_id,fabricado_fabricado_id) VALUES (?,?,?,?,?)';

  		$clave = isset($_POST['item_id']) ? $_POST['item_id']: '';
  		$cantidad = isset($_POST['cantidad']) ? $_POST['cantidad']: '';
  		$comprado = isset($_POST['comprado_comprado_id']) ? $_POST['comprado_comprado_id']: '';
  		$pedido = isset($_POST['pedido_pedido_id']) ? $_POST['pedido_pedido_id']: '';
  	$fabricado = isset($_POST['fabricado_fabricado_id']) ? $_POST['fabricado_fabricado_id']: '';
  		

  		$statement_insert = $pdo->prepare($ejecucion_insertar);
  		$statement_insert->execute(array($clave,$cantidad,$comprado,$pedido,$fabricado));
  		header('location insertar.php');
	}


 ?>
	
	<?php 
	$consultas_sql = 'SELECT item.*,comprado.nombre,fabricado.nombres,pedido.fecha_pedido from item INNER JOIN comprado ON comprado.comprado_id = item.comprado_comprado_id INNER JOIN fabricado ON fabricado.fabricado_id = item.fabricado_fabricado_id INNER JOIN pedido ON pedido.pedido_id = item.pedido_pedido_id WHERE item_id LIKE :search ORDER by item_id ASC';

		$search = isset($_GET['item_id'])? $_GET['item_id']: '';
		$arr[':search']= '%' . $search . '%';
		$statement = $pdo->prepare($consultas_sql);
		$statement->execute($arr);
		$resultado = $statement->fetchAll();



	$contador = 'SELECT * FROM comprado';

	$statement = $pdo->prepare($contador);
	$statement->execute();
	$results_comprado = $statement->fetchAll();



	$contador = 'SELECT * FROM pedido';

	$statement = $pdo->prepare($contador);
	$statement->execute();
	$results_pedido = $statement->fetchAll();



	$contador = 'SELECT * FROM fabricado';

	$statement = $pdo->prepare($contador);
	$statement->execute();
	$results_frabricado = $statement->fetchAll();
	 ?>

<?php 
	include '../extend/header.php'
?>
<div class="container">
			<form method="get">
      			<h2 class="card-title">Buscador</h2>
        		<div class="input-field col s12">
         		<input type="text" id="autocomplete-input" name="item_id" class="autocomplete">
         		<label for="autocomplete-input">Ingrese clave del item</label>
         			<input class="waves-effect waves-light btn cyan" type="submit" value="Buscar">
       			</div>
       		</form>
		</div>

<div class="container">
	<div class="row">
	<form method="post">
	<div class="row">
		<h5>Agrerar nuevo item</h5>

		<div class="input-field col s6">
          	<input placeholder="Clave del item" name="item_id" type="text">
        </div>
        <div class="input-field col s6">
          	<input placeholder="Cantidad" name="cantidad" type="text">
        </div>
	</div>

	<div class="row">
	<div class=" input-field col s4">
		<select name="comprado_comprado_id">
			<option value="" disabled selected>Eliga lo comprado</option>
			                	<?php 
									foreach($results_comprado as $n) {
								?>
		<option value="<?php echo $n['comprado_id']?>"><?php echo $n['nombre']?>	
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
		<option value="<?php echo $v['pedido_id']?>"><?php echo $v['fecha_pedido']?>	
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
		<option value="<?php echo $a['fabricado_id']?>"><?php echo $a['nombres']?>	
	  	</option>
		<?php 
		   	}
		   ?>
	    </select>
		<label>Pedido</label>

	</div>
		

	</div>
	<input class="btn waves-effect waves-light" type="submit" value="Agregar" />
	</form>
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
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($resultado as $mv) {
				 ?>
				 <tr>
				 	<td><?php echo $mv['item_id'] ?></td>
				 	<td><?php echo $mv['cantidad'] ?></td>
				 	<td><?php echo $mv['nombre'] ?></td>
				 	<td><?php echo $mv['fecha_pedido'] ?></td>
				 	<td><?php echo $mv['nombres'] ?></td>
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