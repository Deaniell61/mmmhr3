<?php
function ingresoCuentaPagar($datos)
{
	$mysql = conexionMysql();
    $form="";
	
		$mysql->query("BEGIN");
    $sql = "insert cuentaspagar(plazo,tipoPlazo,total,idcompras,estado,CreditoDado,fecha) values('".$datos[1]."','".$datos[2]."',0,'".$datos[0]."',2,0,'".$datos[3]."')";
//echo $sql;
    if($mysql->query($sql))
    {
		
		$mysql->query("COMMIT");
			    
		
    
    }
    else
    {   
		$sql = "update cuentaspagar set plazo='".$datos[1]."',tipoPlazo='".$datos[2]."',fecha_ant=fecha,fecha='".$datos[3]."' where idcompras='".$datos[0]."'";
//echo $sql;
			if($mysql->query($sql))
			{
				
				$mysql->query("COMMIT");
						
				
			
			}
			else
			{
				$mysql->query("ROLLBACK");
				$form = "<div>$sql<script>console.log('".$datos[0]."');</script></div>";
			}
    
    }
    
    
    $mysql->close();
    
    return printf($form);
}

function editarCuentasP($dato)
{
	

    $mysql = conexionMysql();
    $form="";
    $sql = "SELECT cc.fecha,cc.plazo,cc.tipoPlazo,cc.creditodado,cc.total,cc.idcompras,(select c.nombreempresa from proveedor c where c.idproveedor=v.iddistribuidor limit 1) FROM cuentaspagar cc inner join compras v on v.idcompras=cc.idcompras WHERE cc.estado=1 and cc.idcuentasP='".$dato[0]."' ";

    if($resultado = $mysql->query($sql))
    {
      if($resultado->num_rows>0)
	  {
		  if($fila = $resultado->fetch_row())
		  {
		  	$form .="<script>";
			$form .="document.getElementById('proveedorED').disabled=false;document.getElementById('proveedorED').value='".$fila[6]."';document.getElementById('proveedorED').focus();document.getElementById('proveedorED').disabled=true;";
			$form .="document.getElementById('fechaInicialED').disabled=false;document.getElementById('fechaInicialED').value='".substr($fila[0],0,10)."';document.getElementById('fechaInicialED').focus();document.getElementById('fechaInicialED').disabled=true;";
			$form .="document.getElementById('totalCreditoED').disabled=false;document.getElementById('totalCreditoED').value='".$fila[3]."';document.getElementById('totalCreditoED').focus();document.getElementById('totalCreditoED').disabled=true;";
			$form .="document.getElementById('saldoE').innerHTML='Saldo: ".toMoney($fila[4])."';";
			$form .="document.getElementById('saldoED').disabled=false;document.getElementById('saldoED').value='".$fila[4]."';document.getElementById('saldoED').focus();document.getElementById('saldoED').disabled=true;";
			$form .="document.getElementById('plazoED').disabled=false;document.getElementById('plazoED').value='".$fila[1]."';document.getElementById('plazoED').focus();document.getElementById('plazoED').disabled=true;";
			$form .="document.getElementById('codigo').disabled=false;document.getElementById('codigo').value='".$dato[0]."';document.getElementById('codigo').focus();document.getElementById('codigo').disabled=true;";
			//$form .="document.getElementById('tipoCompra').disabled=false;document.getElementById('tipoCompra').value='".$fila[5]."'.selected;document.getElementById('tipoCompra').focus();document.getElementById('tipoCompra').disabled=true;";
			$form .="\$('#tipoPlazoED').val(\"".$fila[2]."\");$('select').material_select(); ";
			$form .="cargarDetalleCuentasP('".$dato[0]."');";
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
function verCuentaP($dato)
{
	

    $mysql = conexionMysql();
    $form="";
    $sql = "SELECT cc.fecha,cc.plazo,cc.tipoPlazo,cc.creditodado,cc.total,cc.idcompras,(select c.nombreempresa from proveedor c where c.idproveedor=v.iddistribuidor limit 1),(select c.direccion from proveedor c where c.idproveedor=v.iddistribuidor limit 1),(select c.telefono from proveedor c where c.idproveedor=v.iddistribuidor limit 1) FROM cuentaspagar cc inner join compras v on v.idcompras=cc.idcompras WHERE cc.estado=1 and cc.idcuentasP='".$dato[0]."' ";

    if($resultado = $mysql->query($sql))
    {
      if($resultado->num_rows>0)
	  {
		  if($fila = $resultado->fetch_row())
		  {
		  	$form .="<script>";
			$form .="document.getElementById('proveedorV').disabled=false;document.getElementById('proveedorV').value='".$fila[6]."';document.getElementById('proveedorV').focus();document.getElementById('proveedorV').disabled=true;";
			$form .="document.getElementById('fechaCredito').disabled=false;document.getElementById('fechaCredito').value='".substr($fila[0],0,10)."';document.getElementById('fechaCredito').focus();document.getElementById('fechaCredito').disabled=true;";
			$form .="document.getElementById('saldoV').innerHTML='Saldo: ".toMoney($fila[4])."';";
			$form .="document.getElementById('plazoV').disabled=false;document.getElementById('plazoV').value='".$fila[1]."';document.getElementById('plazoV').focus();document.getElementById('plazoV').disabled=true;";
			$form .="document.getElementById('direccionV').disabled=false;document.getElementById('direccionV').value='".$fila[7]."';document.getElementById('direccionV').focus();document.getElementById('direccionV').disabled=true;";
			$form .="document.getElementById('TelefonoV').disabled=false;document.getElementById('TelefonoV').value='".$fila[8]."';document.getElementById('TelefonoV').focus();document.getElementById('TelefonoV').disabled=true;";
			//$form .="document.getElementById('tipoCompra').disabled=false;document.getElementById('tipoCompra').value='".$fila[5]."'.selected;document.getElementById('tipoCompra').focus();document.getElementById('tipoCompra').disabled=true;";
			$form .="\$('#tipoPlazoV').val(\"".$fila[2]."\");$('select').material_select(); ";
			$form .="cargarDetalleCuentasP('".$dato[0]."');";
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

function abonarCuentaP($datos)
{
	$mysql = conexionMysql();
    $form="";
	session_start();
	$mysql->query("BEGIN");
	
	if($cont=$mysql->query("select total from cuentaspagar where idcuentasp='".$datos[0]."'"))
	{
			 
				 $fila = $cont->fetch_row();
				 
				 if($fila[0]<$datos[1])
				 {
					 $datos[1]=$fila[0];
				 }
	$saldo=$datos[3]-$datos[1];
	$total=$fila[0]-$datos[1];
	if($datos[1]>0)
	{		 
    $sql = "INSERT INTO movimientosp(credito,abono,saldo,fecha,descripcion,idcuentasP,idusuario) values('".$datos[5]."','".$datos[1]."','".$saldo."','".$datos[2]."','".$datos[4]."',".$datos[0].",'".$_SESSION['SOFT_USER_ID']."')";
 
    if($mysql->query($sql))
    {
			 
				 	  if(!$mysql->query("update cuentaspagar set total=total-".$datos[1]." where idcuentasP='".$datos[0]."'"))
					 {
						
						 $mysql->query("ROLLBACK");
					 }
					 else
					 {
						 if($total==0)
						 {
							 if(!$mysql->query("update cuentaspagar set estado=0 where idcuentasp='".$datos[0]."'"))
							 {
								  $mysql->query("ROLLBACK");
							 }
						 }
						 
						 echo "<script>window.location.reload();cargarDetalleCuentasP('".$datos[0]."');limpiarAbono();document.getElementById('saldoE').innerHTML='Saldo: ".toMoney($saldo)."';</script>";
						 
					 }
				     
			 
			 
		
    		$mysql->query("COMMIT");
		
	
    }
    else
    {   
    
    	$form = $sql;
    
    }
    
    }
	else
	{
		 	
		 $mysql->query("ROLLBACK");
		 
	 }
	}
	else
	{
		echo "<script>window.location.reload();</script>";
	}
    $mysql->close();
    
    return printf($form);
  
}
?>