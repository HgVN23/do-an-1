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

    public function select($query)
    {
        $result = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        if ($result->num_rows > 0) {
            return $result;
        }
        return false;
    }

    public function insert($query)
    {
        $result = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        if ($result) {
            return $result;
        }
        return false;
    }

    public function update($query)
    {
        $result = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        if ($result) {
            return $result;
        }
        return false;
    }

    public function delete($query)
    {
        $result = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        if ($result) {
            return $result;
        }
        return false;
    }
}
