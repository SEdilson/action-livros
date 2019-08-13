<?php
    class Livro {
        private $conn;
        private $table_name = 'livros';

        public $id;
        public $nome_livro;
        public $isbn;
        public $data_criacao;
        public $num_paginas;

        public function __construct($db) {
            $this->conn = $db;
        }

        function read() {
            $query = "SELECT * FROM " . $this->table_name . " ";
            
            $readData = $this->conn->prepare($query);
            $readData->execute();

            return $readData;
        }

        function create() {
            $query = "INSERT INTO " . $this->table_name . "(nome_livro, isbn, data_criacao, num_paginas) VALUES (:nome_livro, :isbn, :data_criacao, :num_paginas) ";

            $readData = $this->conn->prepare($query);

            $this->nome_livro = htmlspecialchars(strip_tags($this->nome_livro));
            $this->isbn = htmlspecialchars(strip_tags($this->isbn));
            $this->data_criacao = htmlspecialchars(strip_tags($this->data_criacao));
            $this->num_paginas = htmlspecialchars(strip_tags($this->num_paginas));

            $readData->bindParam(':nome_livro', $this->nome_livro);
            $readData->bindParam(':isbn', $this->isbn);
            $readData->bindParam(':data_criacao', $this->data_criacao);
            $readData->bindParam(':num_paginas', $this->num_paginas);

            if($readData->execute()) {
                return true;
            }

            return false;
        }
    }