<?php



function mostrarInventario()
{

    //creacion de la tabla
?>

<table id='tabla' class='bordered centered highlight responsive-table centrarT'>
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Producto</th>
            <th>Marca</th>
            <th>Descripcion</th>
            <th>Costo</th>
            <th>Cantidad</th>
            <th>Precio General</th>
            <th>Precio Especial</th>
            <th>Precio Mayorista</th>
            <th></th>
            
        </tr>
    </thead>
    <tbody>
        <?php

    $mysql = conexionMysql();
    $sql = "SELECT p.nombre,i.preciocosto,p.idproductos,p.codigoproducto,p.descripcion,i.precioCosto,i.precioVenta,i.precioClienteEs,i.precioDistribuidor,i.cantidad,p.marca2,p.codigoproducto FROM inventario i inner join productos p on p.idproductos=i.idproducto  and i.cantidad>=0";
    $tabla="";
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

                $tabla .= "<tr>";

                $tabla .="<td>"     .$fila["11"].    "</td>";
                $tabla .="<td>" .$fila["0"].      "</td>";
                $tabla .="<td>" .$fila["10"].      "</td>";
				  $tabla .="<td>" .$fila["4"].      "</td>";
				  $tabla .="<td>" .toMoney($fila["5"]).      "</td>";
				  $tabla .="<td>" .$fila["9"].      "</td>";
				  $tabla .="<td>" .toMoney($fila["6"]).      "</td>";
				  $tabla .="<td>" .toMoney($fila["7"]).      "</td>";
				  $tabla .="<td>" .toMoney($fila["8"]).      "</td>";
			$tabla .="<td class='anchoC'>";
	  if($_SESSION['SOFT_ACCESOModifica'.'inventario']=='1')
				{	
                $tabla .="<a class='waves-effect waves-light btn orange lighten-1 modal-trigger botonesm editar' onclick=\"editar('".$fila["0"]."')\"><i class='material-icons left'><img class='iconoeditcrud' src='../app/img/editar.png' /></i></a>";
				}
				 if($_SESSION['SOFT_ACCESOElimina'.'inventario']=='1')
				{
                $tabla .="<a class='waves-effect waves-light btn red lighten-1 modal-trigger botonesm modaleliminar' data-elim='".$fila["0"]."'><i class='material-icons left'><img class='iconoaddcrud' src='../app/img/boton-borrar.png' /></i></a></td>";
				}
               
                $tabla .= "</tr>";
            }

            $resultado->free();//librerar variable


            $respuesta = $tabla;
        }
    }
    else
    {
        $respuesta = "<div class='error'>Error: no se ejecuto la consulta a BD</div>";

    }

    //cierro la conexion
    $mysql->close();

    //debuelvo la variable resultado
    return printf($respuesta);
        ?>
    </tbody>
</table>
<?php

}

