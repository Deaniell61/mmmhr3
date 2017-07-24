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
    $('#modal2').openModal();
});

$('.modaleliminar').click(function(){

    event.preventDefault();

    gobIDElim = event.target.dataset.elim;

    $('#modal3').openModal();

});




$(".dropdown-button").dropdown();

//*********************************************************




function mostrarCuentasP()
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
            url:"../core/controlador/cuentasPagarControlador.php",
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
function cargarDetalleCuentasP(id)
{
	var  trasDato;
	trasDato = 4;
		
        $.ajax
        ({
            type:"POST",
            url:"../core/controlador/cuentasPagarControlador.php",
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
					
                    
					
					 $('#resumenPVer').html(resp);
					  $('#resumenPEdit').html(resp);
					  

                }


            }     
        });
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
        url:"../core/controlador/cuentasPagarControlador.php",
        data:'id=' + id  + '&abono=' + abono  + '&fecha=' + fecha  + '&saldo=' + saldo  + '&descripcion=' + descripcion  + '&credito=' + credito  + '&trasDato=' + trasDato,
        success: function(resp)
        {


			
            $('#mensajecv').html(resp); 
            // $('#precargar').css('display','none');  
				alert(3);



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
        url:"../core/controlador/cuentasPagarControlador.php",
        data:'id=' + id  + '&trasDato=' + trasDato,
        success: function(resp)
        {



            $('#mensajecv').html(resp); 
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
        url:"../core/controlador/cuentasPagarControlador.php",
        data:'id=' + id  + '&trasDato=' + trasDato,
        success: function(resp)
        {



            $('#mensajeccV').html(resp); 
            // $('#precargar').css('display','none');  




        }     
    });            

}

$('.eliminar').click(function(event)
                     {

    var idelim, trasDato; 

    idelim=gobIDElim;

    trasDato = 3;


    $.ajax
    ({
        type:"POST",
        url:"../core/controlador/usuarioControlador.php",
        data:'idelim=' + idelim  + '&trasDato=' + trasDato,
        success: function(resp)
        {

            console.log(idelim);

            //$('#mensaje').html(resp); 
            //$('#precargar').css('display','none');  
            $("#user").val("");
            $("#password").val("");

            if(resp == '1')
            {

                //$('#mensaje').html('Datos Incorrectos.');         
                //$('#precargar').hide();    
            }
            else
            {

                setTimeout(window.location.reload(), 3000);


            }


        }     
    });            

});







$('.editar').click(function(event)
                   {

    event.preventDefault();

    var idedit, trasDato; 

    gobIDEdit = event.target.dataset.edit;

    idedit = gobIDEdit;

    $('#modal1').openModal();

    trasDato = 4;


    $.ajax
    ({
        type:"POST",
        url:"../core/controlador/usuarioControlador.php",
        data:'idedit=' + idedit  + '&trasDato=' + trasDato,
        success: function(resp)
        {



            $('#mensaje').html(resp); 
            // $('#precargar').css('display','none');  




        }     
    });            

});

$('#btnActualizar').click(function()
                          {

    var idedit, trasDato, user, pass, rol; 

    idedit = gobIDEdit;

    trasDato = 5;
    //$('#precargar').show();


    if($('#password').val()=="")
    {
        passHabilita=1;
    }

    if(passHabilita==1)
    {
        user = $('#user').val();

        pass = $('#password').val();

        rol = $('#rol').val();

        $.ajax
        ({
            type:"POST",
            url:"../core/controlador/usuarioControlador.php",
            data:' user=' +  user + '&pass=' + pass + '&rol=' + rol+ '&id=' + idedit + '&trasDato=' + trasDato,
            success: function(resp)
            {

                //console.log(trasDato);


                //$('#mensaje').html(resp); 
                // $('#precargar').css('display','none');  
                $("#user").val("");
                $("#password").val("");

                if(resp == '1')
                {


                    //$('#mensaje').html('Datos Incorrectos.');         
                    //$('#precargar').hide();    
                }
                else
                {


                    setTimeout(window.location.reload(), 3000);


                }


            }     
        });
    }
    else
    {
        alert('password erroneo');
    }


});