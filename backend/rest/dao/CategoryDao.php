<?php 

    require_once "BaseDao.php";

    class CategoryDao extends BaseDao{
        public function __construct(){
            parent::__construct("categories");
        }

        // There will be no methods implemented here since everything is covered with generic methods from BaseDao.php 

    }

?>