<?php
    class Autor {
        private $conn;
        private $table_name = 'autores';
        
        public $id;
        public $nome_autor;
        public $data_nasc;
    
        public function __construct($db) {
            $this->conn = $db;
        }

        function read() {
            $query = "SELECT * FROM ". $this->table_name ." ";

            $readData = $this->conn->prepare($query);
            $readData->execute();

            return $readData;
        }

        function create() {
            $query = "INSERT INTO " . $this->table_name . "(nome_autor, data_nasc) VALUES(:nome_autor, :data_nasc)";
            $readData = $this->conn->prepare($query);

            $this->nome_autor = htmlspecialchars(strip_tags($this->nome_autor));
            $this->data_nasc = htmlspecialchars(strip_tags($this->data_nasc));
    
            $readData->bindParam(":nome_autor", $this->nome_autor);
            $readData->bindParam(":data_nasc", $this->data_nasc);
    
            if($readData->execute()) {
                return true;
            }

            return false;
        }
    }
?>