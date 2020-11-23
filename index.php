<?php
    // headers para no tener problema con cors
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    // Cabecera para que su contenido sea considerado como un objeto JSON
    header('Content-Type: application/json');

    try
    {
        $array = unserialize(base64_decode($_REQUEST['data']));
        
        file_put_contents("php://stderr", (string)$array.PHP_EOL);
        file_put_contents("php://stderr", (string)$array[0].PHP_EOL);
        file_put_contents("php://stderr", (string)$array['banner'].PHP_EOL);
        
        foreach ($array as $dato)
   		{
               echo ($dato); 
               file_put_contents("php://stderr", $dato['banner'].PHP_EOL);
   		}


        file_put_contents("php://stderr", "paso el array".PHP_EOL);

        
        $array = $_REQUEST["datos"];
        file_put_contents("php://stderr", "paso el request".PHP_EOL);
        print_r($array[0]['nombre']);
        file_put_contents("php://stderr", (string)$array[0]['banner'].PHP_EOL);
        
        // respuesta
        echo ($array['banner']);
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



