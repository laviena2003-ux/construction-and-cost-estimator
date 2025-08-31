<?php
class Config {
    public static function getConnection() {
        $host = "localhost";
        $db = "construction_db";
        $user = "root";
        $pass = "";
        try {
            $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("DB Connection failed: " . $e->getMessage());
        }
    }
}
?>
