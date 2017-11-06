<!DOCTYPE html>
<html>
<head>
	<title>Pedido</title>
	<style type="text/css">
		body{
			font-size: 12px;
		}
	</style>
</head>
<body>
	<table cellspacing="0" style="height: 250px;" width="520" border="1">
		<tr>
			<td height="170" scope="col">
				<img  width="250" height="100" src="logo.png">
				<br>
				<table cellspacing="0" border="1" width="150" style="padding-right: -10px;" align="right">
					<p></p>
					<tr>
						<td><b>PEDIDO N°</b></td>
						<td><b>DIA</b></td>
						<td><b>MES</b></td>
						<td><b>AÑO</b></td>
					</tr>
					<tr>
						<td> <?php echo $pedido->id; ?></td>
						<?php $fecha = explode("-", $pedido->fecha); ?>
						<td> <?php  echo $fecha[2];  ?></td>
						<td> <?php echo $fecha[1]; ?></td>
						<td> <?php  echo $fecha[0]; ?></td>
					</tr>
				</table></td>
			</tr>
			<tr>
				<td><b> Nombre o Razon Social: </b><?php echo $cliente->razon_social; ?></td>
			</tr>
			<tr>
				<td><b> Domicilio Fiscal: </b> <?php echo $cliente->direccion; ?></td>
			</tr>
		</table>
		<table cellspacing="0" width="520" border="1">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>RIF</th>
					<th>Telefono</th>
					<th>Correo</th>
				</tr>
			</thead>
			<tbody id="tbody">
				<tr>
					<td><?php echo $cliente->codigo; ?></td>
					<td><?php echo $cliente->rif; ?></td>
					<td><?php echo $cliente->telefono_pers_contacto; ?></td>
					<td><?php echo $cliente->correo; ?></td>
				</tr>
			</tbody>
		</table>
		<table cellspacing="0" width="520" border="1">
			<tr>
				<td width="47"><b>CODIGO</b></td>
				<td width="30"><b>CANT</b></td>
				<td width="210"><b>PRODUCTO</b></td>
				<td width="80"><b>P.UNIT</b></td>
				<td width="80"><b>TOTAL</b></td>
			</tr>
			<?php
			$cont = count($partes);
			$filas = 25 - $cont;
			?>
			<?php foreach ($partes as $producto): ?>
				<tr>
               		<td><?php echo $producto['codigo'] ?></td>
               		<td><?php echo $producto['det'] ?></td>
               		<td><?php echo $producto['descripcion'] ?></td>
               		<td><?php echo number_format($producto['precio_iva'] / 1.12, 0, ',', '.') ?></td>
               		<td><?php echo number_format($producto['det'] * $producto['precio_iva'] / 1.12, 0, ',', '.') ?></td>
				</tr>
			<?php endforeach;?>
			<?php
			for ($i = 1; $i < $filas; $i++) {
				$space = str_repeat('&nbsp;', 1);
				echo '<tr>
				<td>' . $space . '</td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
			</tr>';
		}
		;
		?>
	</table>
	<div class="total" style="padding-left: 435px;">
	<table cellspacing="0" border="1">
		<tr >
			<td style="width:100px;">Subtotal: </td>
			<td style="width:150px;"><?php echo number_format($pedido->monto - ($pedido->monto - $pedido->monto / 1.12), 2, ',', '.'); ?></td>
		</tr>
		<tr>
			<td>IVA: </td>
			<td><?php echo number_format($pedido->monto - $pedido->monto / 1.12, 2, ',', '.') ?></td>
		</tr>
		<tr>
			<td>Total: </td>
			<td><?php echo number_format($pedido->monto, 2, ',', '.') ?></td>
		</tr>
	</table>
	</div>
	<table cellspacing="0" width="520" border="1">
		<tr>
			<td><center><b>** PRECIOS SUJETOS A CAMBIOS SIN PREVIO AVISO **</b></center></td>
		</tr>
		<tr>
			<td><center><b>** PRESUPUESTO SUJETO A DISPONIBILIDAD **</b></center></td>
		</tr>
	</table>
</body>
</html>
