<?php 

    require_once __DIR__. "/../dao/BaseDao.php";

    class BaseService{
        protected $dao;

        public function __construct($dao){
            $this->dao = $dao;
        }  
        
        public function getAll(){
            return $this->dao->getAll();
        }

        public function insert($data) {
            $columns = $this->dao->getColumnNames();
            $required = array_diff($columns, ['id']); 

            foreach ($required as $column) {
                if (!isset($data[$column]) || $data[$column] === null) {
                    throw new Exception("Missing or empty required field: $column");
                }
            }
            return $this->dao->insert($data);
        }

        public function getById($id){
            return $this->dao->getById($id);
        }

        public function deleteById($id){
            $exists = $this->dao->getById($id);
            if(!$exists){
                throw new Exception("Id not found");
            }

            return $this->dao->deleteById($id);
        }

        public function update($id, $data){
            $exists = $this->dao->getById($id);
            if(!$exists){
                throw new Exception("Id not found");
            }
            
            return $this->dao->update($id, $data);

        }

        public function searchFoodsCategories($keyword){
            return $this->dao->searchFoodsCategories($keyword);
        }
    }


?>