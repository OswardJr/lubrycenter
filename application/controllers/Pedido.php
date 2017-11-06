<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pedido extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('pedido_model');
		$this->load->library('session');
		unset(
			$_SESSION['alert'],
			$_SESSION['cliente']
		);
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
		} else {
			redirect('login');
		}
	}

	public function index($slug = NULL) {

		$data = array('pedido' => $this->pedido_model->getPedido($slug));
		if (count($data['pedido']) < 1) {
			show_404();
		}
		$data = array('partes' => $this->pedido_model->getPartes($slug), 'cliente' => $this->pedido_model->getCliente($slug), 'pedido' => $this->pedido_model->getPedido($slug), 'detalle' => $this->pedido_model->getDetalle($slug));

		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('pedido', $data);
	}

	public function imprimir($slug = NULL) {
		$data = array('partes' => $this->pedido_model->getPartes($slug), 'cliente' => $this->pedido_model->getCliente($slug), 'pedido' => $this->pedido_model->getPedido($slug), 'detalle' => $this->pedido_model->getDetalle($slug));
		$this->load->library('pdf');
		$this->pdf->load_view('pedido-pdf', $data);
		$this->pdf->render();
		$this->pdf->stream($filename = 'Pedido-' . date('d-M-y_H-i-s') . '.pdf');
	}
}