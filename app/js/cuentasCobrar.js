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
    $('#modal1').openModal();
});

$('.modaleliminar').click(function(){

    event.preventDefault();

    gobIDElim = event.target.dataset.elim;

    $('#modal3').openModal();

});




$(".dropdown-button").dropdown();

//*********************************************************

function mostrarCuentasC()
{
	var filto="";
 
        var porNombre=document.getElementsByName("filtro");
        
        for(var i=0;i<porNombre.length;i++)
        {
            if(porNombre[i].checked)
                filto=porNombre[i].value;
        }

	var  trasDato;
	trasDato = 13;
	
        $.ajax
        ({
            type:"POST",
            url:"../core/controlador/cuentasCobrarControlador.php",
            data:' tipo=' +  filto + '&trasDato=' + trasDato,
            success: function(resp)
            {

               if(resp == '1')
                {


                    //$('#mensaje').html('Datos Incorrectos.');         
                    //$('#precargar').hide();    
                }
                else
                {
                    
					
					 $('#tablaMostrar').html(resp); 
					 
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

                }


            }     
        });
}
function cargarDetalleCuentasC(id)
{
	var  trasDato;
	trasDato = 4;
		
        $.ajax
        ({
            type:"POST",
            url:"../core/controlador/cuentasCobrarControlador.php",
            data:' id=' +  id + '&trasDato=' + trasDato,
            success: function(resp)
            {

               if(resp == '1')
                {


                    //$('#mensaje').html('Datos Incorrectos.');         
                    //$('#precargar').hide();    
                }
                else
                {
					
                    
					
					 $('#resumenCVer').html(resp);
					  $('#resumenCEdit').html(resp);
					  

                }


            }     
        });
}
function limpiarAbono()
{
	document.getElementById('Monto').value='';
	document.getElementById('descripcion').value='';
	document.getElementById('Monto').focus();
	document.getElementById('descripcion').focus();
}
function abonarCuenta()
{
	 
    var idedit, trasDato; 

    trasDato = 5;
	var abono=document.getElementById('MontoED').value;
	var fecha=document.getElementById('fechaPagoED').value;
	var descripcion=document.getElementById('descripcionED').value;
	var saldo=document.getElementById('saldoED').value;
	var credito=document.getElementById('totalCreditoED').value;
	var id=document.getElementById('codigo').value;

    $.ajax
    ({
        type:"POST",
        url:"../core/controlador/cuentasCobrarControlador.php",
        data:'id=' + id  + '&abono=' + abono  + '&fecha=' + fecha  + '&saldo=' + saldo  + '&descripcion=' + descripcion  + '&credito=' + credito  + '&trasDato=' + trasDato,
        success: function(resp)
        {



            $('#mensajecc').html(resp); 
            // $('#precargar').css('display','none');  




        }     
    });            

}
function editar(id)
{
	 
    var idedit, trasDato; 

    $('#modal1').openModal();

    trasDato = 2;


    $.ajax
    ({
        type:"POST",
        url:"../core/controlador/cuentasCobrarControlador.php",
        data:'id=' + id  + '&trasDato=' + trasDato,
        success: function(resp)
        {



            $('#mensajecc').html(resp); 
            // $('#precargar').css('display','none');  




        }     
    });            

}
function ver(id)
{
	 
    var idedit, trasDato; 

    $('#modal2').openModal();

    trasDato = 3;


    $.ajax
    ({
        type:"POST",
        url:"../core/controlador/cuentasCobrarControlador.php",
        data:'id=' + id  + '&trasDato=' + trasDato,
        success: function(resp)
        {



            $('#resumenCVer').html(resp); 
            // $('#precargar').css('display','none');  




        }     
    });            

}
