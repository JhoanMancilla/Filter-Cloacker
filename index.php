<head>
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<title>Smoke Page Jeje</title>
</head>

<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	date_default_timezone_set('America/Bogota');
	$path=$_SERVER["DOCUMENT_ROOT"];
	include ($path.'/user.php');
	$file = $path."/webs.txt";
	$read=file_get_contents($file);
	$lim=False;
	if( isset($_GET['id']) && !empty($_GET['id']) ) {
		$id=$_GET["id"];
		if($id=="a" || $id=="b" || $id=="c" || $id=="d" || $id=="e" || $id=="f"){
			$id=1;
		}
		if ($id>count(file($file))){$lim=True;}
		$posicion = ":".$id.":";
		if(!$lim){
			$data2=explode($posicion,$read);
			$web=$data2[1];
			$u=explode("|",$web);$u=$u[1];
			$limite=explode("|",$web);$limite=$limite[2];
			$web=explode("|",$web);$web=$web[3];
			$next = $id+1;
			$next="http://87.229.6.159/?id=".$next;
		}else{
			$next = "http://87.229.6.159/web/1/";
			echo "<script type='text/javascript'>window.location='$next';</script>";
		}
		$test=False;
		if($u=="u"){
			$test=True;
		}
		echo "Sitio: ".$web."<br>";
		echo "Siguiente: ".$next."<br>";
		$file = $path."/".$id."/reg.txt";
		$archivo = $path."/".$id."/reg.txt";
		$lectura=fopen($archivo,"r") or die("Imposible abrir el archivo\n");
		$manejador = fopen($archivo,"a") or die("Imposible abrir el archivo\n");
		$hora =  date ("Y-m-d H:i:s");
		$ip = $hora."+".$_SERVER['REMOTE_ADDR']."+".$_SERVER['HTTP_REFERER']."\n";
		$ip2 = explode('+', $ip);
		$c=0;
		while($linea = fgets($lectura)) {
			if (feof($lectura)) break;
			$antigua = explode("+", $linea);
			if($ip2[1]==$antigua[1]){
		    	$c=$c+1;
		    }
		}
		fclose($lectura);
		$p=1;
		$posibilidad = rand(0,99);
	    if ($posibilidad > 70){$p=2;}
	    echo "Probabilidad de : ".$posibilidad."%<br>Para visitar la web: ".$web." 2 veces<br>";

	    //Redirecciones

	    if($id==1){

	    	/***
	    	 * Para guardar User Agents
	    	echo '<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
		    echo '<script type=text/javascript>
		        var window_w = screen.width;
		        var window_h = screen.height;
		         $.ajax({
		            url: "/'.$id.'/captura.php",
		            type: "POST",
		            data: "width="+window_w+"&height="+window_h,
		            success: function(result) {
		            }
		        });
			</script>';
			***/

	    	$once = date ("H");
		    if ($once=="23" || $once=="16"){
		        $p=2;
		    }
		    if(verificar($id)==0){
		    	if($c<=$p){
		    		fwrite($manejador,$ip);
		            fclose($manejador);
		            guardar($id);
		    		echo "Visito la web: ".$web;
		            echo "<script type='text/javascript'>window.location='$web';</script>";
		    	}else{
		    		echo "No visito así que voy al siguiente: ".$next;
		            echo "<script type='text/javascript'>window.location='$next';</script>";   
		    	}
		    }else{
		    	echo "User Agent Repetido voy al siguiente: ".$next;
		        echo "<script type='text/javascript'>window.location='$next';</script>";  
		    }
	    }else{
	    	if(!$test){
	    		if($c<=$p){
			    	fwrite($manejador,$ip);
		            fclose($manejador);
		            echo "Visito la web: ".$web;
		            echo "<script type='text/javascript'>window.location='$web';</script>";
			    }else{
			    	echo "No visito así que voy al siguiente: ".$next;
		            echo "<script type='text/javascript'>window.location='$next';</script>";  
			    }
	    	}else{
		    	if(verificar($id)==0){
			    	if($c<=$p){
			    		fwrite($manejador,$ip);
		            	fclose($manejador);
		            	guardar($id);
		    			echo "Visito la web: ".$web;
		            	echo "<script type='text/javascript'>window.location='$web';</script>";
			    	}else{
			    		echo "No visito así que voy al siguiente: ".$next;
		           		echo "<script type='text/javascript'>window.location='$next';</script>";  
			    	}
			    }else{
			    	echo "User Agent Repetido voy al siguiente: ".$next;
		        	echo "<script type='text/javascript'>window.location='$next';</script>";  
			    }
			}
	    }
	}else{
		 contar();
	}


