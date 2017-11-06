<?php
class Pedido_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function imprimir($slug) {
		echo $slug;
	}

	public function getPedido($slug) {
		$whereCondition = array('slug' => $slug);
		$query = $this->db->select('*')
			->from('pedidos')
			->where($whereCondition)
			->get();
		return $query->row();
	}

	public function getDetalle($slug) {
		$pedido = $this->getPedido($slug);
		$id = $pedido->id;
		$whereCondition = array('id_pedido' => $id);
		$query = $this->db->select('*')
			->from('detalle_ped')
			->where($whereCondition)
			->get();
		return $query->result();
	}

	public function getCliente($slug) {
		$whereCondition = array('slug' => $slug);
		$query = $this->db->select('*')
			->from('pedidos')
			->where($whereCondition)
			->get();
		$data = $query->row();

		$whereConditionCliente = array('codigo' => $data->codigo_u);
		$query = $this->db->select('*')
			->from('clientes')
			->where($whereConditionCliente)
			->get();
		return $query->row();
	}

	public function getPartes($slug) {
		$pedido = $this->getPedido($slug);
		$id = $pedido->id;
		$whereCondition = array('id_pedido' => $id);
		$query = $this->db->select('*')
			->from('detalle_ped')
			->where($whereCondition)
			->get();
		$data = $query->result();
		foreach ($data as $p) {
			$whereConditionPro = array('codigo' => intval($p->id_inv));
			$query = $this->db->select('*')
				->from('inventario')
				->where($whereConditionPro)
				->get();
			$prod = $query->row();
			$resultarray = array(
				'det' => $p->cantidad,
				'codigo' => $prod->codigo,
				'descripcion' => $prod->descripcion,
				'precio_iva' => $prod->precio_iva,
			);
			$returnarray[] = $resultarray;
		}
		return $returnarray;
	}

}
