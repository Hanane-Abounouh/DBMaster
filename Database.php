<?php
require_once 'Config.php';

class Database {
    private static $con = null;

    public static function getConnection() {
        if (self::$con === null) {
            try {
                self::$con = new PDO('mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME, Config::DB_USER, Config::DB_PASS);
                self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$con;
    }
}
?>
