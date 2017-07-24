<?php


function insertarProducto($datos)
{
    
    

    $sql = "INSERT INTO productos (nombre, descripcion, codigoProducto,tiporepuesto,marca2, estado) VALUES ('".$datos[1]."','".$datos[4]."','".$datos[2]."','".$datos[5]."','".$datos[3]."',1)";
    
    $mysql = conexionMysql(); 
    
    if($resultado = $mysql->query($sql))
    {
		$sql = "INSERT INTO inventario (cantidad,precioCosto,precioVenta,precioClienteEs,precioDistribuidor, idproducto) VALUES (0,0,0,0,0,(select idproductos from productos order by idproductos desc limit 1))";
    
		$mysql = conexionMysql(); 
		
		if($resultado = $mysql->query($sql))
		{
			$id=$mysql->query("select idproductos from productos order by idproductos desc limit 1");
			$fila=$id->fetch_row();
			
        	$respuesta = "<script>buscaProducto(document.getElementById('Cantidad'));seleccionaProducto('".$fila[0]."');document.getElementById('retoCompra').hidden=false;</script>";		
			if(!isset($datos[6]))
			{
				$respuesta = "<script>limpiarProducto();buscaProducto(document.getElementById('codigo'));</script>";		
			}
		}
    }
    else
    { 
        $respuesta = "<div>Error en en la insercion </div>"; 
        echo 1;
    }
    
    
    $mysql->close();
    
    return printf($respuesta);
    
    
}

function cambiarTipoProducto($datos)
{
	$mysql = conexionMysql();
    $form="";
	
		$mysql->query("BEGIN");
    $sql = "update productos set tipoRepuesto='".$datos[0]."' where idproductos='".$datos[1]."'";
//echo $sql;
    if($mysql->query($sql))
    {
		
		$mysql->query("COMMIT");
			    
		
    
    }
    else
    {   
    	$mysql->query("ROLLBACK");
    $form = "<div><script>console.log('".$datos[0]."');</script></div>";
    
    }
    
    
    $mysql->close();
    
    return printf($form);
}

?>