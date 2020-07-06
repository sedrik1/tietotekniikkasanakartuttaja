<?php

class ConnStatic 
{
    private static $host = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $dbname = "words";

    public static function connect() 
    {
        $dsn = 'mysql:host=' . self::$host . ";dbname=" . self::$dbname;
        $conn = new PDO($dsn, self::$username, self::$password);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    }
}