<?php


function  buscarProveedor($nit)
{
    

    $mysql = conexionMysql();
    $form="";
    $sql = "SELECT nit,nombreEmpresa,direccion,idproveedor FROM proveedor WHERE nit='$nit' or nombreEmpresa='$nit' or idproveedor='$nit'";
 
    if($resultado = $mysql->query($sql))
    {
      if($resultado->num_rows>0)
	  {
		$fila = $resultado->fetch_row();    
			
		
		$form .="<script>";
		$form .=" \$('#NIT').val('".$fila[0]."');\$('#NIT').focus();";
		$form .="/* document.getElementById('rol').value='".$fila[2]."';\$('#rol').focus();*/";
		$form .=" \$('#Proveedor').val('".$fila[1]."');\$('#Proveedor').focus();document.getElementById('Proveedor').disabled=true;";
		$form .=" \$('#direccionC').val('".$fila[2]."');\$('#direccionC').focus();document.getElementById('direccionC').disabled=true;";
		$form .=" document.getElementById('codigoProveedor').value='".$fila[3]."';";
		$form .=" \$('#botonGuardar').show();";
		$form .=" \$('#botonNuevo').show();";
		$form .="iniciarCompra('".$fila[3]."');cierre(); ";
		
		$form .="</script>";
			
		$resultado->free();    
	  }
	  else
	  {
		$form .="<script>";
		$form .="\$('#modal4').openModal();
					setTimeout(function(){
		llamarCliente();},300); ";
		$form .="</script>";
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

function inicioCompra($idProv)
{
	$mysql = conexionMysql();
    $form="";
	session_start();
		$mysql->query("BEGIN");
		$mysql->query("delete from compradetalle where estado=2;");
		$mysql->query("delete from compras where estado=2;");
    $sql = "INSERT INTO compras(total,estado,tipoCompra,iddistribuidor,idusuario) values(0,2,'".$idProv[1]."','".$idProv[0]."','".$_SESSION['SOFT_USER_ID']."')";
 
    if($mysql->query($sql))
    {
		$sql = "SELECT idCompras,nocomprobante from compras order by idcompras desc limit 1";
		if($resultado = $mysql->query($sql))
    	{
      
			$fila = $resultado->fetch_row();    
				
				
					$_SESSION['idCompra']=$fila[0];
			
			 	$form .="<script>";
					$form .="document.getElementById('codigoCompra').value='".$_SESSION['idCompra']."'; setTimeout(function(){\$('#tipoCompra').material_select();},0);";
				
				
				$form .="</script>";
		$mysql->query("COMMIT");
			$resultado->free();    
		}
    
    }
    else
    {   
    
    	$form = "<div><script>console.log('$idProv');</script></div>";
    
    }
    
    
    $mysql->close();
    
    return printf($form);
  
}

function agregaInventario($datos)
{
	$mysql = conexionMysql();
    $form="";
	session_start();
	$mysql->query("BEGIN");
	
	
	
	if($cont=$mysql->query("select idcompraDetalle,cantidad,costo,precio,precioE,precioM,idproductos from compradetalle  where idcompras='".$_SESSION['idCompra']."' "))
	{
			
		 if($cont->num_rows>0)
		{
			while($fila = $cont->fetch_row())
			{			 
						 
				if($fila[1]>=0)
				{			 
					$total=$fila[2]*$fila[1];
						
				$sql = "update inventario set cantidad=cantidad+".$fila[1].",preciocosto='".$fila[2]."',precioventa='".$fila[3]."',precioClientees='".$fila[4]."',precioDistribuidor='".$fila[5]."' where idproducto='".$fila[6]."'";
				
					if($mysql->query($sql))
					{
							 
									
							//		 echo "<script>window.location.href = 'Ventas.php';/script>";
									
							if(!$mysql->query("update compras set estado=1 where idcompras='".$_SESSION['idCompra']."'"))
									 {
										
										 $mysql->query("ROLLBACK");
									 }
									 else
									 
									 if(!$mysql->query("update cuentaspagar set estado=1,total=(select v.total from compras v where v.idcompras='".$_SESSION['idCompra']."'),CreditoDado=(select v.total from compras v where v.idcompras='".$_SESSION['idCompra']."') where idcompras='".$_SESSION['idCompra']."'"))
									{
								
										$mysql->query("ROLLBACK");
									}
									
									else
									if(!$mysql->query("update compradetalle set estado=1 where idcompradetalle='".$fila[0]."'"))
									 {
										
										 $mysql->query("ROLLBACK");
									 }
									 else
									 {	     
							 
							 
						
										$mysql->query("COMMIT");
										echo "<script>setTimeout(function(){window.location.href=\"Compras.php\";},300);</script>";
									}
						
							
					}
					else
					{   
					
							$mysql->query("ROLLBACK");
						$form = '1';
					
					}
				}
				else
				{
					echo "<script>alert('si');</script>";
				}
			}
		}
	}
    $mysql->close();
    
    return printf($form);
}
function ingresoCompra($datos)
{
	$mysql = conexionMysql();
    $form="";
	session_start();
	$mysql->query("BEGIN");
	$total=$datos[2]*$datos[1];
    $sql = "INSERT INTO compradetalle(cantidad,precio,estado,idcompras,idproductos,subtotal,costo,precioE,precioM) values('".$datos[1]."','".$datos[3]."',2,'".$_SESSION['idCompra']."',".$datos[0].",".$total.",".$datos[2].",".$datos[4].",".$datos[5].")";
 
    if($mysql->query($sql))
    {
		
      
			 if(!$mysql->query("update compras set total=total+".$total." where idcompras='".$_SESSION['idCompra']."'"))
			 {
				 $mysql->query("ROLLBACK");
			 }
			 else
			 if(!$mysql->query("update cuentaspagar set estado=estado where idcompras='".$_SESSION['idCompra']."'"))
			 {
				
				 $mysql->query("ROLLBACK");
			 }
			 else
			 {
				 
				 echo "<script>cargarDetalleCompras('".$_SESSION['idCompra']."');document.getElementById('productosCompra').innerHTML='';document.getElementById('tipoCompra').disabled=true;$('#tipoCompra').material_select();limpiarProducto();</script>";
			 }
		
    		$mysql->query("COMMIT");
		
			
    }
    else
    {   
    
    	$form = $sql;
    
    }
    
    
    $mysql->close();
    
    return printf($form);
  
}

function guardarCompra()
{
	$mysql = conexionMysql();
    $form="<script>location.reload();</script>";
	session_start();
    
   $mysql->query("delete from compras where idcompras='".$_SESSION['idCompra']."' and estado=2;");
    
    $mysql->close();
    
    return printf($form);
  
	
}

function  buscarProducto($dato)
{
    

    $mysql = conexionMysql();
    $form="";
    $sql = "SELECT p.nombre,i.precioventa,p.idproductos,p.codigoProducto,i.cantidad FROM inventario i inner join productos p on p.idproductos=i.idproducto WHERE p.nombre like '%".$dato[0]."%' or p.codigoProducto like '%".$dato[0]."%' and i.cantidad>=0";
 
    if($resultado = $mysql->query($sql))
    {
      if($resultado->num_rows>0 && $dato[0]!="")
	  {
		  	
		while($fila = $resultado->fetch_row())
		{  
			$form .="<div class='borde' onClick=\"seleccionaProducto('".$fila[2]."');\"><div ><span>Codigo: </span><span class='enlinea' >".$fila[3]."</span></diV><div><span>Producto: </span><span class=' enlinea'>".$fila[0]."</span></div><div><span>Cantidad: </span><span class='enlinea' >".$fila[4]."</span></div></div><div><br>";
		}
		$resultado->free();    
	  }
	  else
	  {
		$form .="<script>";
			$form .="document.getElementById('agregarProd').hidden=false;";
			$form .="</script>";
	  }
    
    }
    else
    {   
    
    $form = "<div>$sql<script>console.log('".$dato[0]."');</script></div>";
    
    }
    
    
    $mysql->close();
    
    printf($form);
    
}

function  buscarPrecioProducto($dato)
{
    

    $mysql = conexionMysql();
    $form="";
    $sql = "SELECT p.nombre,i.preciocosto,p.idproductos,p.codigoproducto,p.descripcion,i.precioCosto,i.precioVenta,i.precioClienteEs,i.precioDistribuidor,p.marca2,p.tiporepuesto FROM inventario i inner join productos p on p.idproductos=i.idproducto WHERE p.idproductos='".$dato[0]."' ";
 
    if($resultado = $mysql->query($sql))
    {
      if($resultado->num_rows>0)
	  {
		  if($fila = $resultado->fetch_row())
		  {
		  	$form .="<script>";
			$form .="document.getElementById('codigo').value='".$fila[2]."';document.getElementById('retoCompra').hidden=false;";
			$form .="document.getElementById('Producto').value='".$fila[0]."';document.getElementById('Producto').focus();";
			$form .="document.getElementById('nombreC').value='".$fila[3]."';document.getElementById('nombreC').focus();";
			$form .="document.getElementById('descripcion').value='".$fila[4]."';document.getElementById('descripcion').focus();";
			$form .="document.getElementById('marca').value='".$fila[9]."';document.getElementById('marca').focus();";
			$form .="$('#tipoRepuesto').val(\"".$fila[10]."\");$('#tipoRepuesto').material_select('destroy');
        $('#tipoRepuesto').material_select();";
			$form .="document.getElementById('precioC').value='".($fila[5])."';document.getElementById('precioC').focus();";
			$form .="document.getElementById('precioG').value='".($fila[6])."';document.getElementById('precioG').focus();";
			$form .="document.getElementById('precioE').value='".($fila[7])."';document.getElementById('precioE').focus();";
			$form .="document.getElementById('precioM').value='".($fila[8])."';document.getElementById('precioM').focus();";
			$form .="document.getElementById('agregarProd').style.display='none';";
			$form .="document.getElementById('agregarProd2').hidden=true;";
			$form .="document.getElementById('Cantidad').focus();";
			$form .="</script>";
			
		}
		$resultado->free();    
	  }
	  else
	  {
		$form .="<script>";
			$form .="document.getElementById('productosContenedor').hidden=true;";
			$form .="</script>";
	  }
    
    }
    else
    {   
    
    $form = "<div>$sql<script>console.log('".$dato[0]."');</script></div>";
    
    }
    
    
    $mysql->close();
    
    return printf($form);
    
}

function buscarCompra($dato)
{
	

    $mysql = conexionMysql();
    $form="";
    $sql = "SELECT c.fecha,c.nocomprobante,p.nit,p.nombreempresa,c.total,c.tipocompra,c.idcompras,p.direccion FROM compras c inner join proveedor p on p.idproveedor=c.iddistribuidor where (c.estado=1 or c.estado=0) and c.idcompras='".$dato[0]."' ";

    if($resultado = $mysql->query($sql))
    {
      if($resultado->num_rows>0)
	  {
		  if($fila = $resultado->fetch_row())
		  {
		  	$form .="<script>";
			$form .="document.getElementById('NIT').disabled=false;document.getElementById('NIT').value='".$fila[2]."';document.getElementById('NIT').focus();document.getElementById('NIT').disabled=true;";
			$form .="document.getElementById('fecha').disabled=false;document.getElementById('fecha').value='".substr($fila[0],0,10)."';document.getElementById('fecha').focus();document.getElementById('fecha').disabled=true;";
			$form .="document.getElementById('Proveedor').disabled=false;document.getElementById('Proveedor').value='".$fila[3]."';document.getElementById('Proveedor').focus();document.getElementById('Proveedor').disabled=true;";
			$form .="document.getElementById('direccionC').disabled=false;document.getElementById('direccionC').value='".$fila[7]."';document.getElementById('direccionC').focus();document.getElementById('direccionC').disabled=true;";
			$form .="document.getElementById('factura').disabled=false;document.getElementById('factura').value='".$fila[1]."';document.getElementById('factura').focus();document.getElementById('factura').disabled=true;";
			$form .="\$('#tipoCompra').val(\"".$fila[5]."\");$('#tipoCompra').material_select('destroy'); $('#tipoCompra').material_select(); ";
			$form .="cargarDetalleCompras('".$dato[0]."');";
			$form .="</script>";
			
		}
		$resultado->free();    
	  }
	  else
	  {
		$form .="<script>";
			$form .="document.getElementById('productosContenedor').hidden=true;";
			$form .="</script>";
	  }
    
    }
    else
    {   
    
    $form = "<div>$sql<script>console.log('".$dato[0]."');</script></div>";
    
    }
    
    
    $mysql->close();
    
    return printf($form);
    
}

function cambiarTipoCompra($datos)
{
	$mysql = conexionMysql();
    $form="";
	
		$mysql->query("BEGIN");
    $sql = "update compras set tipoCompra='".$datos[0]."' where idcompras='".$datos[1]."'";
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
function cambiarFechaCompra($datos)
{
	$mysql = conexionMysql();
    $form="";
	
		$mysql->query("BEGIN");
    $sql = "update compras set fecha='".$datos[0]."' where idcompras='".$datos[1]."'";
//echo $sql;
    if($mysql->query($sql))
    {
		if(!$mysql->query("update cuentaspagar set fecha='".$datos[0]."' where idcompras='".$datos[1]."'"))
		{
			$mysql->query("ROLLBACK");
		}
		else
		{
			$mysql->query("COMMIT");
		}
			    
		
    
    }
    else
    {   
    	$mysql->query("ROLLBACK");
    $form = "<div><script>console.log('".$datos[0]."');</script></div>";
    
    }
    
    
    $mysql->close();
    
    return printf($form);
}
function agregarFactura($datos)
{
	$mysql = conexionMysql();
    $form="";
	
		$mysql->query("BEGIN");
    $sql = "update compras set NoComprobante='".$datos[0]."' where idcompras='".$datos[1]."'";
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

function anularCompra($datos)
{
	$mysql = conexionMysql();
    $form="";
	
		$mysql->query("BEGIN");
    $sql = "update compras set estado='0' where idcompras='".$datos[0]."'";
//echo $sql;
    if($mysql->query($sql))
    {
		if(!$mysql->query("update compradetalle set estado='0' where idcompras='".$datos[0]."'"))
		{
			$mysql->query("ROLLBACK");
		}
		else
		if($con=$mysql->query("select cantidad,idproductos from compradetalle where idcompras='".$datos[0]."'"))
    	{
			while($fila = $con->fetch_row())
			{
				if(!$mysql->query("update inventario set cantidad=cantidad-".$fila[0]." where idproducto='".$fila[1]."'"))
				{
					$mysql->query("ROLLBACK");
				}
			}
			
			$mysql->query("COMMIT");
		}
		else
		{
			$mysql->query("ROLLBACK");
		}
		
		
			    
		$form = "<script>alert('La compra fue anulada');setTimeout(window.location.reload(), 3000);</script>";
    
    }
    else
    {   
    	$mysql->query("ROLLBACK");
    $form = "<div><script>location.reload();console.log('".$datos[0]."');</script></div>";
    
    }
    
    
    $mysql->close();
    
    return printf($form);
}


function  buscarMarca($dato)
{
    

    $mysql = conexionMysql();
    $form="";
    $sql = "SELECT marca2 from productos WHERE marca2 like '%".$dato[0]."%' group by marca2";
 
    if($resultado = $mysql->query($sql))
    {
		
      if($resultado->num_rows>0 )
	  {
		  	
		while($fila = $resultado->fetch_row())
		{   
			
			
			{
				$codigo="";
			}
			$form .="<li onClick=\"seleccionaMarca('".$fila[0]."');\">".$fila[0]."</li> ";
		}
		$resultado->free();    
	  }
	  else
	  {
		$form .="<script>";
			$form .="document.getElementById('listaMarca').hidden=false;";
			$form .="</script>";
	  }
    
    }
    else
    {   
    
    $form = "<div>$sql<script>console.log('".$dato[0]."');</script></div>";
    
    }
    
    
    $mysql->close();
    
    printf($form);
    
}

function anularDetalleCompra($datos)
{
	$mysql = conexionMysql();
    $form="";
	session_start();
		$mysql->query("BEGIN");
    $sql = "update compras set total=total-(select subtotal from compradetalle where idcompradetalle='".$datos[0]."') where idcompras=(select d.idcompras from compradetalle d where d.idcompradetalle='".$datos[0]."')";
//echo $sql;
    if($mysql->query($sql))
    {
		
		if(!$mysql->query("delete from compradetalle where idcompradetalle='".$datos[0]."'"))
		{
			$mysql->query("ROLLBACK");
		}
		else
		{
			$mysql->query("COMMIT");
		}
		$form = "<script>cargarDetalleCompras('".$_SESSION['idCompra']."');</script>";
    
    }
    else
    {   
    	$mysql->query("ROLLBACK");
    	$form = "<div><script>cargarDetalleCompras('".$_SESSION['idCompra']."');</script></div>";
    
    }
    
    
    $mysql->close();
    
    return printf($form);
}
function  buscarPlazoCuentaPagar($dato)
{
    

    $mysql = conexionMysql();
    $form="";
    $sql = "SELECT plazo,tipoPlazo FROM cuentaspagar WHERE idcompras='".$dato[0]."'";
 	//echo $sql;
    if($resultado = $mysql->query($sql))
    {
      if($resultado->num_rows>0)
	  {
		$fila = $resultado->fetch_row();    
			
		
		$form .="<script>";
		$form .="\$('#plazo').val(\"".$fila[0]."\");\$('#plazo').focus(); ";
		$form .="\$('#tipoPlazo').val(\"".$fila[1]."\");$('#tipoPlazo').material_select(); ";
		$form .="ingresoCuentaPagar();";
		$form .="</script>";
			
		$resultado->free();    
	  }
	  else
	  {
		$form .="<script>";
		$form .="\$('#plazo').val(\"\");\$('#plazo').focus(); ";
		$form .="\$('#tipoPlazo').val(\"\");$('#tipoPlazo').material_select(); ";
		$form .="</script>";
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

?>