<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUBRY CENTER</title>
    <link href="<?=base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/animate.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/style.css" rel="stylesheet">
</head>
<body class="gray-bg">
  <div class="row">
  <br>
  <br>
    <?php if (validation_errors()): ?>
      <div class="col-md-4 col-md-offset-4">
        <div class="alert alert-danger" role="alert">
          <?=validation_errors()?>
        </div>
      </div>
    <?php endif;?>
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
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

               <img alt="image" class="img-rounded" width="300" height="100"  src="<?=base_url();?>assets/img/Logo.png" />

            </div>
            <h3>Bienvenido a Lubry center c.a</h3>
            <p>Aplicacion Web de pedidos onLine.
            </p>
            <p>Ingrese sus datos para acceder al sistema.</p>
            <?php echo form_open(); ?>
                <div class="form-group">
                    <input type="text" name="usuario" autofocus class="form-control" placeholder="Usuario" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="clave" class="form-control" placeholder="Contraseña" required="">
                </div>
                <button type="submit" name="entrar" class="btn btn-primary block full-width m-b">Entrar</button>

               <!--  <a href="#"><small>Olvide mi contraseña</small></a>
                <p class="text-muted text-center"><small>Si no posee una cuenta registrada haga su solicitud</small></p>
                <a class="btn btn-sm btn-info btn-block" href="registrarse">Solicitud de cuenta</a> -->
            </form>
            <p class=""> <small>Lubry Center C.A.</small> </p>
            <p class=""> <small>Telefono local: </small> </p>
            <p class=""> <small>Correo: </small> </p>
        </div>
    </div>
  </div><!-- .row -->
    <!-- Mainly scripts -->
    <script src="<?=base_url();?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
</body>

</html>
