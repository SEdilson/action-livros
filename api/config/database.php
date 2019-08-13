<?php
    class Database {

        private $host = 'localhost';
        private $dbname = 'action-livros';
        private $user = 'postgres';
        private $password = 'postgres';
        public $conn;

        public function getConnection() {
            $this->conn = null;

            try {
                $this->conn = new PDO("pgsql:host={$this->host};port= 5432;dbname={$this->dbname};", $this->user, $this->password);
                $this->conn->exec("set names utf8");
            }catch(Exception $exception) {
                echo "Erro com a conexão: " . $exception->getMessage();
            }

            return $this->conn;
        }
    }
?>