<?php
set_time_limit(1000);
function getdb() {
	$server = "localhost";
	$username = "root";
	$password = "verano.2014";
	$db = "lubrycode";

	try {

		$conn = mysqli_connect($server, $username, $password, $db);
	} catch (exception $e) {
		echo "Connection failed: " . $e->getMessage();
	}
	return $conn;
}

$con = getdb();
$sql = 'truncate clientes';

$exe = mysqli_query($con, $sql);

$gestor = fopen("/var/www/html/lubrycenter/ftp/CLIENTES.CSV", 'r');
while (($datos = fgetcsv($gestor, 10000, ";")) !== FALSE) {
	$sql = "INSERT into clientes (tipo, codigo , rif, razon_social, telefono_local, correo,direccion, ciudad, sector, contribuyente_es) values (1,'" . $datos[1] . "','" . $datos[2] . "','" . $datos[3] . "','" . $datos[4] . "','" . $datos[5] . "','" . $datos[6] . "','" . $datos[7] . "','" . $datos[8] . "','" . $datos[9] . "')";
	$result = mysqli_query($con, $sql);
}
fclose($gestor);

$sql2 = 'select * from clientes_act';
$result = mysqli_query($con, $sql2);
while ($row = $result->fetch_assoc()) {
	//var_dump($row);
	$sql = "UPDATE clientes SET
	rif='" . $row['rif'] . "',
	razon_social='" . $row['razon_social'] . "',
	persona_contacto='" . $row['persona_contacto'] . "',
	telefono_pers_contacto='" . $row['telefono_pers_contacto'] . "',
	telefono_local='" . $row['telefono_local'] . "',
	correo='" . $row['correo'] . "',
	direccion='" . $row['direccion'] . "',
	ciudad='" . $row['ciudad'] . "',
	estado='" . $row['estado'] . "',
	sector='" . $row['sector'] . "',
	contribuyente_es='" . $row['contribuyente_es'] . "' WHERE codigo='" . $row['codigo'] . "' ";
	$res = mysqli_query($con, $sql);
}

?>
