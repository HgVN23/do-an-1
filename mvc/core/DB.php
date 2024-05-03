<?php
require_once('./core/config.php');
class DB
{
    protected $conn;
    protected $severname = SERVERNAME;
    protected $username = USERNAME;
    protected $password = PASSWORD;
    protected $dbname = DBNAME;
    protected $port = PORT;

    public function __construct()
    {
        $this->conn = new mysqli($this->severname, $this->username, $this->password, $this->dbname, $this->port);
        mysqli_set_charset($this->conn, 'utf8');
    }
}
