<?php
  /* Comando para ver logs de heroku: heroku logs -t -a onepage-server */

  // Header
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Origin: *');
  header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
  header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
  header('Access-Control-Allow-Headers: Content-Type');
  header('Content-Type: application/json');

  // 0. Habilito permisos para recibir datos, uso de variable y uso de require
  // Require
  require('cPanel/cPanel.php');
  
  // Variables
  $dominioPrincipal = 'productochile.cl';
  $cpanel = new CPANEL('productochile', 'yC7A6&!bCrpO', $dominioPrincipal);
  // Trozo de código a repetir para generar productos y/o servicios en el onepage
  $codigoArepetir='';
  // Contador de repeticiones
  $i=2;
  // Nombre del subdominio = nombre de la empresa
  $nombreSubdominio='';
  // Array de datos recibidos
  $arr='';

  // 1. Recibir datos
  try
  {
    $method = $_SERVER['REQUEST_METHOD'];
    file_put_contents("php://stderr", "metodo es:  ".$method."\n");

    switch ($_SERVER['REQUEST_METHOD']) 
    {
      case 'POST':
        $arr = file_get_contents("php://input");
        $arr = json_decode($arr,true);
        //file_put_contents("php://stderr", "arreglo es:  ".$arr["banner"]["ruta2"]);
        file_put_contents("php://stderr", "arreglo es:  ".$arr."\n");

        // Nombre del subdominio y del onepage
        $nombreSubdominio = $arr["nombreEmpresa"];
        file_put_contents("php://stderr", "Nombre del subdominio es:  ".$nombreSubdominio."\n");

      break;
      
      // case 'GET':
      //    echo 'Metodo GET';
      // break;
    }

    file_put_contents("php://stderr", "OK - Recibió el POST o GET"."\n");
  }

  catch(Exception $e0)
  {
    file_put_contents("php://stderr", "Error - Ocurrió un error en recibir el POST o GET"."\n");
    //echo("Ocurrió un error al recibir datos.");
    echo(0);
  }
  
  // 2. Crear subdominio
  try
  {

    $dir = '/public_html/'.$arr["nombreEmpresa"];

    $addsubdomain = $cpanel -> api2
    (
      'SubDomain', 'addsubdomain',
      array(
        'domain'                => $nombreSubdominio,
        'rootdomain'            => $dominioPrincipal,
        'dir'                   => $dir,
        'disallowdot'           => '1',
        )
    );

    

    // $get_userdata = $cpanel->uapi(
    //   'SubDomain', 'addsubdomain',
    //       array(
    //       'domain'                => $arr["nombreEmpresa"],
    //       'rootdomain'            => $dominioPrincipal,
    //       'dir'                   => $dir,
    //       'disallowdot'           => '1',
    //   )
    // );
    
    file_put_contents("php://stderr", 'DIR es: '.$dir."\n");
    file_put_contents("php://stderr", "OK - Subdominio listo."."\n");
  }

  catch(Exception $e1)
  {
    file_put_contents("php://stderr", "Error - No se creó el subdominio."."\n");
    //echo("Ocurrió un error al intentar crear el subdominio.");
    echo(0);
  }

  // 2.5 Repetir codigo

  $codigoArepetir='';
  
  $cantidadProductos = $arr["cantidadProductosServicios"];
  file_put_contents("php://stderr", 'Cantidad de productos es: '.$cantidadProductos."\n");

  while($i<=intval($cantidadProductos))
  {
    $codigoArepetir = $codigoArepetir.'<div class="u-effect-fade u-gallery-item"><div class="u-back-slide"><img class="u-back-image u-expanded" src="'.$arr["productosServicios"]["producto2"]["hipervinculo"].'" alt="Titulo">
    </div><div class="u-over-slide u-shading u-over-slide-1"><h3 class="u-gallery-heading">'.$arr["productosServicios"]["producto1"]["titulo"].'</h3><p class="u-gallery-text">'.$arr["productosServicios"]["producto1"]["parrafo"].'</p></div></div>';
    $i = $i+1;
  }
  
  
  // 3. Subir HTML a la ruta de creación del subdominio
  try
  {
    // Variables
    $rutaDeGuardado = 'public_html/'.$nombreSubdominio;
    
    // Crear y subir archivo
  //   $save_file_content = $cpanel->uapi(
  //     'Fileman', 'save_file_content',
  //         array(
  //         'dir'           => $rutaDeGuardado,
  //         'file'          => 'index.html',
  //         'from_charset'  => 'UTF-8',
  //         'to_charset'    => 'ASCII',
  //         'content'       => 
          // '<!DOCTYPE html><html style="font-size: 16px;" lang="es-CL"><head><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta charset="utf-8"><title>Home</title>
          // <link rel="stylesheet" href="https://ejemplo.productochile.cl/nicepage.css" media="screen"><link rel="stylesheet" href="https://ejemplo.productochile.cl/Home.css" media="screen">
          // <script class="u-script" type="text/javascript" src="https://ejemplo.productochile.cl/jquery.js" defer=""></script><script class="u-script" type="text/javascript" src="https://ejemplo.productochile.cl/nicepage.js" defer=""></script></head>
          // <body class="u-body"><section class="u-align-center u-clearfix u-palette-5-dark-3 u-valign-top-sm u-valign-top-xs u-section-1"id="sec-79db">
          // <div id="carousel-b991" data-interval="5000" data-u-ride="carousel"class="u-carousel u-expanded-width u-slider u-slider-1"><ol class="u-absolute-hcenter u-carousel-indicators u-hidden u-carousel-indicators-1"><li data-u-target="#carousel-b991" class="u-active" data-u-slide-to="0"></li>
          // <li data-u-target="#carousel-b991" data-u-slide-to="1"></li><li data-u-target="#carousel-b991" class="u-grey-30" data-u-slide-to="2"></li></ol><div class="u-carousel-inner" role="listbox">
          // <div class="test-slide u-active u-carousel-item u-container-style u-image u-slide u-image-1"data-image-width="1280" data-image-height="719"><div class="u-container-layout u-container-layout-1"></div></div>
          // <div class="u-carousel-item u-container-style u-image u-slide u-image-2" data-image-width="1280"data-image-height="853"><div class="u-container-layout u-container-layout-2"></div></div><div class="u-carousel-item u-container-style u-image u-slide u-image-3" data-image-width="1280"data-image-height="851">
          // <div class="u-container-layout u-container-layout-3"></div></div></div><a class="u-absolute-vcenter u-carousel-control u-carousel-control-prev u-spacing-5 u-text-grey-30 u-carousel-control-1"href="#carousel-b991" role="button" data-u-slide="prev">
          // <span aria-hidden="true"><svg viewBox="0 0 477.175 477.175"><path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"></path></svg></span>
          // <span class="sr-only">Previous</span></a><a class="u-absolute-vcenter u-carousel-control u-carousel-control-next u-spacing-5 u-text-grey-30 u-carousel-control-2"href="#carousel-b991" role="button" data-u-slide="next">
          // <span aria-hidden="true"><svg viewBox="0 0 477.175 477.175"><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5
          // c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z">
          //           </path></svg></span><span class="sr-only">Next</span></a></div>
          //   <div class="u-clearfix u-gutter-30 u-layout-wrap u-layout-wrap-1">
          //     <div class="u-layout">
          //       <div class="u-layout-row">
          //         <div class="u-container-style u-layout-cell u-left-cell u-palette-1-base u-size-20 u-layout-cell-1">
          //           <div class="u-container-layout u-valign-top u-container-layout-4">
          //             <h4 class="u-align-center u-text u-text-1">TITULO 1</h4>
          //             <p class="u-align-center u-text u-text-body-alt-color u-text-2">Este, es el párrafo 1 de la página web
          //               generada. Intente tener esta misma cantidad de palabras para un mejor estilo.</p>
          //           </div></div>
          //         <div class="u-container-style u-layout-cell u-palette-2-base u-size-20 u-layout-cell-2">
          //           <div class="u-container-layout u-valign-top u-container-layout-5">
          //             <h4 class="u-align-center u-text u-text-3">TITULO 2</h4>
          //             <p class="u-align-center u-text u-text-body-alt-color u-text-4">Este, es el párrafo 2 de la página web
          //               generada. Intente tener esta misma cantidad de palabras para un mejor estilo.<br></p></div></div>
          //         <div
          //           class="u-align-center u-container-style u-layout-cell u-palette-3-base u-right-cell u-size-20 u-layout-cell-3">
          //           <div class="u-container-layout u-valign-top u-container-layout-6">
          //             <h4 class="u-text u-text-5">TITULO 3</h4>
          //             <p class="u-text u-text-body-alt-color u-text-6">Este, es el párrafo 3 de la página web generada. Intente
          //               tener esta misma cantidad de palabras para un mejor estilo.</p></div></div></div></div></div></section>
          // <section class="u-clearfix u-color-scheme-u10 u-color-style-multicolor-1 u-palette-5-dark-3 u-section-2"
          //   id="carousel_9340">
          //   <div class="u-clearfix u-sheet u-sheet-1">
          //     <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
          //       <div class="u-layout">
          //         <div class="u-layout-row">
          //           <div class="u-align-left u-container-style u-layout-cell u-left-cell u-size-30 u-layout-cell-1">
          //             <div class="u-container-layout u-valign-top-md u-valign-top-sm u-valign-top-xs u-container-layout-1">
          //               <h2 class="u-text u-text-1">TITULO 4<br>
          //               </h2>
          //               <h4 class="u-text u-text-2">SUBTITULO 1</h4>
          //               <p class="u-text u-text-3">Este, es el párrafo 4 de la página web generada. Intente tener esta misma
          //                 cantidad de palabras para un mejor estilo.<br>La idea central de esta web es brindar un ejemplo visual
          //                 de como se vería el one-page generado desde la plataforma central. Recuerda que puedes editar no solo
          //                 los párrafos, títulos y subtítulos de la web, si no también sus colores para que combinen con los
          //                 colores de tu servicio o institución.<br>¡Gracias por usar nuestra plataforma!</p></div></div>
          //           <div class="u-align-left u-container-style u-image u-layout-cell u-right-cell u-size-30 u-image-1"data-image-width="1280" data-image-height="853"><div class="u-container-layout u-container-layout-2"></div></div></div></div></div></div>
          // </section>
          // <section class="u-clearfix u-color-scheme-u10 u-color-style-multicolor-1 u-palette-5-dark-3 u-section-3"
          //   id="carousel_cc2d">
          //   <div class="u-clearfix u-sheet u-sheet-1">
          //     <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
          //       <div class="u-layout">
          //         <div class="u-layout-row">
          //           <div class="u-align-left u-container-style u-image u-layout-cell u-left-cell u-size-30 u-image-1"
          //             data-image-width="150" data-image-height="147">
          //             <div class="u-container-layout u-container-layout-1"></div>
          //           </div>
          //           <div class="u-align-left u-container-style u-layout-cell u-right-cell u-size-30 u-layout-cell-2">
          //             <div class="u-container-layout u-container-layout-2">
          //               <h2 class="u-text u-text-1">TITULO 5</h2>
          //               <h4 class="u-text u-text-2">SUBTITULO 2</h4>
          //               <p class="u-text u-text-3">Este, es el párrafo 5 de la página web generada. Intente tener esta misma
          //                 cantidad de palabras para un mejor estilo.<br>La idea central de esta web es brindar un ejemplo visual
          //                 de como se vería el one-page generado desde la plataforma central. Recuerda que puedes editar no solo
          //                 los párrafos, títulos y subtítulos de la web, si no también sus colores para que combinen con los
          //                 colores de tu servicio o institución.<br>¡Gracias por usar nuestra plataforma!
          //               </p></div></div></div></div></div></div></section>
          // <section class="u-align-left u-clearfix u-palette-5-dark-3 u-section-4" id="carousel_7dd3">
          //   <div class="u-clearfix u-sheet u-valign-middle u-sheet-1"><div class="u-clearfix u-gutter-30 u-layout-wrap u-layout-wrap-1">
          //       <div class="u-layout"><div class="u-layout-row"><div class="u-size-60"><div class="u-layout-col"><div class="u-container-style u-image u-layout-cell u-right-cell u-size-30 u-image-1"
          //                 data-image-width="2250" data-image-height="1500">
          //                 <div class="u-container-layout u-container-layout-1"></div>
          //               </div><div class="u-container-style u-layout-cell u-right-cell u-size-30 u-layout-cell-2">
          //                 <div class="u-container-layout u-container-layout-2">
          //                   <h2 class="u-text u-text-default u-text-1">Titulo 6</h2>
          //                   <p class="u-text u-text-default u-text-2">Este, es el párrafo 6 de la página web generada. Intente
          //                     tener esta misma cantidad de palabras para un mejor estilo. La idea central de esta web es brindar
          //                     un ejemplo visual de como se vería el one-page generado desde la plataforma central. Recuerda que
          //                     puedes editar no solo los párrafos, títulos y subtítulos de la web, si no también sus colores para
          //                     que combinen con los colores de tu servicio o institución.<br>¡Gracias por usar nuestra
          //                     plataforma!
          //                   </p></div></div></div></div></div></div></div></div></section>
          // <section class="u-align-center u-clearfix u-palette-5-dark-2 u-section-5" id="sec-b81f">
          //   <div class="u-clearfix u-sheet u-sheet-1"><h2 class="u-text u-text-1">TITULO 7</h2><div class="u-expanded-width u-gallery u-layout-grid u-lightbox u-show-text-on-hover u-gallery-1">
          //       <div class="u-gallery-inner u-gallery-inner-1">'.
           
          //       ' </div></div></div></section>
          //       <section class="u-clearfix u-palette-5-dark-3 u-section-6" id="carousel_0c2b">
          //         <div class="u-clearfix u-sheet u-valign-middle u-sheet-1"><div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1"><div class="u-layout">
          //         <div class="u-layout-row"><div class="u-container-style u-layout-cell u-left-cell u-size-30 u-layout-cell-1"><div class="u-container-layout u-valign-top u-container-layout-1"><h4 class="u-text u-text-1">SUBTITULO 3<br></h4><h2 class="u-text u-text-2">Titulo 8</h2>
          //       <p class="u-text u-text-grey-30 u-text-3">Este, es el párrafo 7 de la página web generada. Intente tener esta misma cantidad de palabras para un mejor estilo. La idea central de esta web es brindar un ejemplo visual de como se vería el one-page generado desde la plataforma central. Recuerda que puedes
          //       editar no solo los párrafos, títulos y subtítulos de la web, si no también sus colores para que combinen con los colores de tu servicio o institución.<br></p></div></div><div class="u-container-style u-layout-cell u-right-cell u-size-30"><div class="u-container-layout u-container-layout-2">
          //       <p class="u-text u-text-grey-30 u-text-4">Correo electrónico</p><p class="u-text u-text-grey-30 u-text-5">parrafo8</p><p class="u-text u-text-grey-30 u-text-6">Dirección</p><p class="u-text u-text-grey-30 u-text-7">parrafo9</p>
          //       <div class="u-social-icons u-spacing-10 u-social-icons-1">  <a class="u-social-url" target="_blank" href=""><span class="u-icon u-icon-circle u-social-facebook u-social-type-logo u-icon-1"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style="">
          //       <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-84c7"></use></svg><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 112 112" x="0px" y="0px" id="svg-84c7">
          //       <pathd="M75.5,28.8H65.4c-1.5,0-4,0.9-4,4.3v9.4h13.9l-1.5,15.8H61.4v45.1H42.8V58.3h-8.8V42.4h8.8V32.2 c0-7.4,3.4-18.8,18.8-18.8h13.8v15.4H75.5z">
          //       ',
  //         'fallback'      => '1',
  //  )
  // );
    
  try
  {
    $codigo = '<!DOCTYPE html><html style="font-size: 16px;" lang="es-CL"><head><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta charset="utf-8"><title>Home</title>
    <link rel="stylesheet" href="https://ejemplo.productochile.cl/nicepage.css" media="screen"><link rel="stylesheet" href="https://ejemplo.productochile.cl/Home.css" media="screen">
    <script class="u-script" type="text/javascript" src="https://ejemplo.productochile.cl/jquery.js" defer=""></script><script class="u-script" type="text/javascript" src="https://ejemplo.productochile.cl/nicepage.js" defer=""></script></head>
    <body class="u-body"><section class="u-align-center u-clearfix u-palette-5-dark-3 u-valign-top-sm u-valign-top-xs u-section-1"id="sec-79db">
    <div id="carousel-b991" data-interval="5000" data-u-ride="carousel"class="u-carousel u-expanded-width u-slider u-slider-1"><ol class="u-absolute-hcenter u-carousel-indicators u-hidden u-carousel-indicators-1"><li data-u-target="#carousel-b991" class="u-active" data-u-slide-to="0"></li>
    <li data-u-target="#carousel-b991" data-u-slide-to="1"></li><li data-u-target="#carousel-b991" class="u-grey-30" data-u-slide-to="2"></li></ol><div class="u-carousel-inner" role="listbox">
    <div class="test-slide u-active u-carousel-item u-container-style u-image u-slide u-image-1"data-image-width="1280" data-image-height="719"><div class="u-container-layout u-container-layout-1"></div></div>
    <div class="u-carousel-item u-container-style u-image u-slide u-image-2" data-image-width="1280"data-image-height="853"><div class="u-container-layout u-container-layout-2"></div></div><div class="u-carousel-item u-container-style u-image u-slide u-image-3" data-image-width="1280"data-image-height="851">
    <div class="u-container-layout u-container-layout-3"></div></div></div><a class="u-absolute-vcenter u-carousel-control u-carousel-control-prev u-spacing-5 u-text-grey-30 u-carousel-control-1"href="#carousel-b991" role="button" data-u-slide="prev">
    <span aria-hidden="true"><svg viewBox="0 0 477.175 477.175"><path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"></path></svg></span>
    <span class="sr-only">Previous</span></a><a class="u-absolute-vcenter u-carousel-control u-carousel-control-next u-spacing-5 u-text-grey-30 u-carousel-control-2"href="#carousel-b991" role="button" data-u-slide="next">
    <span aria-hidden="true"><svg viewBox="0 0 477.175 477.175"><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5
    c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z">
              </path></svg></span><span class="sr-only">Next</span></a></div>
      <div class="u-clearfix u-gutter-30 u-layout-wrap u-layout-wrap-1">
        <div class="u-layout">
          <div class="u-layout-row">
            <div class="u-container-style u-layout-cell u-left-cell u-palette-1-base u-size-20 u-layout-cell-1">
              <div class="u-container-layout u-valign-top u-container-layout-4">
                <h4 class="u-align-center u-text u-text-1">'.$arr["cabecera"]["carta1"]["titulo"].'</h4>
                <p class="u-align-center u-text u-text-body-alt-color u-text-2">'.$arr["cabecera"]["carta1"]["parrafo"].'</p>
              </div></div>
            <div class="u-container-style u-layout-cell u-palette-2-base u-size-20 u-layout-cell-2">
              <div class="u-container-layout u-valign-top u-container-layout-5">
                <h4 class="u-align-center u-text u-text-3">'.$arr["cabecera"]["carta2"]["titulo"].'</h4>
                <p class="u-align-center u-text u-text-body-alt-color u-text-4">'.$arr["cabecera"]["carta2"]["parrafo"].'<br></p></div></div>
            <div
              class="u-align-center u-container-style u-layout-cell u-palette-3-base u-right-cell u-size-20 u-layout-cell-3">
              <div class="u-container-layout u-valign-top u-container-layout-6">
                <h4 class="u-text u-text-5">'.$arr["cabecera"]["carta3"]["titulo"].'</h4> 
                <p class="u-text u-text-body-alt-color u-text-6">'.$arr["cabecera"]["carta3"]["parrafo"].'</p></div></div></div></div></div></section>
    <section class="u-clearfix u-color-scheme-u10 u-color-style-multicolor-1 u-palette-5-dark-3 u-section-2"
      id="carousel_9340">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-align-left u-container-style u-layout-cell u-left-cell u-size-30 u-layout-cell-1">
                <div class="u-container-layout u-valign-top-md u-valign-top-sm u-valign-top-xs u-container-layout-1">
                  <h2 class="u-text u-text-1">'.$arr["cuerpo"]["seccion1"]["titulo"].'<br>
                  </h2>
                  <h4 class="u-text u-text-2">'.["cuerpo"]["seccion1"]["subtitulo"].'</h4>
                  <p class="u-text u-text-3">'.$arr["cuerpo"]["seccion1"]["parrafo"].'</p></div></div>
              <div class="u-align-left u-container-style u-image u-layout-cell u-right-cell u-size-30 u-image-1"data-image-width="1280" data-image-height="853"><div class="u-container-layout u-container-layout-2"></div></div></div></div></div></div>
    </section>
    <section class="u-clearfix u-color-scheme-u10 u-color-style-multicolor-1 u-palette-5-dark-3 u-section-3"
      id="carousel_cc2d">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-align-left u-container-style u-image u-layout-cell u-left-cell u-size-30 u-image-1"
                data-image-width="150" data-image-height="147">
                <div class="u-container-layout u-container-layout-1"></div>
              </div>
              <div class="u-align-left u-container-style u-layout-cell u-right-cell u-size-30 u-layout-cell-2">
                <div class="u-container-layout u-container-layout-2">
                  <h2 class="u-text u-text-1">'.$arr["cuerpo"]["seccion2"]["titulo"].'</h2>
                  <h4 class="u-text u-text-2">'.$arr["cuerpo"]["seccion2"]["subtitulo"].'</h4>
                  <p class="u-text u-text-3">'.$arr["cuerpo"]["seccion2"]["parrafo"].'</p></div></div></div></div></div></div></section>
    <section class="u-align-left u-clearfix u-palette-5-dark-3 u-section-4" id="carousel_7dd3">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1"><div class="u-clearfix u-gutter-30 u-layout-wrap u-layout-wrap-1">
          <div class="u-layout"><div class="u-layout-row"><div class="u-size-60"><div class="u-layout-col"><div class="u-container-style u-image u-layout-cell u-right-cell u-size-30 u-image-1"
                    data-image-width="2250" data-image-height="1500">
                    <div class="u-container-layout u-container-layout-1"></div>
                  </div><div class="u-container-style u-layout-cell u-right-cell u-size-30 u-layout-cell-2">
                    <div class="u-container-layout u-container-layout-2">
                      <h2 class="u-text u-text-default u-text-1">'.$arr["cuerpo"]["seccion3"]["titulo"].'</h2>
                      <p class="u-text u-text-default u-text-2">'.$arr["cuerpo"]["seccion3"]["parrafo"].'</p></div></div></div></div></div></div></div></div></section>
    <section class="u-align-center u-clearfix u-palette-5-dark-2 u-section-5" id="sec-b81f">
      <div class="u-clearfix u-sheet u-sheet-1"><h2 class="u-text u-text-1">TITULO 7</h2><div class="u-expanded-width u-gallery u-layout-grid u-lightbox u-show-text-on-hover u-gallery-1">
          <div class="u-gallery-inner u-gallery-inner-1">'.$codigoArepetir.
     
          ' </div></div></div></section>
          <section class="u-clearfix u-palette-5-dark-3 u-section-6" id="carousel_0c2b">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-container-style u-layout-cell u-left-cell u-size-30 u-layout-cell-1">
                <div class="u-container-layout u-valign-top u-container-layout-1">
                  <h4 class="u-text u-text-1">'.$arr["footer"]["subtitulo"].'<br>
                  </h4>
                  <h2 class="u-text u-text-2">'.$arr["footer"]["titulo"].'</h2>
                  <p class="u-text u-text-grey-30 u-text-3">'.$arr["footer"]["cuerpo"].'<br>
                  </p>
                </div>
              </div>
              <div class="u-container-style u-layout-cell u-right-cell u-size-30">
                <div class="u-container-layout u-container-layout-2">
                  <p class="u-text u-text-grey-30 u-text-4">Correo electrónico</p>
                  <p class="u-text u-text-grey-30 u-text-5">'.$arr["footer"]["correo"].'</p>
                  <p class="u-text u-text-grey-30 u-text-6">Dirección</p>
                  <p class="u-text u-text-grey-30 u-text-7">'.$arr["footer"]["direccion"].'</p>
                  <div class="u-social-icons u-spacing-10 u-social-icons-1">
                    <a class="u-social-url" target="_blank" href="'.$arr["footer"]["facebook"].'"><span class="u-icon u-icon-circle u-social-facebook u-social-type-logo u-icon-1"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-84c7"></use></svg><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 112 112" x="0px" y="0px" id="svg-84c7"><path d="M75.5,28.8H65.4c-1.5,0-4,0.9-4,4.3v9.4h13.9l-1.5,15.8H61.4v45.1H42.8V58.3h-8.8V42.4h8.8V32.2 c0-7.4,3.4-18.8,18.8-18.8h13.8v15.4H75.5z"></path></svg></span>
                    </a>
                    <a class="u-social-url" target="_blank" href="'.$arr["footer"]["twitter"].'"><span class="u-icon u-icon-circle u-social-twitter u-social-type-logo u-icon-2"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-f896"></use></svg><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 112 112" x="0px" y="0px" id="svg-f896"><path d="M92.2,38.2c0,0.8,0,1.6,0,2.3c0,24.3-18.6,52.4-52.6,52.4c-10.6,0.1-20.2-2.9-28.5-8.2 c1.4,0.2,2.9,0.2,4.4,0.2c8.7,0,16.7-2.9,23-7.9c-8.1-0.2-14.9-5.5-17.3-12.8c1.1,0.2,2.4,0.2,3.4,0.2c1.6,0,3.3-0.2,4.8-0.7 c-8.4-1.6-14.9-9.2-14.9-18c0-0.2,0-0.2,0-0.2c2.5,1.4,5.4,2.2,8.4,2.3c-5-3.3-8.3-8.9-8.3-15.4c0-3.4,1-6.5,2.5-9.2 c9.1,11.1,22.7,18.5,38,19.2c-0.2-1.4-0.4-2.8-0.4-4.3c0.1-10,8.3-18.2,18.5-18.2c5.4,0,10.1,2.2,13.5,5.7c4.3-0.8,8.1-2.3,11.7-4.5 c-1.4,4.3-4.3,7.9-8.1,10.1c3.7-0.4,7.3-1.4,10.6-2.9C98.9,32.3,95.7,35.5,92.2,38.2z"></path></svg></span>
                    </a>
                    <a class="u-social-url" target="_blank" href="'.$arr["footer"]["instagram"].'"><span class="u-icon u-icon-circle u-social-instagram u-social-type-logo u-icon-3"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-6565"></use></svg><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 112 112" x="0px" y="0px" id="svg-6565"><path d="M55.9,32.9c-12.8,0-23.2,10.4-23.2,23.2s10.4,23.2,23.2,23.2s23.2-10.4,23.2-23.2S68.7,32.9,55.9,32.9z M55.9,69.4c-7.4,0-13.3-6-13.3-13.3c-0.1-7.4,6-13.3,13.3-13.3s13.3,6,13.3,13.3C69.3,63.5,63.3,69.4,55.9,69.4z"></path><path d="M79.7,26.8c-3,0-5.4,2.5-5.4,5.4s2.5,5.4,5.4,5.4c3,0,5.4-2.5,5.4-5.4S82.7,26.8,79.7,26.8z"></path><path d="M78.2,11H33.5C21,11,10.8,21.3,10.8,33.7v44.7c0,12.6,10.2,22.8,22.7,22.8h44.7c12.6,0,22.7-10.2,22.7-22.7 V33.7C100.8,21.1,90.6,11,78.2,11z M91,78.4c0,7.1-5.8,12.8-12.8,12.8H33.5c-7.1,0-12.8-5.8-12.8-12.8V33.7 c0-7.1,5.8-12.8,12.8-12.8h44.7c7.1,0,12.8,5.8,12.8,12.8V78.4z"></path></svg></span>
                    </a>
                    <a class="u-social-url" target="_blank" href="'.$arr["footer"]["youtube"].'"><span class="u-icon u-icon-circle u-social-type-logo u-social-youtube u-icon-4"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-2087"></use></svg><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 112 112" x="0px" y="0px" id="svg-2087"><path d="M82.3,24H29.7C19.3,24,11,32.5,11,43v26.7c0,10.5,8.3,19,18.7,19h52.5c10.3,0,18.7-8.5,18.7-19V43 C101,32.5,92.7,24,82.3,24L82.3,24z M69.7,57.6L45.1,69.5c-0.7,0.2-1.4-0.2-1.4-0.8V44.1c0-0.7,0.8-1.3,1.4-0.8l24.6,12.6 C70.4,56.2,70.4,57.3,69.7,57.6L69.7,57.6z"></path></svg></span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    ';
    
    // Crea el archivo
    file_put_contents("index.html" , $codigo);

      //Subir un archivo existente
      error_reporting(E_ALL);
      $username = 'productochile';
      $password = 'yC7A6&!bCrpO';
      $cpanel_host = 'productochile.cl';
      $request_uri = "https://culturaparatodos.cl:2083/execute/Fileman/upload_files";
      $upload_file = realpath("index.html");
      $destination_dir = $rutaDeGuardado;

      if( function_exists( 'curl_file_create' ) ) {
        $cf = curl_file_create( $upload_file );
      } else {
        $cf = "@/".$upload_file;
      }
      
      $payload = array(
        'dir'    => $destination_dir,
        'file-1' => $cf
      );

      $ch = curl_init( $request_uri );

      curl_setopt( $ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );
      curl_setopt( $ch, CURLOPT_USERPWD, $username . ':' . $password );
      curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
      curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
      // Set up a POST request with the payload.
      curl_setopt( $ch, CURLOPT_POST, true );
      curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      // Make the call, and then terminate the cURL caller object.
      $curl_response = curl_exec( $ch );
      curl_close( $ch );
      // Decode and validate output.
      $response = json_decode( $curl_response );
      if( empty( $response ) ) {
          echo "The cURL call did not return valid JSON:\n";
          die( $response );
      } elseif ( !$response->status ) {
          echo "The cURL call returned valid JSON, but reported errors:\n";
          die( $response->errors[0] . "\n" );
      }

      // Print and exit.
      die( print_r( $response ) );

      print_r("OK");
    }

    catch(Exception $eaLGO)
    {
      file_put_contents("php://stderr", "ERROR- Al crear index."."\n");
      echo(0);
    }
 

    //print_r("OK");
    file_put_contents("php://stderr", "OK - Se creó el index.html"."\n");
    file_put_contents("php://stderr", "OK - Todo ok."."\n");
      
    //Indica que está todo ok al cliente
    echo(1);
    print_r("ok");
  }

  catch(Exception $e2)
  {
    file_put_contents("php://stderr", "Error - No se subió el archivo HTML."."\n");
    //echo("Ocurrió un error al intentar subir archivo HTML.");
    echo(0);
  }

?>