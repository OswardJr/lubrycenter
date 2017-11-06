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
                <a href="<?=base_url();?>/">
                  <span> Volver al Inicio</span>
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
           <center><h2>Pedidos</h2></center>
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
              <div id="listado_pedidos">
            <table id="example" class="display" cellspacing="0" width="100%">
             <thead>
                <tr>
                   <th>Numero</th>
                   <th>Razón social</th>
                   <th>Cantidad de items</th>
                   <th>Monto total</th>
                   <th>Ciudad</th>
                   <th>Estatus</th>
                  <th>Opciones</th>
                   <th></th>
                </tr>
             </thead>
          </table>
            </div>
          </div>

       </div>
       <center>
   <!-- <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">Procesar pedidos</button></center> -->
                <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
  <label for="fecha">Fecha:</label>
  <input type="date" class="form-control" id="fecha">
</div>
<div class="form-group">
  <label for="ruta">Ruta:</label>
  <input type="text" class="form-control" id="ruta">
</div>
       <center>
   <button type="button" id="procesar" class="btn btn-success">Guardar</button></center>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">


$(document).ready(function (){
   var table = $('#example').DataTable({
      'ajax': 'sinprocesar',
      'columnDefs': [
         {
            'targets': 7,
            'checkboxes': {
               'selectRow': true
            }
         }
      ],
      'select': {
         'style': 'multi'
      },
      'order': [[1, 'asc']]
   });

});
</script>