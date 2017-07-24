//************************** globales *********************
var gobIDElim,gobIDEdit;
var passHabilita=0;
//**************************************************
//*************************Iniciales
/*$('#contenidoCrud').mouseenter(function(){
    document.getElementById('formUser').reset();
});
*/
//***********************************
//************************** tabla ***********************
$('#tabla').DataTable( {

    info:     false,



    language: {

        search: "Buscar",
        sLengthMenu:" _MENU_ ",

        paginate:{

            previous: "Anterior",
            next: "Siguiente",

        },

    },
    /*
			   "scrollY":        "375px",
        "scrollCollapse": true,
        "paging":         true
         */
} );

$('select').material_select(); 

//*********************************************************

//*************** modal ***********************************
$('#modalnuevo').click(function(){
    $('#btnActualizar').hide();
    $('#btnInsertar').show();
    $('#modal1').openModal();
});

$('#modalVer').click(function(){
    $('#btnActualizar').hide();
    $('#btnInsertar').show();
    $('#modal2').openModal();
});

function eliminar(id)
{
                     
    gobIDElim = id;
	
	$('#modal3').openModal();
	$('#contraElim').focus();
	
}




$(".dropdown-button").dropdown();

//*********************************************************

function ingresoGasto()
{
	
	var  trasDato;
	trasDato = 9;
		
		var fecha=document.getElementById('fecha').value;
		var descripcion=document.getElementById('descripcion').value;
		var monto=document.getElementById('monto').value;
		
        $.ajax
        ({
            type:"POST",
            url:"../core/controlador/pagosControlador.php",
            data:' fecha=' + fecha + '&descripcion=' + descripcion + '&monto=' + monto + '&trasDato=' + trasDato,
            success: function(resp)
            {

               if(resp == '1')
                {


                    //$('#mensaje').html('Datos Incorrectos.');         
                    //$('#precargar').hide();    
                }
                else
                {
					
                    
					
					 $('#mensajeGastos').html(resp);
					  

                }


            }     
        });
	
	
}

function EliminarGasto(contra)
{
	var  trasDato;
	trasDato = 10;
		
		
        $.ajax
        ({
            type:"POST",
            url:"../core/controlador/pagosControlador.php",
            data:' contra=' +  contra + '&id=' + gobIDElim + '&trasDato=' + trasDato,
            success: function(resp)
            {

               if(resp == '1')
                {


                    //$('#mensaje').html('Datos Incorrectos.');         
                    //$('#precargar').hide();    
                }
                else
                {
					
                    
					
					 $('#reselim').html(resp);
					  

                }


            }     
        });
}