<?php 
    require_once "BaseService.php";
    require_once __DIR__ . "/../dao/FoodOrdersDao.php";

    class FoodOrdersService extends BaseService{
        public function __construct(){
            $dao = new FoodOrdersDao();
            parent::__construct($dao);
        }

        public function getFoodsByOrder($order_id){
            return $this->dao->getFoodsByOrder($order_id);
        }

        public function removeFromFoodOrder($food_id, $order_id){
            //to be modified
            return $this->dao->removeFromFoodOrder($food_id, $order_id);
        }

        public function updateQuantity($food_id, $order_id, $quantity){
            if($quantity < 1){
                throw new Exception("Quantity can not be less than 1");
            }
            return $this->dao->updateQuantity($food_id, $order_id, $quantity);
        }

    }


?>