    <div id="wrapper">
    	<div id="page-wrapper" class="gray-bg">
    		<div class="row border-bottom">
    			<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
    				<div class="navbar-header">
    					<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
    					<form role="search" class="navbar-form-custom" action="search_results.html">
    						<div class="form-group">
    							<!--     							<input type="number" placeholder="Search for something..." class="form-control" name="top-search" id="top-search"> -->
    						</div>
    					</form>
    				</div>
    				<ul class="nav navbar-top-links navbar-right">
    					<li class="dropdown">
    						<a href="<?=base_url();?>index.php/inventario/verpedido">
    							<span class="label label-primary"><?php echo $items; ?></span><span> Mi Pedido</span>
    						</a>
    					</li>
              <li>
              <a>
                <span class=""><i class="fa fa-user-circle"></i></span><span><?php echo $_SESSION['username']; ?></span>
              </a>
              </li>
    					<li>
    						<a href="<?=base_url();?>index.php/logout">
    							<i class="fa fa-sign-out"></i> Cerrar sesión
    						</a>
    					</li>
    				</ul>

    			</nav>
    		</div>
    		<div class="row wrapper border-bottom white-bg page-heading">
    			<div class="col-md-12">
    			 <center><h2>Agregar Productos al pedido</h2></center>
           <hr>
            <div class="col-lg-4 col-lg-offset-8"><span class="label"> <i class="fa fa-money"></i></span> <strong> Monto Acumulado: <?php echo number_format($this->cart->total(), 2, ',', '.') ?> BS.F</strong>
            </div>
            <hr>
            <br>
    				<div class="col-lg-3 col-lg-offset-8"><span class="label"> <i class="fa fa-money"></i></span><strong> Numero de piezas: <?php echo $this->cart->total_items() ?>
            </div> </strong>
    			</div>
    		</div>

    		<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    			<div class="row">
    			<br>
    				<div class="col-md-12">
    					<div class="col-md-6 col-md-offset-3">
    						<div class="form-group">
    							<div class="col-xs-8">
    								<input onkeyup="buscarEnTabla()" type="text" class="form-control" id="q" placeholder="Buscar partes..." >
    							</div>
    							<button type="button" class="btn btn-success" class='glyphicon glyphicon-search'></span> Buscar</button>
    						</div>
    					</div>
    					<br>
    					<br>
    					<div class="wrapper wrapper-content animated fadeInRight">
    						<div class="row">
    							<div class="col-md-12">
    								<div class="ibox float-e-margins">
    									<div class="ibox-title">
    										<h5>Lista de partes</h5>
    										<div class="ibox-tools">
    											<a class="collapse-link">
    												<i class="fa fa-chevron-up"></i>
    											</a>
    											<a class="close-link">
    												<i class="fa fa-times"></i>
    											</a>
    										</div>
    									</div>
    									<div class="ibox-content">

    										<div class="table-responsive">
    											<table id="table" class="table table-striped table-bordered table-hover dataTables-example" >
    												<thead>
    													<tr>
    														<th>Código</th>
    														<th>Aplicación</th>
    														<th>Marca</th>
    														<th>Descripción</th>
    														<th class='col-xs-1'>Ingrese la cantidad</th>
                                <th>Precio BsF con IVA</th>
    														<th>Precio sugerido de venta</th>
    														<th>Estatus</th>
    														<th class="text-right" data-sort-ignore="true">Accion</th>
    													</tr>
    												</thead>
    												<tbody id="tbody">

    													<?php foreach ($filters as $filter): ?>
    														<tr>
    															 <td><?php echo $filter->codigo ?></td>
    															<td class="center"><?php echo $filter->aplicacion; ?>
                                  <button id="filtro" name="filtro" onclick="filtrar(<?php echo $filter->aplicacion; ?>)" class="btn-white btn btn-xs">Filtrar</button>
                                  </td>
    															<td class="center"><?php echo $filter->marca; ?></td>
    															<td class="center"><?php echo $filter->descripcion; ?></td>
    															<td class="center">
					                        <?php if ($filter->cantidad < 1) {
	echo 'N/A';
} else {
	echo '<input type="number"  class="form-control col-xs-2" style="text-align:center; border: 1px solid #1ab394;" id="cantidad_';
	echo $filter->codigo . '">';
}
?>
                                  </td>
                                  <td class="center"><?php echo number_format($filter->precio_iva * 1, 0, ',', '.') ?></td>
    															<td class="center"><?php echo number_format($filter->precio_iva * 1.30, 0, ',', '.') ?></td>
    															<input type="hidden" value="<?php echo $filter->precio_iva; ?>" id="precio_<?php echo $filter->codigo ?>">
    															<input type="hidden" value="<?php echo $filter->marca; ?>" id="marca_<?php echo $filter->codigo ?>">
    															<input type="hidden" value="<?php echo $filter->descripcion; ?>" id="descripcion_<?php echo $filter->codigo ?>">
                                  <input type="hidden" value="<?php echo $filter->cantidad; ?>" id="sk_<?php echo $filter->codigo ?>">
                                  <input type="hidden" value="<?php echo $filter->aplicacion; ?>" id="aplicacion_<?php echo $filter->codigo ?>">
    															<td class="center">
    															<?php
