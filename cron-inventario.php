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
$sql = 'truncate inventario';
$exe = mysqli_query($con, $sql);

$gestor = fopen("/var/www/html/lubrycenter/ftp/INVENTARIO.CSV", 'r');
while (($datos = fgetcsv($gestor, 10000, ";")) !== FALSE) {
	$sql = "INSERT into inventario (codigo , aplicacion, marca, descripcion, cantidad, precio_iva, empaque) values ('" . $datos[0] . "','" . $datos[1] . "','" . $datos[2] . "','" . $datos[3] . "','" . $datos[4] . "','" . $datos[5] . "','" . $datos[6] . "')";
	$result = mysqli_query($con, $sql);
}
fclose($gestor);
?>
