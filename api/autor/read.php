<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Connection: keep-alive");

    include_once('../config/database.php');
    include_once('../objects/autor.php');

    $database = new Database();
    $db = $database->getConnection();

    $autor = new Autor($db);

    $readData = $autor->read();
    $numLinhas = $readData->rowCount();

    if($numLinhas > 0) {
        $autores_arr = array();
        $autores_arr["dados"] = array();

        while($row = $readData->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $autor_data = array(
                "id" => $id,
                "nome_autor" => $nome_autor,
                "data_nasc" => $data_nasc
            );

            array_push($autores_arr["dados"], $autor_data);
        }

        http_response_code(200);

        echo json_encode($autores_arr);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Não foram encontrados autores."));
    }