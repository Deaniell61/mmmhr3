<?php


if($_POST)
{
    require('../configCore.php');
    
    $transaccion = $_POST['trasDato'];
    
    
//-------------- acceso -----------/    
    if($transaccion == 1)
    {
        $datos[0]=$_POST['id'];
		
		
        buscarInventario($datos);
        
        
    
    }
	else if($transaccion == 2)
    {
        $datos[0]=$_POST['id'];
		$datos[1]=$_POST['precioG'];
		$datos[2]=$_POST['precioE'];
		$datos[3]=$_POST['precioM'];
		$datos[4]=$_POST['costo'];
		$datos[5]=$_POST['cantidad'];
		$datos[6]=$_POST['minimo'];
		
		$datos[7]=$_POST['nombre'];
		$datos[8]=$_POST['marca'];
		$datos[9]=$_POST['descripcion'];
		$datos[10]=$_POST['prod'];
		
		
        actualizaInventario($datos);
        
        
    
    }
    else if($transaccion == 3)
    {
        $datos[0]=$_POST['tipo'];
		
		
        mostrarInventario($datos);
        
        
    
    }
	else if($transaccion == 4)
    {
        $datos[0]=$_POST['tipo'];
		
		
        mostrarInventarioAdmin($datos);
        
        
    
    }
	else if($transaccion == 5)
    {
        $datos[0]=$_POST['prod'];
		$datos[1]=$_POST['inv'];
		
		
        eliminarInventario($datos);
        
        
    
    }
	
//----------- fin gestion ----------/    
    
}

else
{
    
    //regrsar a index
    echo'regresar al index';
}


?>