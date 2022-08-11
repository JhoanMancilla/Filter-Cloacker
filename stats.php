<link rel="stylesheet" type="text/css" href="/css/index.css">
<?php 
set_time_limit(0);
#GLOBAL

$sitios=array();
$total=0;
$total_ayer=0;

#Latin
$user="jhoanalfredomb@ufps.edu.co";
$pass="coraline0809";
$id="09673366117568452664981053674424";
$secret="48372953139714331970881426262416";
$web="11496";
$datos=obtener($user,$pass,$id,$secret,$web,"Latin");
array_push($sitios, $datos);

#XpornX
$user="nataliyaelruiz@gmail.com";
$pass="Nata9991";
$id="55436532861827239500758486466562";
$secret="12577806515787182180674648314945";
$web="12125";
$datos=obtener($user,$pass,$id,$secret,$web,"XpornX");
array_push($sitios, $datos);

sleep(1);

#OurSex
$user="villacarreno72@outlook.es";
$pass="Coraline00";
$id="64818218424267834422835585175162";
$secret="55347442685364718937383254916532";
$web="12082";
$datos=obtener($user,$pass,$id,$secret,$web,"OurSex");
array_push($sitios, $datos);

#HotSmoke
$user="ccervantesalgarin@gmail.com";
$pass="cenaiDa.Al";
$id="28664641232334771463281832802124";
$secret="18045457770127832563462781813054";
$web="12252";
$datos=obtener($user,$pass,$id,$secret,$web,"HotSmoke");
array_push($sitios, $datos);


sleep(1);
#SubSex
$user="abalsalazar@hotmail.com";
$pass="AbAlSa0298";
$id="53775926586560163367656546041756";
$secret="13462637413114848514181551968539";
$web="13092";
$datos=obtener($user,$pass,$id,$secret,$web,"SubSex");
array_push($sitios, $datos);




#Sexual
$user="franciscobarrios82@outlook.es";
$pass="Clave,.98";
$id="75553941622742302355363724535254";
$secret="71901316535958072535363518871418";
$web="13101";
$datos=obtener($user,$pass,$id,$secret,$web,"Sexual");
array_push($sitios, $datos);




$html='';
$html.='<div class="container">
	<table>
		<thead>
			<tr>
				<th>Cuenta</th>
				<th>Impresiones</th>
				<th>Money</th>
				<th>CPM</th>
				<th>Impr Ayer</th>
				<th>Money Ayer</th>
				<th>CPM Ayer</th>
			</tr>
		</thead>
		<tbody>';

foreach ($sitios as $sitio) {
	$total+=floatval($sitio->response[0]->price);
	$total_ayer+=floatval($sitio->dine_ayer);
	$i_p=number_format((($sitio->response[0]->impressions/$sitio->imp_ayer)*100)-100,1);
	$html.='<tr>
		<td>'.$sitio->sitio.'</td>
		<td>'.$sitio->response[0]->impressions.' '.$i_p.' %</td>
		<td> $ '.number_format($sitio->response[0]->price,2).'</td>
		<td>'.$sitio->response[0]->ecpm.'</td>
		<td>'.$sitio->imp_ayer.'</td>
		<td>'.$sitio->dine_ayer.'</td>
		<td>'.$sitio->cpm_ayer.'</td>
	</tr>';
	}
$total = number_format($total,3);
$cop=number_format($total*4300,2);
$cop_ayer=number_format($total_ayer*4300,2);
$d_p=number_format((($total/$total_ayer)*100)-100,1);
$html.='<tr>
		<td>Total:</td>
		<td> $ '.$cop.'</td>
		<td> $ '.$total.'</td>
		<td>'.number_format($d_p,2).' %</td>
		<td> $ '.number_format($total_ayer,3).'</td>
		<td> $ '.$cop_ayer.'</td>
		<td></td>
	</tr>';

$html.='</tbody>
	</table>
	<h3>Total Día: $ '.$total.'</h3>
	<h4>COP: $ '.$cop.'</h4>
</div>';

echo $html;

function obtener($user,$pass,$id,$secret,$web,$nombre){
	#Autenticar
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://api.trafficstars.com/v1/auth/token');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=password&client_id=$id&client_secret=$secret&username=$user&password=$pass");

	$headers = array();
	$headers[] = 'Content-Type: application/x-www-form-urlencoded';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch,CURLOPT_TIMEOUT,6000);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
	    echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
	#echo "INFO:".$result."<br>";
	$resultado= json_decode($result);
	$token= $resultado->access_token;

	#Obtener las stats
	date_default_timezone_set('Africa/Bamako');
	$hoy=date("Y-m-d");
	$url="https://api.trafficstars.com/v1/stats/publisher/day?application_id=".$web."&date_from=".$hoy;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$header = array();
	$header[] = "Authorization: bearer $token";
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch,CURLOPT_TIMEOUT,3000);
	$data = curl_exec ($ch);
	curl_close($ch);
	$datos=json_decode($data);
	$datos->sitio=$nombre;

	#Obtener datos pasados
	$ayer= date("Y-m-d",strtotime($hoy."- 1 days"));
	$url="https://api.trafficstars.com/v1/stats/publisher/day?application_id=".$web."&date_from=".$ayer;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$header = array();
	$header[] = "Authorization: bearer $token";
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch,CURLOPT_TIMEOUT,3000);
	$data = curl_exec ($ch);
	curl_close($ch);
	$datos2 = json_decode($data);
	$datos->imp_ayer=$datos2->response[0]->impressions;
	$datos->dine_ayer=$datos2->response[0]->price;
	$datos->cpm_ayer=$datos2->response[0]->ecpm;
	return $datos;


}
?>