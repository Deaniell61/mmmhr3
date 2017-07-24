<?php
require_once ('../../conf.php');
require_once ('../../lib/conexion.php');
require_once ('../../lib/PHPExcel/PHPExcel.php');


function proveedorU($id)
{
	require_once ('../../conf.php');
	require_once ('../../lib/conexion.php');
	$mysql = conexionMysql();
    $form="";
    $sql = "select pr.nombreempresa from proveedor pr inner join compras c on c.iddistribuidor=pr.idproveedor inner join compradetalle cd on cd.idcompras=c.idcompras where cd.idproductos='".$id."' order by c.idcompras desc limit 1";
 	//echo $sql;
    if($resultado = $mysql->query($sql))
    {
      if($resultado->num_rows>0)
	  {
		$fila = $resultado->fetch_row();    
			
		
		
		$form .="".$fila[0]."";
		
		
			
		$resultado->free();    
	  }
	  
    
    }
    else
    {   
    
    $form = "<div><script>console.log('$idedit');</script></div>";
    
    }
    
    
    $mysql->close();
    
    return ($form);
}

function fechaU($id)
{
	require_once ('../../conf.php');
	require_once ('../../lib/conexion.php');
	$mysql = conexionMysql();
    $form="";
    $sql = "select c.fecha from proveedor pr inner join compras c on c.iddistribuidor=pr.idproveedor inner join compradetalle cd on cd.idcompras=c.idcompras where cd.idproductos='".$id."' order by c.idcompras desc limit 1";
 	//echo $sql;
    if($resultado = $mysql->query($sql))
    {
      if($resultado->num_rows>0)
	  {
		$fila = $resultado->fetch_row();    
			
		
		
		$form .="".$fila[0]."";
		
		
			
		$resultado->free();    
	  }
	  
    
    }
    else
    {   
    
    $form = "<div><script>console.log('$idedit');</script></div>";
    
    }
    
    
    $mysql->close();
    
    return (substr($form,0,10));
}

function noDocU($id)
{
	require_once ('../../conf.php');
	require_once ('../../lib/conexion.php');
	$mysql = conexionMysql();
    $form="";
    $sql = "select c.nocomprobante from proveedor pr inner join compras c on c.iddistribuidor=pr.idproveedor inner join compradetalle cd on cd.idcompras=c.idcompras where cd.idproductos='".$id."' order by c.idcompras desc limit 1";
 	//echo $sql;
    if($resultado = $mysql->query($sql))
    {
      if($resultado->num_rows>0)
	  {
		$fila = $resultado->fetch_row();    
			
		
		
		$form .="".$fila[0]."";
		
		
			
		$resultado->free();    
	  }
	  
    
    }
    else
    {   
    
    $form = "<div><script>console.log('$idedit');</script></div>";
    
    }
    
    
    $mysql->close();
    
    return ($form);
}
   $objPHPExcel = new PHPExcel();
   
   //Informacion del excel
   $objPHPExcel->
    getProperties()
        ->setCreator("DAWESystems")
        ->setLastModifiedBy("DAWESystems")
        ->setTitle("Productos")
        ->setSubject("Reporte_Productos")
        ->setDescription("Reporte de Productos")
        ->setKeywords("Productos")
        ->setCategory("ciudades");    
$objPHPExcel->getSheetCount();//cuenta las pestañas
	
	$estiloTituloColumnas = array(
    'font' => array(
        		'name'  => 'Arial',
        		'bold'  => true,
        		'color' => array(
            					'rgb' => 'FFFFFF'
        						)
    				),
    'fill' => array(
        			'type'=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
  					'rotation'=> 90,
        			'startcolor' => array(
            								'rgb' => '000000'
        								),
        			'endcolor' => array(
            							'argb' => 'FF431a5d'
        								)
    				),
    'borders' => array(
        				'top' => array(
            							'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            							'color' => array(
                										'rgb' => '143860'
            												)
        								),
        				'bottom' => array(
            							'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            							'color' => array(
                										'rgb' => '143860'
            											)
        									),
						'left' => array(
            							'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            							'color' => array(
                										'rgb' => '143860'
            												)
        								),
						'right' => array(
            							'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            							'color' => array(
                										'rgb' => '143860'
            												)
        								),
    					),
    'alignment' =>  array(
        					'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        					'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        					'wrap'      => TRUE
    						)
	);
	$estiloTituloCanales = array(
    'font' => array(
        		'name'  => 'Arial',
        		'bold'  => true,
        		'color' => array(
            					'rgb' => '000000'
        						)
    				),
    'borders' => array(
        				'top' => array(
            							'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            							'color' => array(
                										'rgb' => '143860'
            												)
        								),
        				'bottom' => array(
            							'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            							'color' => array(
                										'rgb' => '143860'
            											)
        									),
						'left' => array(
            							'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            							'color' => array(
                										'rgb' => '143860'
            												)
        								),
						'right' => array(
            							'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            							'color' => array(
                										'rgb' => '143860'
            												)
        								),
    					),
    'alignment' =>  array(
        					'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        					'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        					'wrap'      => TRUE
    						)
	);

	$estiloInformacion = new PHPExcel_Style();
	$estiloInformacion->applyFromArray( array(
    	'font' => array(
        	'name'  => 'Arial',
        	'color' => array(
            				'rgb' => '000000'
        					)
    				),
    	'fill' => array(
  					'type'  => PHPExcel_Style_Fill::FILL_SOLID
  						),
    	'alignment' =>  array(
        					'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        					'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
    						),
    	'borders' => array(
        			'left' => array(
            					'style' => PHPExcel_Style_Border::BORDER_THIN 
        							),
					'right' => array(
            					'style' => PHPExcel_Style_Border::BORDER_THIN 
        							),
					'top' => array(
            					'style' => PHPExcel_Style_Border::BORDER_THIN 
        							),
					'bottom' => array(
            					'style' => PHPExcel_Style_Border::BORDER_THIN 
        							)

    					),
					
				));
	$positionInExcel=0;//esto es para que ponga la nueva pestaña al principio
