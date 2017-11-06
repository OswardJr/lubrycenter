
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrador extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('administrador_model');
		$this->load->model('inventario_model');
	}

	public function index() {
		$this->load->library('session');
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$this->load->view('header');
			$this->load->view('sidebaradmin');
			$this->load->view('administrador');
			$this->load->view('footer');
		} else {
			redirect('login');
		}
	}

	public function pedidos() {
		$query = $this->administrador_model->pedidos();
	}
	public function sinprocesar() {
		$query = $this->administrador_model->sin_procesar();
	}
	public function pedidos_() {
		$this->load->library('session');
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$this->load->view('header');
			$this->load->view('sidebaradmin');
			$this->load->view('sin_procesar');
			$this->load->view('footer');
		} else {
			redirect('login');
		}
	}

	public function procesar() {
		// cambiar status a precesado
		$pedidos = $this->input->post('pedidos');
		$ruta = $this->input->post('ruta');
		$fecha = $this->input->post('fecha');
		$correo = 'jhonnyjosearana@gmail.com';
		$pedidosToCsv = array();
		$detPedidosToCsv = array();
		foreach ($pedidos as $pedido) {
			$this->administrador_model->procesar_pedido($pedido);
		}
		foreach ($pedidos as $codigo) {
			$codigo = intval($codigo);
			$pedido = $this->inventario_model->get_pedido($codigo);
			$det_pedido = $this->inventario_model->get_det_pedido($codigo);

			$detPedidosToCsv[] = $det_pedido;
			$pedidosToCsv[] = $pedido;

		}
		// detalle pedidos
		$file_det_pedido = fopen("/var/www/html/lubrycenter/ftp/ipedidos.csv", "w");

		foreach ($detPedidosToCsv as $line) {
			foreach ($line as $key) {
				fputcsv($file_det_pedido, $key);
			}
		}

		fclose($file_det_pedido);

		// pedidos
		$file_pedido = fopen("/var/www/html/lubrycenter/ftp/pedidos.csv", "w");

		foreach ($pedidosToCsv as $line) {
			fputcsv($file_pedido, $line);
		}

		fclose($file_pedido);
		// $config = array(
		// 	'protocol' => 'smtp',
		// 	'smtp_host' => 'ssl://smtp.googlemail.com',
		// 	'smtp_port' => 465,
		// 	'smtp_user' => 'ventaslubry@gmail.com',
		// 	'smtp_pass' => 'Pedid0sLubry&2017',
		// 	'mailtype' => 'html',
		// 	'charset' => 'iso-8859-1',
		// );

		// $this->load->library('email', $config);
		// $this->email->set_newline("\r\n");
		// $this->email->from('ventaslubry@gmail.com', 'lubrycenter C.A');
		// $this->email->to($correo); // el que se especifica
		// $this->email->subject('Archivo de texto con pedidos y detalles.');
		// $this->email->message('Pedidos de FECHA: ' . $fecha . ' y RUTA: ' . $ruta);
		// $this->email->attach('/var/www/html/lubrycenter/ftp/pedidos.csv', 'inline');
		// $this->email->attach('/var/www/html/lubrycenter/ftp/ipedidos.csv', 'inline');
		// if (!$this->email->send(FALSE)) {
		// 	echo $this->email->print_debugger();
		// }
		$this->send_ftp();
	}

	public function send_ftp() {

		// $file = '/var/www/html/lubrycenter/ftp/pedidos.csv';
		// $remotefile = 'pedidos.csv';
		// $server = 'lubryserver.dyndns.org';
		// $user = 'pedidos';
		// $password = 'Pedid0sLubry&2017';

		// $conn = ftp_connect($server);

		// $login = ftp_login($conn, $user, $password);

		// ftp_put($conn, $remotefile, $file, FTP_ASCII);

		// ftp_close($conn);

		$this->load->library('ftp');

		$config['hostname'] = 'lubryserver.dyndns.org';
		$config['username'] = 'pedidos';
		$config['password'] = 'Pedid0sLubry&2017';
		$config['debug'] = TRUE;
		$config['passive'] = TRUE;
		$this->ftp->connect($config);
		$this->ftp->upload('/var/www/html/lubrycenter/ftp/pedidos.csv', 'pedidos.csv', 'ascii');
		$this->ftp->upload('/var/www/html/lubrycenter/ftp/ipedidos.csv', 'ipedidos.csv', 'ascii');
		$this->ftp->close();
	}

}
