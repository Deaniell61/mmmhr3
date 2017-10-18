<?php


function buscarInventario($datos)
{
    
    
    $mysql = conexionMysql();
    $form="";
    $sql = "SELECT i.precioCosto,i.precioVenta,i.precioClienteEs,i.precioDistribuidor,i.cantidad,(select p.descripcion from productos p where i.idproducto=p.idproductos),(select p.marca2 from productos p where i.idproducto=p.idproductos),(select p.nombre from productos p where i.idproducto=p.idproductos),i.minimo,i.idproducto from inventario i where idinventario='".$datos[0]."'";
 
    if($resultado = $mysql->query($sql))
    {
      if($resultado->num_rows>0)
	  {
		$fila = $resultado->fetch_row();    
			
		
		$form .="<script>";
		$form .=" 
				document.getElementById('producto').value='".$fila[7]."';
				document.getElementById('idproducto').value='".$datos[0]."';
				document.getElementById('idproducto2').value='".$fila[9]."';
				document.getElementById('marca').value='".$fila[6]."';
				document.getElementById('descripcion').value='".$fila[5]."';
				document.getElementById('costo').value='".$fila[0]."';
				document.getElementById('cantidad').value='".$fila[4]."';
				document.getElementById('precioG').value='".$fila[1]."';
				document.getElementById('precioE').value='".$fila[2]."';
				document.getElementById('precioM').value='".$fila[3]."';
				document.getElementById('MinimoCant').value='".$fila[8]."';
				document.getElementById('producto').focus();
				document.getElementById('marca').focus();
				document.getElementById('descripcion').focus();
				document.getElementById('costo').focus();
				document.getElementById('cantidad').focus();
				document.getElementById('precioE').focus();
				document.getElementById('precioM').focus();
				document.getElementById('precioG').focus();
				document.getElementById('MinimoCant').focus();";
		$form .=" habilita(false);";
		
		
		$form .="</script>";
			
		$resultado->free();    
	  }
	  else
	  {
		
		$resultado->free();   
	  }
    
    }
    else
    {   
    
    $form = "<div><script>console.log('$idedit');</script></div>";
    
    }
    
    
    $mysql->close();
    
    return printf($form);
    
    
}

function actualizaInventario($datos)
{
	$mysql = conexionMysql();
    $form="";
	session_start();
	$mysql->query("BEGIN");
	
			 
    $sql = "update inventario set precioventa='".$datos[1]."',precioClientees='".$datos[2]."',precioDistribuidor='".$datos[3]."',precioCosto='".$datos[4]."',cantidad='".$datos[5]."',minimo='".$datos[6]."' where idinventario='".$datos[0]."'";
 	
    if($mysql->query($sql))
    {
						if(!$mysql->query("update productos set nombre='".$datos[7]."',marca2='".$datos[8]."',descripcion='".$datos[9]."' where idproductos='".$datos[10]."'"))
						{
							$mysql->query("ROLLBACK");
						}
						else
						{
							$mysql->query("COMMIT");
							echo "<script>location.reload();</script>";
						}
			
    }
    else
    {   
    		$mysql->query("ROLLBACK");
    	$form = '1';
    
    }
	
    
    $mysql->close();
    
    return printf($form);
}
function eliminarInventario($datos)
{
	$mysql = conexionMysql();
    $form="";
	session_start();
	$mysql->query("BEGIN");
	
			 
    $sql = "update productos set estado=0 where idproductos='".$datos[0]."'";
 	
    if($mysql->query($sql))
    {
		
			if(!$mysql->query("delete from inventario where idinventario='".$datos[1]."'"))
			{
				$mysql->query("ROLLBACK");
			}
    					$mysql->query("COMMIT");
				echo "<script>alert('El producto fue retirado de inventario');location.reload();</script>";
			
    }
    else
    {   
    		$mysql->query("ROLLBACK");
    	$form = '1';
    
    }
	
    
    $mysql->close();
    
    return printf($form);
}



?>