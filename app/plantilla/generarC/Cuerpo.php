   <!-- ********************************** tabla inicio ********************************** -->
 <!-- ********************************** tabla inicio ********************************** -->


      <div class="row">

         <div class="">
         	<ul>

             <li class="centrarli"><a id="compraL" href="#!" class="amber accent-3 btn white-text tamaniobot "><i class="material-icons left"><img class="iconotab" src="../app/img/detallec.png" /></i>Detalle Compra</a></li>


         	</ul>
          </div>


      <div class="col s12 ">


 <div id="mensajeC"></div>

          <div class="">
          				<div class="input-field col s5" hidden>


							<i class="material-icons prefix"><img class="iconologin" src="../app/img/carnet.png" /> </i>
										<input id="codigoCompra" type="text" class="validate">

							  </div>
                              <div class="input-field col s5" hidden>
                              <i class="material-icons prefix"><img class="iconologin" src="../app/img/carnet.png" /> </i>
										<input id="codigoProveedor" type="text" class="validate">

							  </div>
                    	<div class="input-field col s5">


							<i class="material-icons prefix"><img class="iconologin" src="../app/img/carnet.png" /> </i>
										<input id="NIT" type="text" onKeyUp="buscarProveedor(this,event);siguiente(event,'Proveedor');" class="validate" autofocus>
										 <label for="icon_prefix" ><span class="etiquelogin">NIT </span></label>
							  </div>
                              <div class="input-field col s5">

										 <i class="material-icons prefix"><img class="iconologin" src="../app/img/usuario.png" /> </i>
										<input id="Proveedor" type="text" onKeyUp="buscarProveedor(this,event);siguiente(event,'direccionC');" class="validate">
										 <label for="icon_prefix" ><span class="etiquelogin">Proveedor </span></label>
							  </div>



                                <div class="input-field col s10">
								  <i  class="material-icons prefix"><img class="iconologin" src="../app/img/calle.png"/></i>
								  <input id="direccionC" type="text" class="validate" onKeyUp="siguiente(event,'fecha');">
								  <label for="icon_telephone" ><span class="etiquelogin">Direccion</span></label>
							  </div>


                                <div class="input-field col s5">
                                  <i  class="material-icons prefix"><img class="iconologin" src="../app/img/fecha.png"/></i>
								  <input  id="fecha" type="date" class="validate" onKeyUp="siguiente(event,'factura');" value="<?php echo date('Y-m-d')?>" onChange="cambiarFecha(this.value,document.getElementById('codigoCompra').value);" >
								  <label class="active" for="fecha" >Fecha</label>
								</div>


                                <div class="input-field col s5">
								  <i  class="material-icons prefix"><img class="iconologin" src="../app/img/factura.png"/></i>
								  <input id="factura" type="text" class="validate numerico" onKeyUp="siguiente(event,'tipoCompra');" onBlur="agregarFactura(this.value,document.getElementById('codigoCompra').value);">
								  <label for="icon_telephone" ><span class="etiquelogin">No Factura</span></label>
							  </div>


                               <div class="input-field col s10">
                               <i  class="material-icons prefix"><img class="iconologin" src="../app/img/TipoC.png"/></i>
								<select id="tipoCompra" onChange="cambiarTipo(this.value,document.getElementById('codigoCompra').value);comprobarCredito(this);buscarPlazoCuentaPagar();">
								  <option value="" disabled selected>Credito/Contado/Donación</option>
								  <option value="2">Credito</option>
								  <option value="1" selected>Contado</option>
								  <option value="3">Donación</option>
								</select>
								<label>Tipo de Compra</label>
							  </div>
          					<div id="cuentasContenedor" hidden>
                                 <div class="input-field col s5">
                               <i  class="material-icons prefix"><img class="iconologin" src="../app/img/TipoC.png"/></i>
								<select id="tipoPlazo" onChange="ingresoCuentaPagar()">
								  <option value="" disabled selected>Dia/Mes/Año</option>
								  <option value="1">Dia</option>
								  <option value="2">Mes</option>
								  <option value="3">Año</option>
								</select>
								<label>Tipo de Plazo</label>
							  </div>


                                <div class="input-field col s5">
                                  <i  class="material-icons prefix"><img class="iconologin" src="../app/img/fecha.png"/></i>
								  <input  id="plazo" type="number" onChange="ingresoCuentaPagar()" class="validate">
								  <label class="active" for="fecha" >Plazo</label>
								</div>

           						</div>


				<!-- reumen -->
				<center>

				  	<table>
          					  <tr>
              					  <td class="">
              					      <div class="input-field " id="botonNuevo" hidden>
               					         <center>
                                 <a id="modalnuevo" class="waves-effect waves-light btn blue lighten-1 modal-trigger botonesr " ><i class="material-icons left"><img class="iconoaddcrud" src="../app/img/anadir.png" /></i>Nuevo</a>
                               </center>
                					    </div>
               					 </td>

           					 </tr>
        		 	</table>
				<div id="totalCompra" class="total">
                	0
                </div>
				 <div id="resumenC"   >



					 </div>
            </center>

             <div class="input-field " id="botonGuardar" hidden>
                       <center>
                        <a onClick="agregaInvetario();" class="waves-effect waves-light btn blue lighten-1 modal-trigger botonG " ><i class="material-icons left"><img class="iconoaddcrud" src="../app/img/guardar.png" /></i>Guardar</a>
                      </center>
                    </div>
           </div>


      </div>







 </div>

















          <!-- ********************************** modal ********************************** -->

          <!-- nuevo --->

          <div id="modal1" class="modal">
              <div class="modal-content">

                  <div id="mensaje"></div>
                      <div class="row">
                          <div class="nav-wrapper grey darken-4">
                              <div>
                                  <p class="encabezadotextomodal"> Compras </p>

                                  <a id="modalcerrar1" onClick="cierre();" class=" modal-action modal-close  waves-effect waves-light right  " ><i class="material-icons prefix"><img class="iconocerrarmodal" src="../app/img/desenfrenado.png"></i></a>
                              </div>

                          </div>
                      </div>



                   <div class="12">
                     <div class="row">


							  <div class=" col s4">
                  <div style="display: none" class="">
                             <p>
                           <input  type="checkbox" id="Moto" checked="checked" />
                           <label for="Moto">Moto</label>
                           <input   type="checkbox" id="Carro"  />
                           <label for="Carro">Carro</label>
                           </p>

                 </div>
							 	<div id="productosCompra" class="alto">

                                    </div>


							 </div>

                              <div class=" col s8">


                               					<div class="input-field col s8" hidden>
													  <i  class="material-icons prefix"><img class="iconologin" src="../app/img/codigo.png"/></i>
													  <input id="codigo" type="text" class="validate">
													  <label for="icon_telephone" ><span class="etiquelogin">Codigo</span></label>
												 </div>
												 <div class="input-field col s8">
													  <i  class="material-icons prefix"><img class="iconologin" src="../app/img/codigo.png"/></i>
													  <input id="nombreC" onKeyUp="buscaProducto(this)" type="text" class="validate" autofocus>
													  <label for="icon_telephone" ><span class="etiquelogin">Codigo</span></label>
												 </div>


												  <div class="input-field col s8 ">
													  <i  class="material-icons prefix"><img class="iconologin" src="../app/img/producto.png"/></i>
													  <input id="Producto" onKeyUp="buscaProducto(this)" type="text" class="validate">
													  <label for="icon_telephone" ><span class="etiquelogin">Producto</span></label>
												  </div>
												  <div class="input-field col s8 ">
													  <i  class="material-icons prefix"><img class="iconologin" src="../app/img/marca.png"/></i>
													  <input id="marca" onKeyUp="buscaMarca(this)" type="text" class="validate">
													   <label for="icon_telephone" ><span class="etiquelogin">Marca</span></label>
                                                        <center>
															 <div class="listaMarca" id="listaMarca">


															 </div>
                                                         </center>
												  </div>
												   <div class="input-field col s8 ">
													  <i  class="material-icons prefix"><img class="iconologin" src="../app/img/descripcion.png"/></i>
													  <input id="descripcion" type="text" class="validate" onKeyUp="siguiente(event,'fecha');">
													  <label for="icon_telephone" ><span class="etiquelogin">Descripcion</span></label>
												  </div>

												  <div class="input-field col s8">
                                                    <i  class="material-icons prefix"><img class="iconologin" src="../app/img/tipoR.png"/></i>
                                                    <select id="tipoRepuesto" onChange="cambiarTipoProd(this.value,document.getElementById('codigo').value)">
                                                      <option value="" disabled selected>Moto/Carro</option>
                                                      <option value="1">Moto</option>
                                                      <option value="2">Carro</option>

                                                    </select>
                                                    <label>Tipo de Repuesto</label>
                                                  </div>

                                                   <div class="input-field col s5" id="agregarProd">
                                                  <a  id="agregarProd2" onClick="ingresoProducto(document.getElementById('codigo').value);" class=" modal-action waves-effect waves-light btn blue lighten-1 " >Agregar Producto</a>
                                                  </div>

                                           <div id="retoCompra" hidden>
												   <div class="input-field col s8 ">
													  <i  class="material-icons prefix"><img class="iconologin" src="../app/img/cantidad.png"/></i>
													  <input id="Cantidad" type="text" class="validate" onKeyUp="siguiente(event,'precioC');">
													  <label for="icon_telephone" ><span class="etiquelogin">Cantidad</span></label>
												  </div>



												   <div class="input-field col s8 ">


													  <i  class="material-icons prefix"><img class="iconologin" src="../app/img/precioCosto.png"/></i>
													  <input id="precioC" type="text" class="validate" onKeyUp="siguiente(event,'precioG');">
													  <label for="icon_telephone" ><span class="etiquelogin">Precio Costo</span></label>
												  </div>

												   <div class="input-field col s8 ">
													  <i  class="material-icons prefix"><img class="iconologin" src="../app/img/precioGeneral.png"/></i>
													  <input id="precioG" type="text" class="validate" onKeyUp="siguiente(event,'precioE');calcularPrecios('precioE','precioM',this.value);">
													  <label for="icon_telephone" ><span class="etiquelogin">Precio Venta general</span></label>
												  </div>

												   <div class="input-field col s8 ">
													  <i  class="material-icons prefix"><img class="iconologin" src="../app/img/precioEspecial.png"/></i>
													  <input id="precioE" type="text" class="validate" onKeyUp="siguiente(event,'precioM');">
													  <label for="icon_telephone" ><span class="etiquelogin">Precio Venta Especial</span></label>

												  </div>

												  <div class="input-field col s8 ">
													  <i  class="material-icons prefix"><img class="iconologin" src="../app/img/precioMayoreo.png"/></i>
													  <input id="precioM" type="text" class="validate" onKeyUp="siguiente(event,'compra1');">
													  <label for="icon_telephone" ><span class="etiquelogin">Precio Mayoreo</span></label>
												  </div>