function contar(){
	echo "<h2>Sistema de SmokeGod</h2>";
	echo "<h3>Datos</h3>";
	echo "<div class='cuerpo'>";
	
	include('stats.php');


	$file1 = "1/reg.txt";
	$lines = file($file1);
	$count = count($lines);
	$file2 = "1/user.txt";
	$lines2 = file($file2);
	$count2 = count($lines2);
	echo("1: ".$count." <a href='/1/reg.txt'> Regs     </a>".$count2." <a href='/1/user.txt'> Users   </a> <br>");

	$file1 = "2/reg.txt";
	$lines = file($file1);
	$count = count($lines);
	$file2 = "2/user.txt";
	$lines2 = file($file2);
	$count2 = count($lines2);
	echo("2: ".$count." <a href='/2/reg.txt'> Regs     </a>".$count2." <a href='/2/user.txt'> Users   </a> <br>");

	$file1 = "3/reg.txt";
	$lines = file($file1);
	$count = count($lines);
	$file2 = "3/user.txt";
	$lines2 = file($file2);
	$count2 = count($lines2);
	echo("3: ".$count." <a href='/3/reg.txt'> Regs     </a>".$count2." <a href='/3/user.txt'> Users   </a> <br>");

	$file1 = "4/reg.txt";
	$lines = file($file1);
	$count = count($lines);
	$file2 = "4/user.txt";
	$lines2 = file($file2);
	$count2 = count($lines2);
	echo("4: ".$count." <a href='/4/reg.txt'> Regs     </a>".$count2." <a href='/4/user.txt'> Users   </a> <br>");

	$file1 = "5/reg.txt";
	$lines = file($file1);
	$count = count($lines);
	$file2 = "5/user.txt";
	$lines2 = file($file2);
	$count2 = count($lines2);
	echo("5: ".$count." <a href='/5/reg.txt'> Regs     </a>".$count2." <a href='/5/user.txt'> Users   </a> <br>");

	$file1 = "6/reg.txt";
	$lines = file($file1);
	$count = count($lines);
	$file2 = "6/user.txt";
	$lines2 = file($file2);
	$count2 = count($lines2);
	echo("6: ".$count." <a href='/6/reg.txt'> Regs     </a>".$count2." <a href='/6/user.txt'> Users   </a> <br>");

	$file1 = "7/reg.txt";
	$lines = file($file1);
	$count = count($lines);
	$file2 = "7/user.txt";
	$lines2 = file($file2);
	$count2 = count($lines2);
	echo("7: ".$count." <a href='/7/reg.txt'> Regs     </a>".$count2." <a href='/7/user.txt'> Users   </a> <br>");

	$file1 = "8/reg.txt";
	$lines = file($file1);
	$count = count($lines);
	$file2 = "8/user.txt";
	$lines2 = file($file2);
	$count2 = count($lines2);
	echo("8: ".$count." <a href='/8/reg.txt'> Regs     </a>".$count2." <a href='/8/user.txt'> Users   </a> <br>");

	$file1 = "9/reg.txt";
	$lines = file($file1);
	$count = count($lines);
	$file2 = "9/user.txt";
	$lines2 = file($file2);
	$count2 = count($lines2);
	echo("9: ".$count." <a href='/9/reg.txt'> Regs       </a>".$count2." <a href='/9/user.txt'> Users   </a> <br>");

	$file1 = "10/reg.txt";
	$lines = file($file1);
	$count = count($lines);
	$file2 = "10/user.txt";
	$lines2 = file($file2);
	$count2 = count($lines2);
	echo("10: ".$count." <a href='/10/reg.txt'> Regs     </a>".$count2." <a href='/10/user.txt'> Users   </a> <br>");


	$file1 = "11/reg.txt";
	$lines = file($file1);
	$count = count($lines);
	$file2 = "11/user.txt";
	$lines2 = file($file2);
	$count2 = count($lines2);
	echo("11: ".$count." <a href='/11/reg.txt'> Regs     </a>".$count2." <a href='/11/user.txt'> Users   </a><br>");


	$file1 = "site/1/reg.txt";
	$lines = file($file1);
	$count = count($lines);
	$file2 = "site/1/user.txt";
	$lines2 = file($file2);
	$count2 = count($lines2);
	echo("Site 1: ".$count." <a href='/site/1/reg.txt'> Regs     </a>".$count2." <a href='/site/1/user.txt'> Users   </a><br>");




	$file1 = "1/usuarios.txt";
	$lines = file($file1);
	$count = count($lines);
	$file2 = "1/mobiles.txt";
	$lines2 = file($file2);
	$count2 = count($lines2);
	$file3 = "1/desktops.txt";
	$lines3 = file($file3);
	$count3 = count($lines3);
	$file4 = "1/mobiles2.txt";
	$lines4 = file($file4);
	$count4 = count($lines4);
	echo("Users Únicos: ".$count." <br> Mobiles: ".$count2." <br> Mobiles P: ".$count4." <br> Desktops: ".$count3." <br>");

	echo "</div>";


}




?>