if ($filter->cantidad >= 10 && $filter->cantidad < 20) {
	echo '<span class="badge badge-warning">Baja existencia</span>';
} else if ($filter->cantidad > 0) {
	echo '<span class="badge badge-success">Disponible</span>';
} else {
	echo '<span class="badge badge-danger">Agotado</span>';
}?>
    															</td>
    															<td class="center">
                        						<span>
                        							<a name="agregar" id="agregar" onclick="agregar(<?php echo "'" . $filter->codigo . "'" ?>)">
                        								<i class="glyphicon glyphicon-plus">
                        								</i>Agregar</a>
                        							</span>
                        						</td>
    														</tr>
    													<?php endforeach;?>
    												</tbody>
    											</table>
                          <center>
                          <ul id="pag" class="pagination pagination-lg">
                              <li><a>&laquo;</a></li>
                              <li><a onclick="paginar(0)" >1</a></li>
                              <li><a onclick="paginar(16)" >2</a></li>
                              <li><a onclick="paginar(31)" >3</a></li>
                              <li><a onclick="paginar(46)" >4</a></li>
                              <li><a onclick="paginar(61)" >5</a></li>
                              <li><a>&raquo;</a></li>
                          </ul>
                          </center>
    										</div>
    									</div>
    								</div>
    							</div>
    						</div>
    					</div>
<!--     			<div class="col-md-12">
    				<div class="pull-right">
    					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    						<i class="glyphicon glyphicon-plus count-info "><span class="label label-primary">
    							<?php $cont = 1;
if (isset($_REQUEST['agregar'])) {
	$cont++;
	echo $cont;
} else {echo $cont;}?></span></i> Pedido
    						</button>
    					</div>
    				</div> -->
    			</div>
    			<div class="outer_div" ></div><!-- Datos ajax Final -->
    		</div>
<script>
function buscarEnTabla() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("q");
  filter = input.value.toUpperCase();
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        //tr[i].style.display = "";
         document.getElementById("table").deleteRow(i);

      } else {
         document.getElementById("table").deleteRow(i);
      //  tr[i].style.display = "none";
      }
    }
  }
}

function clearTableComplete() {
  $("#tbody").empty();
}

function agregar(codigo) {
  const cantidad = $("#cantidad_" + codigo + "").val();
  const precio = $("#precio_" + codigo + "").val();
  const descripcion = $("#descripcion_" + codigo + "").val();
  const sk = $("#sk_" + codigo + "").val();
  const aplicacion = $("#aplicacion_" + codigo + "").val();

  if (cantidad < 1 || cantidad == undefined || cantidad == "") {
    alert("Ingrese un numero mayor que cero");
  } else {
    $.ajax({
      type: "post",
      url: '<?php echo base_url("index.php/inventario/agregarAlCarrito"); ?>',
      cache: false,
      data: {
        codigo: codigo,
        cantidad: cantidad,
        precio: precio,
        descripcion: descripcion,
        sk: sk,
        aplicacion: aplicacion
      },
      success: function(data) {
        window.location.assign("inventario/verpedido");
      }
    });
  }
}

