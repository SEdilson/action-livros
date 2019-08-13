<?php   
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once('../config/database.php');
    include_once('../objects/autor.php');

    $database = new Database();
    $db = $database->getConnection();

    $autor = new Autor($db);

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->nome_autor) && !empty($data->data_nasc)) {
        $autor->nome_autor = $data->nome_autor;
        $autor->data_nasc = $data->data_nasc;

        if($autor->create()) {
            http_response_code(201);

            echo json_encode(array("messagem" => "Autor cadastrado com sucesso."));
        } else {
            http_response_code(503);
            
            echo json_encode(array("mensagem" => "Não foi possível cadastrar o autor."));
        }
    } else {
        http_response_code(400);

        echo json_encode(array("mensagem" => "Não foi possível criar o autor. Dados imcompletos."));
    }