<?php 
    require_once "BaseDao.php";

    class FoodDao extends BaseDao{
        public function __construct(){
            parent::__construct("foods");
        }

        public function sortByPrice($order){
            if(!(in_array(strtoupper($order), ["ASC", "DESC"]))){
                throw new Exception("Wrong order passed.");
            }
            $stmt = $this->connection->prepare("SELECT * FROM " . $this->table_name . " ORDER BY price " .$order. ";");
            $stmt -> execute();
            return $stmt->fetchAll();
        }

        public function getFoodsByCategory($category){
            $stmt = $this->connection->prepare("SELECT * FROM ". $this->table_name . " WHERE category = :category;");
            $stmt->bindParam(":category", $category);
            $stmt->execute();
            return $stmt->fetchAll();
        }

    
    }

?>