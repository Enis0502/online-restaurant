<?php 
    require_once "BaseDao.php";

    class UserDao extends BaseDao{
        public function __construct(){
            parent::__construct("users");
        }
        
        public function getByEmail($email){
            $stmt = $this->connection->prepare("SELECT * FROM ". $this->table_name . " WHERE email = :email;");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function getByRole($role){
            $stmt = $this->connection->prepare("SELECT * FROM " . $this->table_name . " WHERE role = :role;");
            $stmt->execute(["role" => $role]);
            return $stmt->fetchAll();
        }
    }

?>