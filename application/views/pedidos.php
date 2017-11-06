 <div id="wrapper">
      <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
          <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
              <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
              <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                  <!--                  <input type="number" placeholder="Search for something..." class="form-control" name="top-search" id="top-search"> -->
                </div>
              </form>
            </div>
            <ul class="nav navbar-top-links navbar-right">
              <li class="dropdown">
                <a href="<?= base_url();?>index.php/inventario">
                  <span> Volver al Inicio</span>
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
           <center><h2>Lista de pedidos realizados</h2></center>
            <ol class="breadcrumb">
              <li>
              </li>
            </ol>
          </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
          <div class="row">
          <br>
            <div class="col-md-12">
              <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                  <div class="col-md-12">
                    <div class="ibox float-e-margins">
                      <div class="ibox-title">
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
                              <th class="info">Código</th>
                              <th class="info">Fecha</th>
                              <th class="info">Monto en BsF</th>
                              <th class="info">Estatus</th>
                               <th class="info" data-sort-ignore="true">Acciónes</th>
                            </tr>
                          </thead>
                          <tbody id="tbody">
                          <?php if (isset($pedidos)) {?>
                           <?php foreach ($pedidos as $pedido): ?>
                            <tr>
                             <td><?php echo $pedido->id ?></td>
                             <td><?php echo $pedido->fecha ?></td>
                             <td><?php echo $pedido->monto ?> BsF</td>
                             <td><?php echo $pedido->estatus ?></td>
                             <td class="center">
                              <span>
                                <a style="margin: 10px" name="agregar" id="agregar" href="<?= base_url();?>index.php/pedido/<?php echo $pedido->slug; ?>">
                                    <i class="fa fa-eye">
                                        </i>  VER </a>
                                      </span>
                                      <span>
                                <a  style="margin: 10px"  name="agregar" id="agregar" href="<?= base_url();?>index.php/imprimir/<?php echo $pedido->slug; ?>">
                                    <i class="fa fa-file">
                                        </i>  DESCARGAR PDF </a>
                                      </span>  </td>
                            </tr>
                          <?php endforeach;?>
                          <?php }?>
                        </tbody>
                      </table>
                          <center>
                          <!-- <ul class="pagination pagination-lg">
                              <li><a>&laquo;</a></li>
                              <li><a onclick="paginar(0)" >1</a></li>
                              <li><a onclick="paginar(16)" >2</a></li>
                              <li><a onclick="paginar(31)" >3</a></li>
                              <li><a onclick="paginar(46)" >4</a></li>
                              <li><a onclick="paginar(61)" >5</a></li>
                              <li><a>&raquo;</a></li>
                          </ul> -->
                          </center>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
        </div>
