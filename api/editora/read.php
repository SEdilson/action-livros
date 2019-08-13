<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Connection: keep-alive");

    include_once('../config/database.php');
    include_once('../objects/editora.php');

    $database = new Database();
    $db = $database->getConnection();

    $editora = new Editora($db);

    $readData = $editora->read();
    $numLinhas = $readData->rowCount();

    if($numLinhas > 0) {
        $editoras_arr = array();
        $editoras_arr["dados"] = array();

        while($row = $readData->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $editora_data = array(
                "id" => $id,
                "nome_editora" => $nome_editora,
                "data_fundacao" => $data_fundacao
            );

            array_push($editoras_arr["dados"], $editora_data);
        }
    }