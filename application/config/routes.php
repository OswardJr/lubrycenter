<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['pedido/(:any)'] = 'pedido/index/$1';

$route['imprimir/(:any)'] = 'pedido/imprimir/$1';

$route['sesiones'] = 'sesiones';

$route['utils'] = 'utils';

$route['login'] = 'sesiones/index';

$route['administrador'] = 'administrador';

$route['registrarse'] = 'sesiones/registrarse';

$route['perfil'] = 'sesiones/actualizarPerfil';

$route['pedidos'] = 'inventario/pedidos';

$route['logout'] = 'sesiones/logout';

$route['inventario'] = 'inventario';

$route['(:any)'] = 'index/$1';

$route['404_override'] = '';

$route['translate_uri_dashes'] = false;

$route['default_controller'] = 'inventario';
