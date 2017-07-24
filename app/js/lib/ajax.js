

$('#logout').click(function(){

    cerrarSesion();

});


$('#logoutR').click(function(){

    cerrarSesion();

});

function mostrar(){
$('#globoN').toggle();
//alert("mostrar");
}





$('.row').click(function(){

    document.getElementById('globoNotificacion').hidden=true;

});
$('#contenidoCrud').click(function(){

    document.getElementById('globoNotificacion').hidden=true;

});

function cerrarSesion()
{
    var trasDato;

     trasDato = 66;
   $.ajax
   ({
      type:"POST",
      url:"../core/controlador/usuarioControlador.php",
     data:'trasDato=' + trasDato,
      success: function(resp)
       {
           location.href=resp;

       }
   });
}

function envioCorreo(destino,mensaje,copia)
{
    var trasDato;

     trasDato = 67;
   $.ajax
   ({
      type:"POST",
      url:"../core/controlador/usuarioControlador.php",
     data:'destino=' + destino + '&mensaje=' + mensaje + '&copia=' + copia+ '&trasDato=' + trasDato,
      success: function(resp)
       {
           console.log(resp);

       }
   });
}
function siguiente(evt,id)
{
	if(evt.keyCode=='13')
	{
		if(id=="compra1")
		{
			ingresoCompra(document.getElementById('codigo').value);
		}
		document.getElementById(id).focus();
	}
}
function cierre()
{
	$('.lean-overlay').css('display','none');

}


function printDiv(divName)
{
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
	 location.reload();
}

function printCoti(divName)
{
	 var encab="<div class=\"navbar-fixed\"><nav><div class=\"nav-wrapper grey darken-4\"><a  class=\"brand-logo\"><img class=\"logo\" src=\"../app/img/logoHectoRepuestos.png\"/></a><div style=\"height: 18px; text-align:right;\">Hector Repuestos</div><div  style=\"height: 18px; text-align:right;\">\"Soluciones con Experiencia\"</div><div  style=\"height: 18px; text-align:right;\">Direccion: Retalhuleu</div><div  style=\"height: 18px; text-align:right;\">Tel. 77737775</div><div  style=\"height: 18px; text-align:right;\">Cel. 42207608</div></div></nav></div><br><p>Cliente: "+document.getElementById('Cliente').value+"</p>";
     var printContents = document.head.innerHTML+encab+document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     print();

     document.body.innerHTML = originalContents;
	 location.reload();
}


function toMoney(input)
{
		input.value=(currency(input.value));

}

function currency(value, decimals, separators) {
	value=value.replace("Q","");
    decimals = decimals >= 0 ? parseInt(decimals, 0) : 2;
    separators = separators || [',', ",", '.'];
    var number = (parseFloat(value) || 0).toFixed(decimals);
    if (number.length <= (4 + decimals))
        return "Q"+number.replace('.', separators[separators.length - 1]);
    var parts = number.split(/[-.]/);
    value = parts[parts.length > 1 ? parts.length - 2 : 0];
    var result = value.substr(value.length - 3, 3) + (parts.length > 1 ?
        separators[separators.length - 1] + parts[parts.length - 1] : '');
    var start = value.length - 6;
    var idx = 0;
    while (start > -3) {
        result = (start > 0 ? value.substr(start, 3) : value.substr(0, 3 + start))
            + separators[idx] + result;
        idx = (++idx) % 2;
        start -= 3;
    }
    return 'Q'+(parts.length == 3 ? '-' : '') + result;
}
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	//alert(charCode);
    if (charCode > 31 && (charCode < 48 || charCode > 57))
	{
		if(charCode==46)
		{
			return true;
		}
		else
		{
        	return false;
		}
    }
    return true;
}
