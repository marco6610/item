<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<title>Marco Valle</title>
		<link rel="stylesheet" href="../css/materialize.min.css">
        <script>
            function eliminar_item(id_to_delete)
            {
                var confirmation = confirm('¿Está seguro de que desea eliminar la compra con la clave '+ id_to_delete);
    
                if(confirmation)
                {
                    window.location = "item_eliminar.php?item_id="+id_to_delete;
                }
            }
        </script>

		</head>

	<body>
		<!--Import jQuery before materialize.js-->
    	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    	<script type="text/javascript" src="../js/materialize.min.js"></script>
    	<div class="navbar-fixed">
            <nav class="red">
                <div class="nav-wrapper">
                    <a href="#" class="brand-logo right">Marco Valle</a>
                    <ul id="nav-mobile" class="left side-nav">
                        <li><a href="index.php">Inicio</a></li>
                    </ul>
                </div>
            </nav>
        </div>