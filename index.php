<?php
    try
    {
        $array = unserialize(base64_decode($_REQUEST["datos"]));
        //print_r($array[0]['nombre']);
        return 1;
    }

    catch(Exception $e)
    {
        return 0;
    }

    // foreach ($array as $dato)
   	// 	{
   	// 	echo "El valor es ".$dato['nombre'].'<br>'; 
   	// 	}
?>



