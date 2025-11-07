<?php 

    require_once "BaseService.php";
    require_once __DIR__. "/../dao/CategoryDao.php";

    class CategoryService extends BaseService{
        public function __construct(){
            $dao = new CategoryDao();
            parent::__construct($dao);
        }

        //Nothing to implement since there are no methods in CategoryDao.php
    }


?> 