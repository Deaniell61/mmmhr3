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



$('.modaleliminar').click(function(){

    event.preventDefault();

    gobIDElim = event.target.dataset.elim;

    $('#modal3').openModal();

});




$(".dropdown-button").dropdown();

//*********************************************************
function mostrarInventario()
{
	var filto="";
 
        var porNombre=document.getElementsByName("filtro");
        
        for(var i=0;i<porNombre.length;i++)
        {
            if(porNombre[i].checked)
                filto=porNombre[i].value;
        }

	var  trasDato;
	trasDato = 3;
	
        $.ajax
        ({
            type:"POST",
            url:"../core/controlador/inventarioControlador.php",
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
function mostrarInventarioAdmin()
{
	var filto="";
 
        var porNombre=document.getElementsByName("filtro");
        
        for(var i=0;i<porNombre.length;i++)
        {
            if(porNombre[i].checked)
                filto=porNombre[i].value;
        }

	var  trasDato;
	trasDato = 4;
	
        $.ajax
        ({
            type:"POST",
            url:"../core/controlador/inventarioControlador.php",
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
function eliminaInven(prod,inv)
{
	if(confirm("Se eliminara este producto de inventario"))
	{
			var  trasDato;
		trasDato = 5;
		
			$.ajax
			({
				type:"POST",
				url:"../core/controlador/inventarioControlador.php",
				data:' prod=' +  prod + '&inv=' + inv + '&trasDato=' + trasDato,
				success: function(resp)
				{
	
				   if(resp == '1')
					{
	
	
						//$('#mensaje').html('Datos Incorrectos.');         
						//$('#precargar').hide();    
					}
					else
					{
						
						
						 $('#mensajeINA').html(resp); 
	
					}
	
	
				}     
			});
	}
}
function editar(id)
{
	$('#modal1').openModal();

	 var  trasDato;
	trasDato = 1;
	habilita(false);
        $.ajax
        ({
            type:"POST",
            url:"../core/controlador/inventarioControlador.php",
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
                    
					
					 $('#mensaje3').html(resp); 

                }


            }     
        });
}
function guardarInventario()
{
	

	 var  trasDato;
	trasDato = 2;
	id=document.getElementById('idproducto').value;
	id2=document.getElementById('idproducto2').value;
	precioG=document.getElementById('precioG').value;
	precioE=document.getElementById('precioE').value;
	precioM=document.getElementById('precioM').value;
	Minimo=document.getElementById('MinimoCant').value;
	costo=document.getElementById('costo').value;
	cantidad=document.getElementById('cantidad').value;
	
	
	nombre=document.getElementById('producto').value;
	marca=document.getElementById('marca').value;
	descripcion=document.getElementById('descripcion').value;
	
        $.ajax
        ({
            type:"POST",
            url:"../core/controlador/inventarioControlador.php",
            data:' id=' +  id + '&precioG=' + precioG + '&minimo=' + Minimo + '&costo=' + costo + '&cantidad=' + cantidad + '&precioE=' + precioE + '&precioM=' + precioM + '&nombre=' + nombre + '&marca=' + marca + '&descripcion=' + descripcion + '&prod=' + id2 + '&trasDato=' + trasDato,
            success: function(resp)
            {

               if(resp == '1')
                {


                    //$('#mensaje').html('Datos Incorrectos.');         
                    //$('#precargar').hide();    
                }
                else
                {
                    
					
					 $('#mensajeINA').html(resp); 

                }


            }     
        });
}
function calcula()
{
	precio=document.getElementById('precioG').value;
	
	pe=precio-(precio*(document.getElementById('precioEP').value/100));
	pm=precio-(precio*(document.getElementById('precioMP').value/100));
	
	
	document.getElementById('precioE').value=pe;
	document.getElementById('precioM').value=pm;
	
}
function habilita(ds)
{
	/*document.getElementById('producto').disabled=ds;
	document.getElementById('marca').disabled=ds;
	document.getElementById('descripcion').disabled=ds;*/
	document.getElementById('costo').disabled=ds;
	document.getElementById('cantidad').disabled=ds;
	document.getElementById('precioE').disabled=ds;
	document.getElementById('precioM').disabled=ds;
}

function printInv(tipo)
{
	
    switch(tipo)
	{
		case 1:
		{
			var filto="";
 
				var porNombre=document.getElementsByName("filtro");
				
				for(var i=0;i<porNombre.length;i++)
				{
					if(porNombre[i].checked)
						filto=porNombre[i].value;
				}

			setTimeout("location.href='../core/modelo/reportes/invExcelAdmin.php?tipo="+tipo+"&filtro="+filto+"'", 100);
			break;
		}
		case 2:
		{
			var filto="";
 
				var porNombre=document.getElementsByName("filtro");
				
				for(var i=0;i<porNombre.length;i++)
				{
					if(porNombre[i].checked)
						filto=porNombre[i].value;
				}

			setTimeout("location.href='../core/modelo/reportes/invExcelAdminWOP.php?tipo="+tipo+"&filtro="+filto+"'", 100);
			break;
		}
	}
	
		
	
}