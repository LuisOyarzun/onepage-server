<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

    try
    {
        //$array = unserialize(base64_decode($_REQUEST["datos"]));
        $array = $_REQUEST["datos"];
        //print_r($array[0]['nombre']);
        return 'exito';
    }

    catch(Exception $e)
    {
        return 'falso';
    }

    // foreach ($array as $dato)
   	// 	{
   	// 	echo "El valor es ".$dato['nombre'].'<br>'; 
   	// 	}
?>