function filtrar(aplicacion) {
  // oculto la paginacion
  $("#pag").hide();
  clearTableComplete();
  $.ajax({
    type: "post",
    url: '<?php echo base_url("index.php/inventario/filtrar"); ?>',
    cache: false,
    data: "busqueda=" + aplicacion,
    success: function(response) {
      var obj = JSON.parse(response);
      //      console.log(obj);
      if (obj.length > 0) {
        // var items=[];
        $.each(obj, function(i, val) {
          var venta = val.precio_iva * 1.30
          venta = numberForma(venta.toFixed(2))

          var precioFormat = numberForma(val.precio_iva)

          var existencia;
          var input;
          if (val.cantidad >= 10 && val.cantidad < 20) {
            existencia =
              '<span class="badge badge-warning">Baja existencia</span>';
          } else if (val.cantidad > 0) {
            existencia = '<span class="badge badge-success">Disponible</span>';
          } else {
            existencia = '<span class="badge badge-danger">Agotado</span>';
          }
          if (val.cantidad < 1) {
            input = "N/A";
          } else {
            input = `<input type="number"  class="form-control col-xs-2" style="text-align:center; border: 1px solid #1ab394;" id="cantidad_${val.codigo}">`;
          }
          $("#tbody").append(`
              <tr><td>${val.codigo}</td>
              <td class="center">${val.aplicacion}
              <button id="filtro" name="filtro" onclick="filtrar(${val.aplicacion})" class="btn-white btn btn-xs">Filtrar</button>
              </td>
              <td class="center">${val.marca}</td>
              <td class="center">${val.descripcion}</td>
              <td class="center">
              ${input}
              </td>
              <td class="center">${precioFormat}</td>
               <td class="center">${venta}</td>
              <input type="hidden" value="${val.precio_iva}" id="precio_${val.codigo}">
              <input type="hidden" value="${val.marca}" id="marca_${val.codigo}">
              <input type="hidden" value="${val.descripcion}" id="descripcion_${val.codigo}">
              <input type="hidden" value="${val.cantidad}" id="sk_${val.codigo}">
              <input type="hidden" value="${val.aplicacion}" id="aplicacion_${val.codigo}">
              <td class="center">
                ${existencia}
              </td>
              <td class="center">
                <span>
                  <a name="agregar" id="agregar" onclick="agregar('${val.codigo}')">
                    <i class="glyphicon glyphicon-plus">
                    </i>Agregar</a>
                  </span>
              </td>
            </tr>
              `);
        });
      }
    }
  });
}

