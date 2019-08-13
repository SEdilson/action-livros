<?php
    class Editora {
        private $conn;
        private $table_name = 'editoras';

        public $id;
        public $nome_editora;
        public $data_fundacao;

        public function __construct($db) {
            $this->conn = $db;
        }

        function read() {
            $query = "SELECT * FROM " . $this->table_name .  "";

            $readData = $this->conn->prepare($query);
            $readData->execute();

            return $readData;
        }

        function create() {
            $query = "INSERT INTO " . $this->table_name . "(nome_editora, data_fundacao) VALUES (:nome_editora, :data_fundacao)";
            $readData = $this->conn->prepare($query);

            $this->nome_editora = htmlspecialchars(strip_tags($this->nome_editora));
            $this->data_fundacao = htmlspecialchars(strip_tags($this->data_fundacao));

            $readData->bindParam(':nome_editora', $this->nome_editora);
            $readData->bindParam(':data_fundacao', $this->data_fundacao);

            if($readData->execute()) {
                return true;
            }

            return false;
        }
    }
?>