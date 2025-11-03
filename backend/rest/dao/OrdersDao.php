<?php 
    require_once "BaseDao.php";

    class OrdersDao extends BaseDao{
        public function __construct(){
            parent::__construct("orders");
        }

        public function getByStatus($user_id, $status){
            $stmt = $this->connection->prepare("SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id AND status = :status;");
            $stmt->execute(["user_id" => $user_id, "status" => $status]);
            return $stmt->fetchAll();
        }

        public function getByUserId($user_id){
            $stmt = $this->connection->prepare("SELECT * FROM ". $this->table_name. " WHERE user_id = :user_id;");
            $stmt->bindParam(":user_id", $user_id);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

?>