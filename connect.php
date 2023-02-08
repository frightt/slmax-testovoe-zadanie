<?php

class Database
{
    public function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "123";
        $dbname = "users";


        $conn = new mysqli($servername, $username, $password, $dbname);


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}

