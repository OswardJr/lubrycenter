<?php
class Inventario_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_filters() {
		$query = $this->db->select('*')
			->from('inventario')
			->order_by('cantidad', 'DESC')
			->limit(15)
			->where('cantidad > 0')
			->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	public function get_cliente($codigo) {
		$whereCondition = array('codigo' => $codigo);
		$query = $this->db->select('*')
			->from('clientes')
			->where($whereCondition)
			->get();
		return $query->row();
	}

	public function get_pedidos($codigo_u) {
		$whereCondition = array('codigo_u' => $codigo_u);
		$query = $this->db->select('*')
			->from('pedidos')
			->order_by('id', 'DESC')
			->where($whereCondition)
			->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}
	public function get_det_pedido($codigo) {
		$whereCondition = array('id_pedido' => $codigo);
		$query = $this->db->select('*')
			->from('detalle_ped')
			->where($whereCondition)
			->get();

		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
	}

	public function get_pedido($codigo) {
		$whereCondition = array('id' => $codigo);
		$query = $this->db->select('*')
			->from('pedidos')
			->where($whereCondition)
			->get();

		if ($query->num_rows() > 0) {
			return $query->row_array();
		}
	}

	public function search_filter($busqueda) {
		$this->db->select('*')
			->like('descripcion', $busqueda)
			->limit(15)
			->order_by('cantidad', 'DESC')
			->from('inventario');
		$query = $this->db->get();
		$data = array();

		return $this->convert_to_iva($query->result());
	}

	public function convert_to_iva($query) {
		foreach ($query as $q) {
			$row = array(
				'id' => $q->id,
				'codigo' => $q->codigo,
				'aplicacion' => $q->aplicacion,
				'marca' => $q->marca,
				'descripcion' => $q->descripcion,
				'cantidad' => $q->cantidad,
				'precio_iva' => $q->precio_iva,
				'precio_sin_iva' => number_format($q->precio_iva / 1.12, 0, ',', '.'),
				'empaque' => $q->empaque,
			);
			$data[] = $row;
		}
		echo json_encode($data);
	}

	public function search_filter_pagination($busqueda, $pagina) {
		$pagina = intval($pagina);
		$this->db->select('*')
			->like('descripcion', $busqueda)
			->limit(15, $pagina)
			->order_by('cantidad', 'DESC')
			->from('inventario');
		$query = $this->db->get();
		return $this->convert_to_iva($query->result());
	}

	public function filtrar_filter($busqueda) {
		$whereCondition = array('aplicacion' => $busqueda);
		$this->db->select('*')
			->where($whereCondition)
			->order_by('cantidad', 'DESC')
			->from('inventario');
		$query = $this->db->get();

		return $this->convert_to_iva($query->result());
	}

	public function savePedido($data, $dataPdf, $cliente) {

		$pedido = array(
			"codigo_u" => $data['codigo_u'],
			"fecha" => date("y/m/d"),
			"transporte" => "n/a",
			"condiciones" => "n/a",
			"comentario" => "n/a",
			"monto" => $data['total'],
			"slug" => md5(mt_rand()),
			"estatus" => "sin procesar",
			"cajero" => 3,
			"f_numero" => 0,
			"consec" => 0,
			"consec_a" => 0,
			"consec_b" => 0,
			"partes_a" => 0,
			"partes_b" => 0,
			"control_a" => 0,
			"control_b" => 0,
			"vendedor" => "",
			"valor" => $data['total'],
			"pagado" => $data['total'],
			"items" => $dataPdf['items'],
			"efectivo" => "",
			"cheque" => "",
			"ahorro" => 0,
			"ahorrot" => 0,
			"ahorron" => 0,
			"tarjeta" => 0,
			"codtar" => 0,
			"tarjetat" => 0,
			"credito" => $data['total'],
			"cancelada" => "true",
			"cliente" => $data['codigo_u'],
			"documento" => "",
			"plazo" => "",
			"descuento" => "",
			"pordescuen" => "",
			"recorte" => "",
			"cambio" => "",
			"nombre" => $cliente->razon_social,
			"banco" => "",
			"nocheque" => "0",
			"iva" => "0",
			"exento" => "0",
			"base_gra" => "0",
			"impiva" => "0",
			"lista" => "1",
			"financi" => "0",
			"Abonos" => "",
			"Medico" => "",
			"Valor_a" => "",
			"Valor_b" => "",
			"estado" => "",
			"aprobacion" => "",
			"punto" => "",
			"dependenci" => "",
			"crcedula" => "",
			"noarticulos" => $dataPdf['nroarticulos'],

		);

		$this->db->insert('pedidos', $pedido);
		$id = $this->db->insert_id();
		$dataPdf["id"] = $id;
		foreach ($data['productos'] as $key) {

			$this->id_pedido = $id;
			$this->id_inv = $key['id'];
			$this->cantidad = $key['qty'];
			$this->p_venta = $key['price'];
			$this->aux2 = $key['price'];
			$this->sk = $key['sk'];
			$this->aplicacion = $key['aplicacion'];
			$this->aux1 = '1';
			$this->valors = '1';
			$this->credito = 'true';
			$this->descuento = 0;
			$this->valordesc = 0;
			$this->notadecre = 0;
			$this->valors = '1';
			$this->equipo = '1';

			$this->db->insert('detalle_ped', $this);
		}

		$this->load->library('pdf');

		$this->pdf->load_view('mypdf', $dataPdf);
		$this->pdf->render();

		file_put_contents("pdf/pedido_" . $id . ".pdf", $this->pdf->output());

		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'ventaslubry@gmail.com',
			'smtp_pass' => 'Pedid0sLubry&2017',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('ventaslubry@gmail.com', 'lubrycenter C.A');
		$this->email->to('"' . $data['cliente']->correo . '"');
		$this->email->subject('Comprobante de pedido lubrycenter');
		$this->email->message('Pedido numero ' . $id . '');
		$this->email->attach('pdf/pedido_' . $id . '.pdf', 'inline');
		if ($this->email->send(FALSE)) {
			// echo $this->email->print_debugger();
			return 1;
		}
	}

	// public function enviarEmail($codigo) {
	//   $config = array(
	//     'protocol' => 'smtp',
	//     'smtp_host' => 'ssl://smtp.googlemail.com',
	//     'smtp_port' => 465,
	//     'smtp_user' => 'jhonnyjosearana@gmail.com',
	//     'smtp_pass' => 'verano.2014',
	//     'mailtype' => 'html',
	//     'charset' => 'iso-8859-1',
	//   );

	//   $this->load->library('email', $config);
	//   $this->email->set_newline("\r\n");
	//   $this->email->from('lubrycenter@gmail.com', 'lubrycenter C.A');
	//   $this->email->to('jhonnyelgeek@gmail.com');
	//   $this->email->subject('Comprobante de pedido lubrycenter');
	//   $this->email->message('Pedido numero ' . $codigo . '');
	//   $this->email->attach('pdf/pedido_' . $codigo . '.pdf', 'inline');

	//   $this->email->send();
	//   echo $this->email->print_debugger();
	// }
}
