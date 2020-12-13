<?php

  // 0. Habilito permisos para recibir datos, uso de variable y uso de require
  // Require
  // require('cpanel/cPanel.php');
  
  // Header
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
  header('Access-Control-Allow-Headers: Content-Type');
  header('Content-Type: application/json');
  
  // Variables
  // $dominioPrincipal = "productochile.cl";
  // $cpanel = new CPANEL('productochile', 'yC7A6&!bCrpO', $dominioPrincipal);
  // $nombreSubdominio = 'elpruebas';

  //file_put_contents("php://stderr", "OK - Require, Header y Variables");

  // 1. Recibir datos
  try
  {
    switch ($_SERVER['REQUEST_METHOD']) 
    {
      case 'POST':
        $arr = file_get_contents("php://input");
        //file_put_contents("php://stderr", "var dump es: ".var_dump($arr));
        //$datos = json_decode($arr, true); 
        // var_dump($arr);
        // file_put_contents("php://stderr", var_dump($arr));
        //var_dump($arr);
        file_put_contents("php://stderr", "arreglo es:  ".$arr);
      break;
      
      case 'GET':
        //echo 'Metodo GET';
      break;
    }

    //file_put_contents("php://stderr", "OK - Recibió el POST o GET");
  }

  catch(Exception $e0)
  {
    //file_put_contents("php://stderr", "Error - Ocurrió un error en recibir el POST o GET");
    echo("Ocurrió un error al recibir datos.");
  }
  
  // 2. Crear subdominio
  // try
  // {
  //   $addsubdomain = $cpanel -> api2
  //   (
  //     'SubDomain', 'addsubdomain',
  //     array(
  //       'domain'                => $nombreSubdominio,
  //       'rootdomain'            => $dominioPrincipal,
  //       'dir'                   => '/public_html/'.$nombreSubdominio,
  //       'disallowdot'           => '1',
  //       )
  //   );
    
  //   file_put_contents("php://stderr", "OK - Subdominio listo.");
  // }

  // catch(Exception $e1)
  // {
  //   file_put_contents("php://stderr", "Error - No se creó el subdominio.");
  //   echo("Ocurrió un error al intentar crear el subdominio.");
  // }
  
  // // 3. Subir HTML a la ruta de creación del subdominio
  // try
  // {
  //   // Variables
  //   $rutaDeGuardado = 'public_html/'.$nombreSubdominio;
    
  //   // Crear y subir archivo
  //   $save_file_content = $cpanel->uapi('Fileman', 'save_file_content',
  //     array
  //     (
  //       'dir'           => $rutaDeGuardado,
  //       'file'          => 'index.html',
  //       'from_charset'  => 'UTF-8',
  //       'to_charset'    => 'ASCII',
  //       'content'       => '<p>FUNCION2A</p>',
  //       'fallback'      => '0',
  //     )
  //   );

  //   //print_r("OK");
  //   file_put_contents("php://stderr", "OK - Se creó el index.html");
  //   file_put_contents("php://stderr", "OK - Todo ok.");
  // }

  // catch(Exception $e2)
  // {
  //   file_put_contents("php://stderr", "Error - No se subió el archivo HTML.");
  //   echo("Ocurrió un error al intentar subir archivo HTML.");
  // }

?>