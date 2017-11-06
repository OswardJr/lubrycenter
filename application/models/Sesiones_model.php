<?php
class Sesiones_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function user_login($usuario, $clave) {
		// compruebo si esta en usuarios y si tiene clave
		// si es admin retorna y salto los otros pasos
		// ya que admin la logica es otra
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('rif', $usuario);
		$this->db->where('contrasena', $clave);
		$query = $this->db->get();
		$user = $query->row();

		if ($query->num_rows() == 1 && $user->tipo == "admin") {
			$result = array('is_user' => true, 'cliente' => $query->result());
			return $result;
		}

		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('rif', $usuario);
		$this->db->where('contrasena', $clave);

		$query = $this->db->get();
		//login exitoso
		if ($query->num_rows() == 1) {
			// obtengo los datos
			// los retorno para enviar sesión
			$this->db->select('*');
			$this->db->from('clientes');
			$this->db->where('rif', $usuario);
			$query2 = $this->db->get();
			$result = array('is_user' => true, 'cliente' => $query2->result());
			return $result;
		} else {
			// obtengo los datos para enviar a que
			// se registre
			$this->db->select('*');
			$this->db->from('clientes');
			$this->db->where('rif', $usuario);
			$this->db->where('codigo', $clave);
			$query2 = $this->db->get();
			if ($query2->num_rows() == 1) {
				$result = array('is_user' => false, 'cliente' => $query2->result());
				return $result;
			} else {
				return false;
			}
		}
	}

	public function update_perfil($rif, $viejaclave, $nuevaclave) {

		$this->db->select('contrasena');
		$this->db->from('usuarios');
		$this->db->where('rif', $rif);
		$query = $this->db->get();
		// si encuentra el rif del usuario
		if ($query->num_rows() == 1) {
			$cliente = $query->row();
			// si la clave coincide asigno la nueva clave
			if ($cliente->contrasena == $viejaclave) {
				$data = array(
					'contrasena' => $nuevaclave,
				);
				$this->db->where('rif', $rif);
				$this->db->update('usuarios', $data);
				return 0;
			} else if ($cliente->contrasena != $viejaclave) {
				return 1;
			}
		} else {
			$this->db->select('codigo');
			$this->db->from('clientes');
			$this->db->where('rif', $rif);
			$query = $this->db->get();
			if ($query->num_rows() == 1) {
				$cliente = $query->row();
				// si la clave coincide asigno la nueva clave
				if ($cliente->codigo == $viejaclave) {
					$usuario = array(
						'rif' => $rif,
						'fecha_reg' => date("y/m/d"),
						'tipo' => 1,
						'contrasena' => $nuevaclave,
					);
					$this->db->insert('usuarios', $usuario);
					return 0;
				} else if ($cliente->codigo != $viejaclave) {
					return 1;
				}
			} else {
				return 0;
			}
		}
	}

	public function user_register($cliente, $usuario) {
		$this->db->set('rif', $cliente['rif']);
		$this->db->set('razon_social', $cliente['razon_social']);
		$this->db->set('tipo', 1);
		$this->db->set('direccion', $cliente['direccion']);
		$this->db->set('ciudad', $cliente['ciudad']);
		$this->db->set('persona_contacto', $cliente['persona_contacto']);
		$this->db->set('telefono_pers_contacto', $cliente['telefono_pers_contacto']);
		$this->db->set('telefono_local', $cliente['telefono_local']);
		$this->db->set('correo', $cliente['correo']);
		$this->db->where('rif', $cliente['rif']);
		$this->db->update('clientes');

		$this->db->insert('usuarios', $usuario);
		return true;
	}

	public function auth_user($rif, $codigo) {
		$data = array(
			'tipo' => 1,
		);
		$data2 = array(
			'tipo' => 1,
			'codigo' => $codigo,
		);
		$this->db->where('rif', $rif);
		$this->db->update('usuarios', $data);

		$this->db->where('rif', $rif);
		$this->db->update('clientes', $data2);
	}

	public function get_usuarios() {
		$whereCondition = array('tipo' => "0");
		$query = $this->db->select('*')
			->from('usuarios')
			->order_by('fecha_reg', 'DESC')
			->where($whereCondition)
			->get();
		return $query->result();
	}
}
