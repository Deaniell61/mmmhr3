<?php


include("configActivado.php");

function mostrar()
{
    $mysql = conexionMysql();
    $sql = "SELECT * FROM usuario";

    if($resultado = $mysql->query($sql))
    {

        if(mysqli_num_rows($resultado)==0)
        {

            $respuesta = "<div class='error'>No hay super heroes BD vacia</div>";

        }

        else
        {




            //creacion de la tabla
            $tabla ="<table id='tabla' class='tabla'>";
            $tabla .="<thead>";
            $tabla .="<tr>";
            $tabla .="<th>ID</th>";
            $tabla .="<th>Nombre</th>";
            $tabla .="<th>Email</th>";
            $tabla .="<th></th>";
            $tabla .="<th></th>";
            $tabla .="</tr>";
            $tabla .="</thead>";

            $table .= "<tbody>";

            while($fila = $resultado->fetch_assoc())
            {

                $tabla .= "<tr>";

                $tabla .="<td>"     .$fila["id"].    "</td>";
                $tabla .="<td><h2>" .$fila["nombre"].      "</h2></td>";
                $tabla .="<td><h2>" .$fila["email"].      "</h2></td>";
                $tabla .="<td>  Editar   </td>";
                $tabla .="<td>  Eliminar </td>";
                $tabla .= "</tr>";


            }

            $resultado->free();//librerar variable
            $table .= "</tbody>";
            $tabla .= "</table>";



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

}

mostrar();


?>