<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sesiones extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('sesiones_model');
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		unset($_SESSION['cart_contents']);
	}

	public function index() {
		unset(
			$_SESSION['alert'],
			$_SESSION['cliente']
		);
		$data = new stdClass();

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('usuario', 'usuario', 'required|alpha_numeric');
		$this->form_validation->set_rules('clave', 'clave', 'required');

		if ($this->form_validation->run() == false) {

			$this->load->view('login');

		} else {
			// capturo variables desde el formulario
			$usuario = $this->input->post('usuario');
			$clave = $this->input->post('clave');
			// invoco la funcion que verfifica usuario y contraseña
			$result = $this->sesiones_model->user_login($usuario, $clave);
			$row = $result["cliente"][0];
			//var_dump($row->tipo);
			if ($result['is_user']) {
				$sess_array = array();
				if ($row->tipo == "admin") {
					$userdata = array(
						'id' => $row->id,
						'username' => 'admin',
						'rif' => $row->rif,
						'tipo' => $row->tipo,
						'logged_in' => true,
					);
					$this->session->set_userdata($userdata);
					redirect('administrador');
				} elseif (intval($row->tipo) != 1) {
					$data->error = 'No autorizado';
					$this->load->view('login', $data);
				} else {
					// si tiene acceso envio a la
					//sesion los datos actuales
					$userdata = array(
						'id' => $row->id,
						'username' => $row->razon_social,
						'rif' => $row->rif,
						'codigo' => $row->codigo,
						'direccion' => $row->direccion,
						'telefono' => $row->telefono_pers_contacto,
						'email' => $row->correo,
						'tipo' => $row->tipo,
						'logged_in' => true,
					);
					$this->session->set_userdata($userdata);
					//envio a la vista de productos para agregar al pedido
					redirect('inventario');
				}
			} elseif (!empty($result['cliente'])) {
				$this->session->set_userdata('alert', 'Debe actualizar sus datos');
				$this->session->set_userdata('cliente', $result['cliente']);
				redirect('registrarse');
			} else {
				$data = array('error' => 'Acceso Denegado');
				$this->load->view('login', $data);
			}
		}
	}

	public function registrarse() {
		$data = new stdClass();
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('rif', 'rif', 'required');
		$this->form_validation->set_rules('razon_social', 'razon_social', 'required');
		$this->form_validation->set_rules('direccion', 'direccion', 'required');
		$this->form_validation->set_rules('telefono_contacto', 'telefono_contacto', 'required');
		$this->form_validation->set_rules('telefono_local', 'telefono_local', 'required');
		$this->form_validation->set_rules('correo', 'correo', 'required');
		$this->form_validation->set_rules('clave', 'clave', 'required');

		if ($this->form_validation->run() == false) {

			$this->load->view('registrarse');

		} else {
			// capturo variables desde el formulario
			$cliente = array(
				'rif' => $this->input->post('rif'),
				'razon_social' => $this->input->post('razon_social'),
				'tipo' => 0,
				'direccion' => $this->input->post('direccion'),
				'ciudad' => $this->input->post('ciudad'),
				'persona_contacto' => $this->input->post('persona_contacto'),
				'telefono_pers_contacto' => $this->input->post('telefono_contacto'),
				'telefono_local' => $this->input->post('telefono_local'),
				'correo' => $this->input->post('correo'),
			);

			$usuario = array(
				'rif' => $this->input->post('rif'),
				'fecha_reg' => date("y/m/d"),
				'tipo' => 1,
				'contrasena' => $this->input->post('clave'),
			);

			// invoco la funcion que verfica usuario y contraseña
			$result = $this->sesiones_model->user_register($cliente, $usuario);
			if ($result) {
				$data->msj = 'Datos actualizados exitosamente.';
				redirect("login");
			} else {
				// si no esta en la base de datos o usuario y/o clave incorrecta
				// muestro este error
				$data->error = 'Datos de acceso incorrectos';
				$this->load->view('registrarse', $data);
			}
		}
	}

	public function logout() {
		unset($_SESSION['cart_contents']);
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		redirect("login");
	}

	// public function administrador() {
	// 	$this->load->library('session');
	// 	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
	// 		$query = $this->sesiones_model->get_usuarios();
	// 		$data = array('usuarios' => $query);
	// 		$this->load->view('header');
	// 		$this->load->view('sidebaradmin');
	// 		$this->load->view('administrador', $data);
	// 		$this->load->view('footer');
	// 	} else {
	// 		redirect('login');
	// 	}
	// }

	public function authUser() {
		$rif = $this->input->post('rif');
		$codigo = $this->input->post('codigo');
		return $this->sesiones_model->auth_user($rif, $codigo);
	}

	public function actualizarPerfil() {
		$data = new stdClass();

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('viejaclave', 'clave', 'required');
		$this->form_validation->set_rules('nuevaclave', 'clave', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('editarperfil');
			$this->load->view('footer');
		} else {
			// capturo variables desde el formulario
			$viejaclave = $this->input->post('viejaclave');
			$nuevaclave = $this->input->post('nuevaclave');
			$rif = $_SESSION['rif'];
			// invoco la funcion que verfifica usuario y contraseña
			$result = $this->sesiones_model->update_perfil($rif, $viejaclave, $nuevaclave);
			if ($result == 0) {
				$data->msj = 'Contraseña actualizada correctamente.';
				$this->load->view('header');
				$this->load->view('sidebar');
				$this->load->view('editarperfil', $data);
				$this->load->view('footer');
			} else if ($result == 1) {
				$data->error = 'La contraseña anterior es incorrecta.';
				$this->load->view('header');
				$this->load->view('sidebar');
				$this->load->view('editarperfil', $data);
				$this->load->view('footer');
			} else {
				$data->error = 'El usuario no existe';
				$this->load->view('header');
				$this->load->view('sidebar');
				$this->load->view('editarperfil', $data);
				$this->load->view('footer');
			}
		}
	}

	public function test() {

		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://rs27.websitehostserver.net',
			'smtp_port' => 465,
			'smtp_user' => 'pedidos@lubrycenter.com',
			'smtp_pass' => 'verano.2014',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('pedidos@lubrycenter.com', 'lubrycenter C.A');
		$this->email->to('jhonnyelgeek@gmail.com');
		$this->email->subject('Comprobante de pedido lubrycenter');
		$this->email->message('Pedido');
		//$this->email->attach('pdf/pedido_112.pdf', 'inline');

		$this->email->send();
		if ($this->email->send(FALSE)) {
			echo $this->email->print_debugger();
		}
	}

}
