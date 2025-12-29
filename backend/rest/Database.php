<?php 

use Dba\Connection;

require_once __DIR__."/config.php";


class Database{
    private static $connection = null;

    public static function connect(){
        if (self::$connection === null) {
           try {
               self::$connection = new PDO(
            "mysql:host=" . Config::DB_HOST() . ";dbname=" . Config::DB_NAME() . ";port=" . Config::DB_PORT() . ";charset=utf8",
            Config::DB_USER(),
            Config::DB_PASSWORD(),
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_SSL_CA => __DIR__ . "/certs/ca-certificate.crt" // putanja do CA certifikata
                ]
            );
           } catch (PDOException $e) {
               die("Connection failed: " . $e->getMessage());
           }
       }
       return self::$connection;

    }

}


?>