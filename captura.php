<?php

if(!empty($_POST['width']))
    $width = (int)$_POST['width'];
    $height = (int)$_POST['height'];

$ip="1,".$width.",".$height.",".$_SERVER['HTTP_USER_AGENT']."\n";
$archivo = "usuarios.txt";
$lectura=fopen($archivo,"r") or die("Imposible abrir el archivo\n");

while($linea = fgets($lectura)) {
    if (feof($lectura)) break;
        $antigua = $linea;
        if($ip==$antigua){
            $c=$c+1;
        }
}


if($c<1){
    $archivo = "usuarios.txt";
    $manejador = fopen($archivo,"a") or die("Imposible abrir el archivo\n");
    fwrite($manejador,$ip);
    fclose($manejador);

    if(isMobile($ip)){
        $archivo2 = "mobiles.txt";
        $manejador2 = fopen($archivo2,"a") or die("Imposible abrir el archivo\n");
        fwrite($manejador2,$ip);
        fclose($manejador2);
    }
}



function isMobile($user) {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $user);
}


$result = array(
        'ancho' => $width,
        'alto' => $height,
     );
echo json_encode($result);




?>