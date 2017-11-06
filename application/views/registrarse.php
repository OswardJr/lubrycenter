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
    <?php if (isset($this->session->alert)): ?>
      <br>
      <br>
      <div class="col-md-4 col-md-offset-4">
        <div class="alert alert-danger" role="alert">
          <center><?=$this->session->alert?></center>
        </div>
      </div>
    <?php endif;?>
    <?php $cliente = $this->session->cliente; //var_dump($cliente)   ?>
    <div class="middle-box loginscreen animated fadeInDown">
        <div>
            <div>
               <img alt="image" class="img-rounded" width="300" height="100" src="<?=base_url();?>assets/img/Logo.png" />
            </div>
            <h3>Ingrese sus datos para registrarse en el sistema.</h3>
            </p>
            <?php echo form_open(); ?>
                <div class="form-group">
                <label class="left">Rif</label>
                    <input type="text" class="form-control" name="rif" value="<?php if (isset($cliente[0]->rif)) {echo $cliente[0]->rif;}?>"  placeholder="Rif" required="">
                </div>
                <div class="form-group">
                <label class="left">Razón social</label>
                    <input type="text" class="form-control" name="razon_social" value="<?php if (isset($cliente[0]->razon_social)) {echo $cliente[0]->razon_social;}?>"  placeholder="Razón social" required="">
                </div>
                <div class="form-group">
                <label class="left">Persona de contacto</label>
                    <input type="text" class="form-control" name="persona_contacto" value="<?php if (isset($cliente[0]->persona_contacto)) {echo $cliente[0]->persona_contacto;}?>"  placeholder="Persona de contacto">
                </div>
                <div class="form-group">
                <label class="left">Dirección</label>
                    <input type="text" class="form-control" name="direccion" value="<?php if (isset($cliente[0]->direccion)) {echo $cliente[0]->direccion;}?>" placeholder="Dirección" required="">
                </div>
                <div class="form-group">
                    <label class="left">Ciudad</label>
                    <input type="text" class="form-control" name="ciudad" value="<?php if (isset($cliente[0]->ciudad)) {echo $cliente[0]->ciudad;}?>"  placeholder="Ciudad" required="">
                </div>
                <div class="form-group">
                <label class="left">Telefono celular</label>
                    <input  pattern="^([0-9]{11})$" type="text" class="form-control" name="telefono_contacto" value="<?php if (isset($cliente[0]->telefono_pers_contacto)) {echo $cliente[0]->telefono_pers_contacto;}?>"  placeholder="04120000000" required="">
                </div>
                <div class="form-group">
                <label class="left">Telefono local</label>
                    <input  pattern="^([0-9]{11})$" type="text" class="form-control" name="telefono_local" value="<?php if (isset($cliente[0]->telefono_local)) {echo $cliente[0]->telefono_local;}?>" placeholder="04120000000" required="">
                </div>
                <div class="form-group">
                <label class="left">Correo</label>
                    <input type="email" class="form-control" name="correo" value="<?php if (isset($cliente[0]->correo)) {echo $cliente[0]->correo;}?>" placeholder="Correo electronico" required="">
                </div>
               <div class="form-group">
               <label class="left">Contraseña</label>
                    <input type="password" class="form-control" value="" name="clave" placeholder="Contraseña" required="">
                </div>
                <button type="submit" name="entrar" class="btn btn-primary block full-width m-b">Registrarse</button>
                <a class="btn btn-sm btn-info btn-block" href="login">Iniciar Sesión</a>
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
