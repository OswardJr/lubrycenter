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
    						<a href="<?= base_url();?>index.php/inventario">
    							<span class="label label-primary"><?php echo $items; ?></span><span> Volver al listado</span>
    						</a>
    					</li>
              <li>
              <a>
                <span class=""><i class="fa fa-user-circle"></i></span><span><?php echo $_SESSION['username']; ?></span>
              </a>
              </li>
    					<li>
    						<a href="<?= base_url();?>index.php/logout">
    							<i class="fa fa-sign-out"></i> Cerrar sesión
    						</a>
    					</li>
    				</ul>

    			</nav>
    		</div>
    		<div class="row wrapper border-bottom white-bg page-heading">
    			<div class="col-lg-10">
    				<center><h2>Confirmar pedido</h2></center>
    			</div>

    		</div>
    		<div class=" ecommerce">
    			<div class="row">
    				<br>
    				<div class="col-md-12">
    					<div class="ibox float-e-margins">
    						<div class="ibox-title">
    							<h5>Datos del pedido</h5>
    							<div class="ibox-tools">
    								<a class="collapse-link">
    									<i class="fa fa-chevron-up"></i>
    								</a>
    								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
    									<i class="fa fa-wrench"></i>
    								</a>
    								<ul class="dropdown-menu dropdown-user">
    									<li><a href="#">Config option 1</a>
    									</li>
    									<li><a href="#">Config option 2</a>
    									</li>
    								</ul>
    								<a class="close-link">
    									<i class="fa fa-times"></i>
    								</a>
    							</div>
    						</div>
    						<div class="ibox-content">
    							<div class="row">
                   <div class="col-md-12">
                     <div class="panel-body">
                      <div class="row">
                      <!-- strtoupper() convierte el string en mayusculas -->
                        <div class="col-md-6"><p><strong>RIF : </strong> <?php echo strtoupper($this->session->rif) ?></p></div>
                        <div class="col-md-6"><p><strong>Razon social :</strong> <?php echo strtoupper($this->session->username) ?></p></div>
                        <div class="col-md-6"><p><strong>Dirección :</strong> <?php echo strtoupper($this->session->direccion) ?></p></div>
                        <div class="col-md-6"><p><strong>Telefono :</strong> <?php echo strtoupper($this->session->telefono) ?></p></div>
                        <div class="col-md-6"><p><strong>Correo :</strong> <?php echo strtoupper($this->session->email) ?></p></div>
                      </div>
                    </div>
                  </div>
                </div
  >            </div>
            </div>
          </div>
          <div class="">
           <div class="col-md-12">
            <div class="ibox float-e-margins">
             <div class="ibox-title">
              <h5>Lista de piezas</h5>
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
                <th>Descripción</th>
                <th class='col-xs-1'>Cantidad</th>
                <th>Precio BsF (sin IVA)</th>
                <th>Acumulado</th>
                <th class="text-right" data-sort-ignore="true">Acción</th>
              </tr>
            </thead>
            <tbody id="tbody">
             <?php foreach ($productos as $producto): ?>
              <tr>
               <td><?php echo $producto['id'] ?></td>
               <td><?php echo $producto['name'] ?></td>
               <td><?php echo $producto['qty'] ?></td>
               <td><?php echo number_format($producto['price'] / 1.12, 2, ',', '.') ?></td>
               <td><?php echo number_format($producto['qty'] * $producto['price'] / 1.12, 2, ',', '.') ?></td>
               <td class="center">
                <span>
                  <a name="agregar" id="agregar" onclick="eliminar(<?php echo "'" . $producto['rowid'] . "'" ?>)">
                    <i class="glyphicon glyphicon-trash">
                    </i> Eliminar</a>
                  </span>
                </td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
        <div class="col-xs-4  col-xs-offset-8 " style="padding-right: 0px;">
          <table id="example1" class="table table-bordered table-striped">
            <tr >
              <td class="col-xs-1">Subtotal</td>
              <td class="col-xs-2"><input disabled="true" id="subtotal" type="text" name="subtotal" value="<?php echo number_format($this->cart->total() - ($this->cart->total() - $this->cart->total() / 1.12), 2, ',', '.'); ?>" class="form-control "
                ></td>
              </tr>
              <tr>
                <td class="col-xs-1">IVA: </td>
                <td class="col-xs-2"><input id="iva" disabled="true" type="text" name="impuesto" value="<?php echo number_format($this->cart->total() - $this->cart->total() / 1.12, 2, ',', '.') ?>" class="form-control" ></td>
              </tr>
              <tr>
                <td class="col-xs-1">Total</td>
                <td class="col-xs-2"><input id="total" disabled="true" type="text" name="total" class="form-control" value="<?php echo number_format($this->cart->total(), 2, ',', '.') ?>" ></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <center>
    <button  type="button" class="btn btn-primary " onclick="guardarPedido()" >GUARDAR</button>
    <button  type="button" class="btn btn-warning  " ><a style="color: #ffffff;" href="<?= base_url();?>/inventario"><span>SEGUIR AGREGANDO</span></a> </button>
    <br><br><br>
  </center>
</div>
      <center><b>** PRECIOS SUJETOS A CAMBIOS SIN PREVIO AVISO **</b></center>
      <center><b>** PRESUPUESTO SUJETO A DISPONIBILIDAD **</b></center>
      <br>
      <hr>
</div>
</div>
<script src="<?= base_url();?>assets/js/axios.min.js"></script>
<script type="text/javascript">
function eliminar(codigo) {
  if (confirm('¿ Realmente desea eliminar este producto de su pedido?')) {
    // jquery ajax
    $.ajax({
      type: 'post',
      url: '<?php echo base_url("index.php/inventario/destroyItem"); ?>',
      cache: false,
      data: {
        codigo: codigo
      },
      success: function(data) {
        location.reload()
      }
    })
  }
}
function guardarPedido() {
  // axios ajax
  axios
    .get('<?php echo base_url("index.php/inventario/savePedido"); ?>')
    .then(function(res) {
      if (res.data.status == false) {
        alert('No hay productos agredados')
      } else {
        alert('Pedido generado exitosamente, el comprobante de su pedido le llegara via correo electronico.')
          location.replace('<?php echo base_url("index.php/pedidos"); ?>');
      }
    })
    .catch(function(error) {
      console.log(error)
    })
}

</script>
