<?php
require_once('includes/load.php');
if (!$session->isUserLoggedIn(true)) {
	redirect('index', false);
}
?>
<?php
$p_months  = $_POST['months'];
$p_year  = $_POST['years'];

$box = findAllBoxMonthlyyear('box', $p_months, $p_year);

if (!$box) {
	$session->msg("d", "No hay registros con el mes  : $p_months  año : $p_year");
	redirect('monthlyReport');
}

$date =  make_date();
$output = '';
$output .= '
	<table width="100%" cellpadding="5" border="1">

	<tr>
	<td colspan="2" align="center" style="font-size:18px"><b><img src="img/logo.jpeg"></b></td>
	</tr>

	<tr>
	<td width="50%">
	Sincelejo sucre<br />
	Direccion : Calle 27 No. 16-55 Barrio Pasacorriendo <br /> 
	Celular : +57 300 801 3158 <br />
	Telefono : (5) 280 85 63 <br />
	</td>
	<td width="35%">         
	Factura Fecha : ' . $date . ' <br />
	</td>
	</tr>
	</tr>
	</table>

	<table width="100%" cellpadding="5" border="1">
	<tr>
	<td colspan="2" align="center" style="font-size:18px">REPORTE POR MES: ' . $p_months  . ' DEL AÑO:  ' . $p_year . '</td>
	</tr>
	</table>

	<br />
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
  <tr>
  	<th align="left">#</th>
	<th align="left">Fecha</th>
	<th align="left">Concepto</th>
	<th align="left">Doc identidad Producto</th>
	<th align="left">Recibo caja</th>
	<th align="left">Tipo Moviento</th>
	<th align="left">Valor</th> 
	</tr>
	';
$count = 0;
foreach ($box as $allbox) {
	$count++;
	$output .= '
  <tr>
  <td align="left">' . $count . '</td>
	<td align="left">' . $allbox['fecha'] . '</td>
	<td align="left">' . $allbox['concepto'] . ' </td>
	<td align="left">' . $allbox['doc_identidad'] . ' </td>
	<td align="left">' . $allbox['recibo_caja'] . '</td>
	<td align="left">' . $allbox['opcion'] . '</td>
	<td align="left">' . number_format($allbox['valor']) . ' </td>   
	</tr>

	';
}
$output .= '
	</table>
	

	';
// create pdf of invoice
$invoiceFileName = 'Report' . $date . '.pdf';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

use Dompdf\Dompdf;



$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));

/*<br>
	<table style="page-break-after:always" width="100%" cellpadding="5" border="1">
	<tr>
	<td width="50%">
	Total ingresos: ' . $totalIngresos . '<br />
	</td>
	<td width="50%">         
	Total Egresos : ' . $totalEgresos . ' <br />
	</td>
	</tr>
	
	</table>*/
