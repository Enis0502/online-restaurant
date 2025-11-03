<?php 
    require_once "BaseDao.php";

    class FoodOrdersDao extends BaseDao{
        public function __construct(){
            parent::__construct("food_orders");
        }

        public function getFoodsByOrder($order_id){
            $stmt = $this->connection->prepare(
                "SELECT order_id, name, order_date, quantity, (food_orders.quantity * foods.price) AS total
                FROM ". $this->table_name. "
                join orders on food_orders.order_id = orders.id
                join foods on food_orders.food_id = foods.id
                where order_id = :order_id"
            );
            $stmt->bindParam(":order_id", $order_id);
            $stmt->execute();
            return $stmt->fetchAll();
                
        }

        public function removeFromFoodOrder($food_id, $order_id){
            $stmt = $this->connection->prepare("DELETE FROM ". $this->table_name . " WHERE food_id = :food_id AND order_id = :order_id;");
            $stmt->execute(["food_id" => $food_id, "order_id" => $order_id]);
            return $stmt->execute();
        }   

        public function updateQuantity($food_id, $order_id, $quantity){
            $stmt = $this->connection->prepare("UPDATE ". $this->table_name . " SET quantity = :quantity WHERE food_id = :food_id AND order_id = :order_id;");
            $stmt ->execute(["food_id" => $food_id, "order_id" => $order_id, "quantity" => $quantity]);
            return $stmt->execute();
        }


    }

?>