function clearTable(cantidad) {
  var table = document.getElementById("table");
  var rowCount = table.rows.length;
  if (rowCount > cantidad) {
    table.deleteRow(rowCount - cantidad);
  }
}
function numberForma(x) {
    x = parseInt(x);
    x.toFixed(2);
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return parts.join(".");
}
function paginar(pagina) {
  var busqueda = $("#q").val();
  var pagina = parseInt(pagina);
  console.log(pagina);
  $.ajax({
    type: "post",
    url: '<?php echo base_url("index.php/inventario/searchPagination"); ?>',
    cache: false,
    data: { busqueda: busqueda, pagina: pagina },
    success: function(response) {
      var obj = JSON.parse(response);
      var cantidad = obj.length;
      if (obj.length > 0) {
        $.each(obj, function(i, val) {
          var venta = val.precio_iva * 1.30
          venta = numberForma(venta.toFixed(2))

          var precioFormat = numberForma(val.precio_iva)

          var existencia;
          var input;
          if (val.cantidad >= 10 && val.cantidad < 20) {
            existencia =
              '<span class="badge badge-warning">Baja existencia</span>';
          } else if (val.cantidad > 0) {
            existencia = '<span class="badge badge-success">Disponible</span>';
          } else {
            existencia = '<span class="badge badge-danger">Agotado</span>';
          }
          if (val.cantidad < 1) {
            input = "N/A";
          } else {
            input = `<input type="number"  class="form-control col-xs-2" style="text-align:center; border: 1px solid #1ab394;" id="cantidad_${val.codigo}">`;
          }
          $("#tbody").append(`
              <tr><td>${val.codigo}</td>
              <td class="center">${val.aplicacion}
              <button id="filtro" name="filtro" onclick="filtrar(${val.aplicacion})" class="btn-white btn btn-xs">Filtrar</button>
              </td>
              <td class="center">${val.marca}</td>
              <td class="center">${val.descripcion}</td>
              <td class="center">
              ${input}
              </td>
              <td class="center">${precioFormat}</td>
               <td class="center">${venta}</td>
              <input type="hidden" value="${val.precio_iva}" id="precio_${val.codigo}">
              <input type="hidden" value="${val.marca}" id="marca_${val.codigo}">
              <input type="hidden" value="${val.descripcion}" id="descripcion_${val.codigo}">
              <input type="hidden" value="${val.cantidad}" id="sk_${val.codigo}">
              <input type="hidden" value="${val.aplicacion}" id="aplicacion_${val.codigo}">
              <td class="center">
                ${existencia}
              </td>
              <td class="center">
                <span>
                  <a name="agregar" id="agregar" onclick="agregar('${val.codigo}')">
                    <i class="glyphicon glyphicon-plus">
                    </i>Agregar</a>
                  </span>
              </td>
            </tr>
              `);
          clearTable(cantidad + 1);
        });
      }
    }
  });
}

$("#q").keyup(function() {
  // muestro la paginacion
  if ($("#pag").hide()){
      $("#pag").show();
  }
  var busqueda = $("#q").val();
  $.ajax({
    type: "post",
    url: '<?php echo base_url("index.php/inventario/search"); ?>',
    cache: false,
    data: { busqueda: busqueda },
    success: function(response) {
      var obj = JSON.parse(response);
      var cantidad = obj.length;
      // console.log(obj);
      if (obj.length > 0) {
        $.each(obj, function(i, val) {
          var venta = val.precio_iva * 1.30
          venta = numberForma(venta.toFixed(2))

          var precioFormat = numberForma(val.precio_iva)

          var existencia;
          var input;
          if (val.cantidad >= 10 && val.cantidad < 20) {
            existencia =
              '<span class="badge badge-warning">Baja existencia</span>';
          } else if (val.cantidad > 0) {
            existencia = '<span class="badge badge-success">Disponible</span>';
          } else {
            existencia = '<span class="badge badge-danger">Agotado</span>';
          }
          if (val.cantidad < 1) {
            input = "N/A";
          } else {
            input = `<input type="number"  class="form-control col-xs-2" style="text-align:center; border: 1px solid #1ab394;" id="cantidad_${val.codigo}">`;
          }
          $("#tbody").append(`
              <tr><td>${val.codigo}</td>
              <td class="center">${val.aplicacion}
              <button id="filtro" name="filtro" onclick="filtrar(${val.aplicacion})" class="btn-white btn btn-xs">Filtrar</button>
              </td>
              <td class="center">${val.marca}</td>
              <td class="center">${val.descripcion}</td>
              <td class="center">
              ${input}
              </td>
              <td class="center">${precioFormat}</td>
               <td class="center">${venta}</td>
              <input type="hidden" value="${val.precio_iva}" id="precio_${val.codigo}">
              <input type="hidden" value="${val.marca}" id="marca_${val.codigo}">
              <input type="hidden" value="${val.descripcion}" id="descripcion_${val.codigo}">
              <input type="hidden" value="${val.cantidad}" id="sk_${val.codigo}">
              <input type="hidden" value="${val.aplicacion}" id="aplicacion_${val.codigo}">
              <td class="center">
                ${existencia}
              </td>
              <td class="center">
                <span>
                  <a name="agregar" id="agregar" onclick="agregar('${val.codigo}')">
                    <i class="glyphicon glyphicon-plus">
                    </i>Agregar</a>
                  </span>
              </td>
            </tr>
              `);
          clearTable(cantidad + 1);
        });
      }
    }
  });
});

</script>