session_start();
if(isset($_SESSION['codigoBuscaProducto_SOFT']))
{
	if($_SESSION['codigoBuscaProducto_SOFT']!="")
	{
		$mas=" and p.codigoproducto='".$_SESSION['codigoBuscaProducto_SOFT']."' and i.cantidad<=i.minimo ";
	}
	else
		{
			$mas="";
		}
}
else
{
	$mas="";
}
	//creamos la pestaña
	
	$o=0;
	
	$i = 3;

	$objPHPExcel->setActiveSheetIndex($o)
            ->setCellValue('A'.$i, "Correlativo")
			->setCellValue('B'.$i, "Codigo")
			->setCellValue('C'.$i, "Producto")
			->setCellValue('D'.$i, "Marca")
			->setCellValue('E'.$i, "Descripcion")
			->setCellValue('F'.$i, "Cantidad")
			->setCellValue('G'.$i, "Proveedor")
			->setCellValue('H'.$i, "Fecha")
			->setCellValue('I'.$i, "Comprobante"); 
   $i++;   

$mysql = conexionMysql();
    $sql = "SELECT p.nombre,i.preciocosto,p.idproductos,p.codigoproducto,p.descripcion,i.precioCosto,i.precioVenta,i.precioClienteEs,i.precioDistribuidor,i.cantidad,p.marca2,p.codigoproducto,i.idinventario,p.idproductos FROM inventario i inner join productos p on p.idproductos=i.idproducto where p.tiporepuesto='".$_GET['filtro']."' $mas and i.cantidad>=0 and p.estado=1";
    
	$cont=0;
    if($resultado = $mysql->query($sql))
    {

        if(mysqli_num_rows($resultado)==0)
        {
            $respuesta = "<div class='error'>No hay usuarios BD vacia</div>";
        }

        else
        {

            while($fila = $resultado->fetch_row())
            {
$cont++;
		$objPHPExcel->setActiveSheetIndex($o)
            ->setCellValue('A'.$i, $cont)
			->setCellValue('B'.$i, $fila["11"])
			->setCellValue('C'.$i, $fila["0"])
			->setCellValue('D'.$i, $fila["10"])
			->setCellValue('E'.$i, $fila["4"])
			->setCellValue('F'.$i, $fila["9"])
			->setCellValue('G'.$i, proveedorU($fila["13"]))
			->setCellValue('H'.$i, fechaU($fila["13"]))
			->setCellValue('I'.$i, noDocU($fila["13"])); 
			
               $i++;

            }

            $resultado->free();//librerar variable


           
        }
    }
    else
    {
        $respuesta = "<div class='error'>Error: no se ejecuto la consulta a BD</div>";

    }

    //cierro la conexion
    $mysql->close();

   //$objPHPExcel->getActiveSheet()->mergeCells('A2:F2');
   //$objPHPExcel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($estiloTituloCanales);

   $objPHPExcel->getActiveSheet()->getStyle('A3:I3')->applyFromArray($estiloTituloColumnas);
   $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
   $objPHPExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
   $objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
   $objPHPExcel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
   $objPHPExcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
   $objPHPExcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
   $objPHPExcel->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
   $objPHPExcel->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
   $objPHPExcel->getActiveSheet()->getColumnDimension("I")->setAutoSize(true);
   
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:I".($i-1));
   /*$objPHPExcel->getActiveSheet() ->getStyle('G4:K'.$i) ->getNumberFormat() ->setFormatCode( '_-$* #,##0.00_-;-$* #,##0.00_-;_-$* "-"??_-;_-@_-' ); 
   $objPHPExcel->getActiveSheet() ->getStyle('N4:O'.$i) ->getNumberFormat() ->setFormatCode( '_-$* #,##0.00_-;-$* #,##0.00_-;_-$* "-"??_-;_-@_-' ); 
   $objPHPExcel->getActiveSheet() ->getStyle('R4:T'.$i) ->getNumberFormat() ->setFormatCode( '_-$* #,##0.00_-;-$* #,##0.00_-;_-$* "-"??_-;_-@_-' ); 
   $objPHPExcel->getActiveSheet() ->getStyle('V4:W'.$i) ->getNumberFormat() ->setFormatCode( '_-$* #,##0.00_-;-$* #,##0.00_-;_-$* "-"??_-;_-@_-' ); 
   $objPHPExcel->getActiveSheet() ->getStyle('Z4:AA'.$i) ->getNumberFormat() ->setFormatCode( '_-$* #,##0.00_-;-$* #,##0.00_-;_-$* "-"??_-;_-@_-' ); 
   $objPHPExcel->getActiveSheet() ->getStyle('AC4:AC'.$i) ->getNumberFormat() ->setFormatCode( '_-$* #,##0.00_-;-$* #,##0.00_-;_-$* "-"??_-;_-@_-' ); 
   $objPHPExcel->getActiveSheet() ->getStyle('R4:T'.$i) ->getNumberFormat() ->setFormatCode( '_-$* #,##0.00_-;-$* #,##0.00_-;_-$* "-"??_-;_-@_-' );   */
   #$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'My Data');
   #$objPHPExcel->addSheet($myWorkSheet, 0);
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Inventario_Administrador_Sin_Precio.xlsx"');
header('Cache-Control: max-age=0');

$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$objWriter->save('php://output');
exit;

?>