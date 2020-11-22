<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    // Cabecera para que su contenido sea considerado como un objeto JSON
    header('Content-Type: application/json');

    try
    {
         $json[] = array(
                    'personal_id' => '1',
                );
        //$array = unserialize(base64_decode($_REQUEST["datos"]));
        $array = $_REQUEST["datos"];
        //print_r($array[0]['nombre']);
        echo json_encode($array);
    }

    catch(Exception $e)
    {
        echo json_encode('malo');
    }

    // foreach ($array as $dato)
   	// 	{
   	// 	echo "El valor es ".$dato['nombre'].'<br>'; 
   	// 	}
?>



