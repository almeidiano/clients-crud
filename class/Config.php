<?php 
class Config{
    const DB_DRIVER = 'pgsql';
    const DB_HOST = 'localhost';
    const DB_DATABASE = 'api_project';
    CONST DB_USER = 'postgres';
    const DB_PASS = '270902';
}

class DB{
    public function connect() {
        return $this->dbConfig();
    }
    private function dbConfig() {
        try{
            $pdo = new PDO(Config::DB_DRIVER.":dbname=".Config::DB_DATABASE.";host=".Config::DB_HOST, Config::DB_USER, Config::DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}

$array = [
        // 'error' => [],
    'result' => []
];

