<?php
    // headers para no tener problema con cors
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    // header tipo json
    header('Content-Type: application/json');

    $data = json_decode(utf8_encode(file_get_contents("php://input")), true);
    print_r(json_encode(registrar($fluent, $data)));
?>