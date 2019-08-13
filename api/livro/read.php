<?php
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Connection: keep-alive");
    
        include_once('../config/database.php');
        include_once('../objects/livro.php');

        $database = new Database();
        $db = $database->getConnection();

        $livro = new Livro($db);

        $readData = $livro->read();
        $numLinhas = $readData->rowCount();

        if($numLinhas > 0) {
            $livros_arr = array();
            $livros_arr["dados"] = array();

            while($row = $readData->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $livro_data = array(
                    "id" => $id,
                    "nome_livro" => $nome_livro,
                    "isbn" => $isbn,
                    "data_criacao" => $data_criacao,
                    "num_paginas" => $num_paginas
                );

                array_push($livros_arr["dados"], $livro_data);
            }

            http_response_code(200);

            echo json_encode($livros_arr);
        } else {
            http_response_code(404);

            echo json_encode(array("mensagem" => "Não foram encontrados livros"));
        }