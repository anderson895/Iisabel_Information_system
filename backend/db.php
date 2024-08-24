<?php
// define("db_host", "localhost");
// define("db_user", "u136104272_root");
// define("db_pass", "Bugtong#123");
// define("db_name", "u136104272_isabelapp");


define("db_host", "localhost");
define("db_user", "root");
define("db_pass", "");
define("db_name", "u136104272_isabelapp");


class db_connect
{
    public $host = db_host;
    public $user = db_user;
    public $pass = db_pass;
    public $name = db_name;
    public $conn;
    public $error;
    public $mysqli;

    public function __construct()
    {
        $this->connect(); // Tawagin ang connect() method sa pag-construct ng instance
    }

    public function connect()
    {
        try {
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name);
    
            // Check connection
            if ($this->conn->connect_error) {
                $this->error = "Connection failed: " . $this->conn->connect_error;
                return false;
            } else {
             //   echo "Connected successfully"; // Ito ay optional, depende sa pangangailangan mo
                return $this->conn;
            }
        } catch (\Throwable $th) {
            $this->error = "Connection error: " . $th->getMessage();
            return false;
        }
    }
    
}
