<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once('../config/database.php');
    include_once('../objects/livro.php');

    $database = new Database();
    $db = $database->getConnection();

    $livro = new Livro($db);

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->nome_livro) && !empty($data->isbn) && !empty($data->data_criacao) && !empty($data->num_paginas)) {
        $livro->nome_livro = $data->nome_livro;
        $livro->isbn = $data->isbn;
        $livro->data_criacao = $data->data_criacao;
        $livro->num_paginas = $data->num_paginas;

        if($livro->create()) {
            http_response_code(201);

            echo json_encode(array("mensagem" => "Livro cadastrado com sucesso."));
        } else {
            http_response_code(503);

            echo json_encode(array("mensagem" => "Não foi possível cadastrar livro. Problemas com o servidor."));
        }
    } else {
        http_response_code(400);

        echo json_encode(array("mensagem" => "Não foi possível cadastrar livro. Dados imcompletos."));
    }