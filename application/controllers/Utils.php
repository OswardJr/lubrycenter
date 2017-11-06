
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Utils extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function clientes_act() {
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');
		$query = $this->db->query("select * from clientes_act");
		$delimiter = ";";
		$newline = "\r\n";
		$enclosure = '';
		$data = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);
		//force_download('Report' . date('d-M-y_H:i:s') . '.csv', $data);
		if (!write_file('./ftp/clientes_act.csv', $data)) {
			echo "no";
		} else {
			echo "si";
		}
	}

}
