<?php 

    require_once "BaseService.php";
    require_once __DIR__. "/../dao/FoodDao.php";

    class FoodService extends BaseService{
        public function __construct(){
            $dao = new FoodDao();
            parent::__construct($dao);
        }

        public function sortByPrice($order){
            if(!(in_array(strtoupper($order), ["ASC", "DESC"]))){
                throw new Exception("Wrong order passed.(ASC or DESC)");
            }
            return $this->dao->sortByPrice($order);
        }

        public function getFoodsByCategory($category){
            return $this->dao->getFoodsByCategory($category);
        }
    }


?>