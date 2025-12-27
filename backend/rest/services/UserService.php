<?php 

    require_once "BaseService.php";
    require_once __DIR__. "/../dao/UserDao.php";
    require __DIR__. "/../../data/roles.php";

    class UserService extends BaseService{
        public function __construct(){
            $dao = new UserDao();
            parent::__construct($dao);
        }

        private function validateEmail($email){
            if(!isset($email) || empty(trim($email))){
                throw new Exception("Email is required", 400);
            }
        }

        private function validateRole($role){
            if(!isset($role) || empty(trim($role))){
                throw new Exception("Role is required.", 400);
            }

            if($role != Roles::ADMIN && $role != Roles::USER){
                throw new Exception("Ivnalid role.", 400);
            }
        }

        public function getByEmail($email){
            $this->validateEmail($email);
            return $this->dao->getByEmail($email);
        }

        public function getByRole($role){
            $this->validateRole($role);
            return $this->dao->getByRole($role);
        }
    }

?>