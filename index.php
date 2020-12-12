<?php
  
  // Header
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
  header('Access-Control-Allow-Headers: Content-Type');


  // 1. Recibir datos
  try
  {
    switch ($_SERVER['REQUEST_METHOD']) 
    {
      case 'POST':
        $arr = file_get_contents("php://input");
        echo $arr;
      break;
      
      case 'GET':
        echo 'Metodo GET';
      break;
    }
  }

  catch(Exception $e0)
  {
    echo("Ocurrió un error al recibir datos.");
  }

?>