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
							<span class="label label-primary"></span><span> Volver al listado</span>
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
				<center><h2>Actualizar contraseña</h2></center>
			</div>
		</div>
        <?php if (isset($error)): ?>
      <br>
      <br>
      <div class="col-md-4 col-md-offset-4">
        <div class="alert alert-danger" role="alert">
          <center><?=$error?></center>
        </div>
      </div>
    <?php endif;?>
        <?php if (isset($msj)): ?>
      <br>
      <br>
      <div class="col-md-4 col-md-offset-4">
        <div class="alert alert-success" role="alert">
          <center><?=$msj?></center>
        </div>
      </div>
    <?php endif;?>
		<div class=" ecommerce">
			<div class="row">
				<br>
				<div class="">
					<div class="col-md-12">
						<div class="ibox float-e-margins">
							<div class="col-md-4 col-md-offset-4">
							<br>
							<div class="ibox-content">
								<?php echo form_open(); ?>
									<div class="form-group">
										<input type="password" name="viejaclave" class="form-control" placeholder="Contraseña Anterior" required="">
									</div>
									<div class="form-group">
										<input type="password" name="nuevaclave" class="form-control" placeholder="Contraseña Nueva" required="" />
									</div>
									<button type="submit" name="entrar" class="btn btn-primary block full-width m-b">Actualizar</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	</script>
