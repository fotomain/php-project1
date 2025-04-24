<?php

namespace Framework;

use PDO;

class Database
{
    public $conn;
    public function __construct($config,)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            //FETCH_ASSOC => ['title']
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        ];
        try{
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
//            echo "Connected successfully!!!";
        } catch(PDOException $e) {
            throw new Exception("Connection failed 101: " . $e->getMessage());
        }
    }

    public function query($query,$params = []){
        try {
            $stmt = $this->conn->prepare($query);

            foreach($params as $param=>$value){
                $stmt->bindValue(':'.$param,$value);
            }

            $stmt->execute();
            return $stmt;
        } catch (PDOException $e){
            throw new Exception("Query failed 102: " . $e->getMessage());
        }
    }

}