<?php
    class Connection 
    {
        private $host = 'localhost';
        private $user = 'root';
        private $password = '';
        private $db = 'DocShare';
        public $connection;

        function __construct()
        {
            $conn = mysqli_connect($this->host, $this->user, $this->password);
            $dbselect = mysqli_select_db($conn, $this->db);
            $this->connection = $conn;
        }
    }
?>