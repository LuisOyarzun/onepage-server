<?php
 
    $array = unserialize(base64_decode($_REQUEST["datos"]));
    print_r($array[0]['nombre']);

    foreach ($array as $dato)
   		{
           echo "El valor es ".$dato['nombre'].'<br>'; 
           file_put_contents("php://stderr", $dato['nombre'].PHP_EOL);
   	}

?>



