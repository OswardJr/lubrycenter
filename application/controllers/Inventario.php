<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventario extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('inventario_model');
		$this->load->library('cart');
		$this->load->library('session');
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
		} else {
			redirect('login');
		}
	}

	public function index() {
		if ($_SESSION['tipo'] == 'admin') {
			redirect('administrador');
		}
		$data = array('items' => $this->getTotalItemsOfCart(), 'titulo' => 'Pedidos', 'filters' => $this->inventario_model->get_filters());
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('nuevo_pedido', $data);
		$this->load->view('footer');
	}

	public function search() {
		$busqueda = $this->input->post('busqueda');
		$query = $this->inventario_model->search_filter($busqueda);
	}

	public function searchPagination() {
		$busqueda = $this->input->post('busqueda');
		$pagina = $this->input->post('pagina');
		$query = $this->inventario_model->search_filter_pagination($busqueda, $pagina);
	}

	public function filtrar() {
		$busqueda = $this->input->post('busqueda');
		$query = $this->inventario_model->filtrar_filter($busqueda);
	}

	public function agregarAlCarrito() {
		$data = array(
			'id' => $this->input->post('codigo'),
			'name' => $this->input->post('descripcion'),
			'qty' => $this->input->post('cantidad'),
			'price' => $this->input->post('precio'),
			'sk' => $this->input->post('sk'),
			'aplicacion' => $this->input->post('aplicacion'),
		);
		$this->cart->insert($data);
		echo json_encode($data);
	}

	public function verPedido() {
		$data = array('items' => $this->getTotalItemsOfCart(), 'productos' => $this->cart->contents());
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('ver_pedido', $data);
		$this->load->view('footer');

	}

	public function savePedido() {
		if ($this->cart->total_items() < 1) {
			echo json_encode(array("status" => false));
			return;
		}
		$cliente = $this->inventario_model->get_cliente($_SESSION['codigo']);

		$data = array('cliente' => $cliente, 'codigo_u' => $_SESSION['codigo'], 'total' => $this->cart->total(), 'productos' => $this->cart->contents());

		$dataPdf = array('dia' => date("d"), 'mes' => date("m"), 'ano' => date("Y"), 'cliente' => $cliente, 'items' => $this->cart->total_items(), 'nroarticulos' => $this->getTotalItemsOfCart(), 'total' => $this->cart->total(), 'filters' => $this->cart->contents());

		$this->inventario_model->savePedido($data, $dataPdf, $cliente);
		$this->cart->destroy();
		echo json_encode(array("status" => true));
	}

	public function destroy() {

		$this->cart->destroy();

	}

	public function destroyItem() {
		$this->cart->remove($this->input->post('codigo'));
	}

	public function pedidos() {
		$this->load->library('session');
		if (isset($_SESSION['logged_in']) && $_SESSION['tipo'] === 'admin') {
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('404');
			$this->load->view('footer');
		} else {
			$query = $this->inventario_model->get_pedidos($_SESSION['codigo']);
			$data = array('pedidos' => $query);
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('pedidos', $data);
			$this->load->view('footer');
		}

	}

	public function getTotalItemsOfCart() {
		$i = 0;
		foreach ($this->cart->contents() as $product) {
			$i++;
		};
		return $i;
	}

	// public function send() {
	// 	$config = array(
	// 		'protocol' => 'smtp',
	// 		'smtp_host' => 'ssl://smtp.googlemail.com',
	// 		'smtp_port' => 465,
	// 		'smtp_user' => 'ventaslubry@gmail.com',
	// 		'smtp_pass' => 'Pedid0sLubry&2017',
	// 		'mailtype' => 'html',
	// 		'charset' => 'iso-8859-1',
	// 	);

	// 	$this->load->library('email', $config);
	// 	$this->email->set_newline("\r\n");
	// 	$this->email->from('ventaslubry@gmail.com', 'lubrycenter C.A');
	// 	$this->email->to('jhonnyjosearana@gmail.com');
	// 	$this->email->subject('Comprobante de pedido lubrycenter');
	// 	$this->email->message('Pedido numero 3');
	// 	$this->email->attach('pdf/pedido_3.pdf', 'inline');
	// 	if (!$this->email->send(FALSE)) {
	// 		echo $this->email->print_debugger();
	// 	}
	// }

}
