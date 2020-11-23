<?php
    // headers para no tener problema con cors
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    // Cabecera para que su contenido sea considerado como un objeto JSON
    header('Content-Type: application/json');

    try
    {
        file_put_contents("php://stderr", "entro al try!!!".PHP_EOL);
        $array = unserialize(base64_decode($_REQUEST["data"]));
        file_put_contents("php://stderr", "paso el array".PHP_EOL);
        file_put_contents("php://stderr", $array.PHP_EOL);
        //$array = $_REQUEST["datos"];
        //print_r($array[0]['nombre']);
        
        // respuesta
        //echo ($array['banner']);
        print_r($array[0]['banner']);
    }

    catch(Exception $e)
    {
        file_put_contents("php://stderr", "SENDO ERROR!!!".PHP_EOL);
        echo json_encode('no');
    }

    // foreach ($array as $dato)
   	// 	{
   	// 	echo "El vx|alor es ".$dato['nombre'].'<br>'; 
   	// 	}
?>



