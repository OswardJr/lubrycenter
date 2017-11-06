<?php
class Administrador_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	public function pedidos() {
		// solo los que tienen estatus 0 == sin procesar
		$query = $this->db->query('SELECT
										pedidos.id as id,
										pedidos.slug as slug,
										pedidos.monto as monto,
										pedidos.estatus as estatus,
										clientes.razon_social as cliente,
										clientes.ciudad as ciudad,
										detalle_ped.cantidad as cantidad
									from
									(( pedidos
  										inner join clientes on clientes.codigo = pedidos.codigo_u  )
 										inner join detalle_ped on  detalle_ped.id_pedido =pedidos.id  ) where estatus="sin procesar"  GROUP BY pedidos.id');
		$data = array();
		if ($query->num_rows() >= 1) {
			foreach ($query->result() as $row) {
				$array[] = array(
					$row->id,
					$row->cliente,
					$row->cantidad,
					$row->monto,
					$row->ciudad,
					$row->estatus,
					'<span><a style="margin: 10px" name="agregar" id="agregar" href="' . base_url() . 'index.php/pedido/' . $row->slug . '"><i class="fa fa-eye"></i>  VER </a></span>',
					$row->id,
				);
			}

			$output = array("data" => $array);
			echo json_encode($output);
		} else {
			$array[] = array("", "", "", "", "", "", "");
			$output = array("data" => $array);
			echo json_encode($output);
		}
	}
	public function sin_procesar() {
		// solo los que tienen estatus 0 == sin procesar
		$query = $this->db->query('
			SELECT
				pedidos.id as id,
				pedidos.slug as slug,
				pedidos.monto as monto,
				pedidos.estatus as estatus,
				clientes.razon_social as cliente,
				clientes.ciudad as ciudad,
				detalle_ped.cantidad as cantidad
			from
				(( pedidos
  					inner join clientes on clientes.codigo = pedidos.codigo_u  )
 					inner join detalle_ped on  detalle_ped.id_pedido =pedidos.id  )
 					where estatus="procesados"
 					GROUP BY pedidos.id');
		$data = array();
		if ($query->num_rows() >= 1) {
			foreach ($query->result() as $row) {
				$array[] = array(
					$row->id,
					$row->cliente,
					$row->cantidad,
					$row->monto,
					$row->ciudad,
					$row->estatus,
					'<span><a style="margin: 10px" name="agregar" id="agregar" href="' . base_url() . 'index.php/pedido/' . $row->slug . '"><i class="fa fa-eye"></i>  VER </a></span>',
					$row->id,
				);
			}

			$output = array("data" => $array);
			echo json_encode($output);
		} else {
			$array[] = array("", "", "", "", "", "", "");
			$output = array("data" => $array);
			echo json_encode($output);
		}
	}

	public function procesar_pedido($codigo) {
		$this->db->set('estatus', "procesados");
		$this->db->where('id', $codigo);
		$this->db->update('pedidos');
	}
}
