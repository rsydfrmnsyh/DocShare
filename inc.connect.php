<?php
class Connection
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $db = 'docshare';
    public $connection;

    function __construct()
    {
        $this->connect();
    }

    function connect()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password);
        mysqli_select_db($conn, $this->db);
        $this->connection = $conn;
    }
}
?>