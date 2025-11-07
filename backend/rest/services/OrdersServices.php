<?php 

    require_once "BaseService.php";
    require_once __DIR__. "/../dao/OrdersDao.php";

    class OrdersService extends BaseService{
        public function __construct(){
            $dao = new OrdersDao();
            parent::__construct($dao);
        }

        //Do i need any restrictions here?
        public function getByStatus($user_id, $status){
            return $this->dao->getByStatus($user_id, $status);
        }

        public function getByUserId($user_id){
            return $this->dao->getByUserId($user_id);
        }
    }

?>