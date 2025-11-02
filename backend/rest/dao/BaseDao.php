<?php 

require_once __DIR__."/../config.php";

class BaseDao{
    protected $connection;
    protected $table_name;

    public function __construct($table_name){
        $this->table_name = $table_name;
        $this->connection = Database::connect();
    }

    public function getAll(){
        $stmt = $this->connection->prepare("SELECT * FROM ". $this->table_name . " ;");
        $stmt -> execute();
        return $stmt -> fetchAll();
    }

    public function insert($data){
        $columns = implode(", ", array_keys($data));
        $placeoholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO " . $this->table_name . " ($columns) VALUES ($placeoholders);";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);        
    }

    public function getById($id){
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table_name . " WHERE id = :id;");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();

    }

    public function deleteById($id){
        $stmt = $this->connection->prepare("DELETE FROM " . $this->table_name . " WHERE id = :id;");
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }


    public function update($id, $data){
        $fields = "";
        foreach($data as $key => $value){
            $fields .= "$key = :$key, ";
        }

        $fields = rtrim($fields, ", ");
        $stmt = $this->connection->prepare("UPDATE " . $this->table_name . " SET $fields WHERE id = :id");
        $data["id"] = $id;
        return $stmt->execute($data);
    }

    //this method was placed in BaseDao since it repeated in both the FoodDao.php and  CategoryDao.php
    public function searchFoodsCategories($keyword){
            $keyword = "%$keyword%";
            $stmt = $this->connection->prepare("SELECT * FROM ". $this->table_name. " WHERE name LIKE :keyword OR description LIKE :keyword;");
            $stmt->execute(["keyword" => $keyword]);
            return $stmt->fetchAll();
    }

}


?>