    	<nav class="navbar-default navbar-static-side" role="navigation">
    		<div class="sidebar-collapse">
    			<ul class="nav metismenu" id="side-menu">
    				<li class="nav-header">
    					<div class="dropdown profile-element"> <span>
    						<img alt="image" class="img-rounded" width="101" height="38" src="<?=base_url();?>assets/img/Logo_LubryCenter_small.jpg" />
    					</span>
    					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
    						<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Lubry Center C.A.</strong>
    						</span> <span class="text-muted text-xs block">Menu <b class="caret"></b></span> </span> </a>
    						<ul class="dropdown-menu animated fadeInRight m-t-xs">
    							<li><a href="<?=base_url();?>/">Home</a></li>
    							<li><a href="">Quienes Somos?</a></li>
    							<li><a href="">Contacto</a></li>
    							<li><a href="">Mailbox</a></li>
    							<li class="divider"></li>
    							<li><a href="<?=base_url();?>index.php/logout">Cerrar Sesion</a></li>
    						</ul>
    					</div>
    					<div class="logo-element">
    						LC+
    					</div>
    				</li>
    				<li>
    					<a href="#"><i class="fa fa-user-circle-o"></i> <span class="nav-label">Perfil</span><span class="fa arrow"></span></a>
    					<ul class="nav nav-second-level collapse">
    						<li><a href="<?=base_url();?>index.php/perfil">Cambiar contraseña</a></li>
    					</ul>
    				</li>
<?php if ($_SESSION['tipo'] != 'admin') {?>

    				<li>
    					<a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Pedidos</span><span class="fa arrow"></span></a>
    					<ul class="nav nav-second-level collapse">
    						<li><a href="<?=base_url();?>index.php/pedidos">Consultar Pedidos</a></li>
    					</ul>
    				</li>
   <?php }?>

    			</ul>

    		</div>
    	</nav>
