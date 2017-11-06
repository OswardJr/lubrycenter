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
    							<span class="label label-primary"></span><span> Home</span>
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
    			<div class="col-md-12">
    				<center><h2>Pedido numero <?php echo $pedido->id; ?></h2></center>
    			</div>

    		</div>
    		<div class=" ecommerce">
    			<div class="row">
    				<br>
    				<div class="col-md-12">
    					<div class="ibox float-e-margins">
    						<div class="ibox-title">
    							<h5>Datos del cliente</h5>
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
    						<div class="row">
    							<div class="col-md-12">
                   <div class="ibox-content">
                     <div class="panel-body">
                      <div class="row">
                      <!-- strtoupper() convierte el string en mayusculas -->
                        <div class="col-md-6"><p><strong>RIF : </strong> <?php echo strtoupper($cliente->rif) ?></p></div>
                        <div class="col-md-6"><p><strong>Razon social :</strong> <?php echo strtoupper($cliente->razon_social) ?></p></div>
                        <div class="col-md-6"><p><strong>Dirección :</strong> <?php echo strtoupper($cliente->direccion) ?></p></div>
                        <div class="col-md-6"><p><strong>Telefono :</strong> <?php echo strtoupper($cliente->telefono_pers_contacto) ?></p></div>
                        <div class="col-md-6"><p><strong>Correo :</strong> <?php echo strtoupper($cliente->correo) ?></p></div>
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
             <table id="table" class="table table-striped table-bordered table-hover" >
              <thead>
               <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th class='col-xs-1'>Cantidad</th>
                <th>Precio BsF (IVA incluido)</th>
                <th>Acumulado</th>
              </tr>
            </thead>
            <tbody id="tbody">
             <?php foreach ($partes as $producto): ?>
              <tr>
               <td><?php echo $producto['codigo'] ?></td>
               <td><?php echo $producto['descripcion'] ?></td>
               <td><?php echo $producto['det'] ?></td>
               <td><?php echo number_format($producto['precio_iva'] / 1.12, 2, ',', '.') ?></td>
               <td><?php echo number_format($producto['det'] * $producto['precio_iva'] / 1.12, 2, ',', '.') ?></td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
        <div class=" col-md-4  col-md-offset-8 " style="padding-right: 0px;">
          <table id="example1" class="table table-bordered table-striped">
            <tr >
              <td class="col-md-1">Subtotal</td>
              <td class="col-md-2"><input disabled="true" id="subtotal" type="text" name="subtotal" value="<?php echo number_format($pedido->monto - ($pedido->monto - $pedido->monto / 1.12), 2, ',', '.'); ?>" class="form-control "
                ></td>
              </tr>
              <tr>
                <td class="col-md-1">IVA: </td>
                <td class="col-md-2"><input id="iva" disabled="true" type="text" name="impuesto" value="<?php echo number_format($pedido->monto - $pedido->monto / 1.12, 2, ',', '.') ?>" class="form-control" ></td>
              </tr>
              <tr>
                <td class="col-md-1">Total</td>
                <td class="col-md-2"><input id="total" disabled="true" type="text" name="total" class="form-control" value="<?php echo number_format($pedido->monto, 2, ',', '.') ?>" ></td>
              </tr>
            </table>
          </div>
        </div>
        </div>
    </div>
  </div>
</div>
      <center><b>** PRECIOS SUJETOS A CAMBIOS SIN PREVIO AVISO **</b></center>
      <center><b>** PRESUPUESTO SUJETO A DISPONIBILIDAD **</b></center>
      <br>
</div>
	<script src="<?= base_url();?>assets/js/bootstrap.min.js"></script>