</div>


								</div>


              </div>
                   </div>

              <div class="modal-footer">
                  <a id="modalnuevo" onClick="ingresoCompra(document.getElementById('codigo').value);" class=" modal-action waves-effect waves-light btn blue lighten-1 " >Aceptar</a></div>
 <script>inicio();</script>

              </div>
          </div>
          <!-- nuevo fin --->



          <!-- modal Busqueda -->

          <div id="modal4" class="modal">
              <div class="modal-content">

                  <div id="mense"></div>
                      <div class="row">
                          <div class="nav-wrapper grey darken-4">
                              <div>
                                  <p class="encabezadotextomodal"> Ingreso de Proveedores</p>

                                  <a id="modalcerrar1"  onClick="cierre();" class=" modal-action modal-close  waves-effect waves-light right  " ><i class="material-icons prefix"><img class="iconocerrarmodal" src="../app/img/desenfrenado.png"></i></a>
                              </div>

                          </div>
                      </div>
                <div id="proveedorContenedor">

                </div>
                  </form>
              </div>

          </div>

          <!-- Busqueda Fin -->

           <!-- modal Producto -->

          <div id="modal5" class="modal">
              <div class="modal-content">
                  <form class="col s8">
                      <div class="row">
                          <div class="nav-wrapper grey darken-4">
                              <div>
                                  <p class="encabezadotextomodal"> Productos </p>

                                  <a id="modalcerrar" class="  modal-close waves-effect waves-light right  " ><i class="material-icons prefix"><img class="iconocerrarmodal" src="../app/img/desenfrenado.png"></i></a>
                              </div>

                          </div>
                      </div>
                <div id="productoContenedor">
                hola mundo kñjkñldasfkljñdfaskljñdfas
                </div>
                  </form>
              </div>

          </div>

          <!-- Producto Fin -->

          <!-- ********************************** modal fin ********************************** -->
