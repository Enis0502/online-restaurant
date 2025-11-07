<?php 
    require_once "BaseDao.php";

    class BookingDao extends BaseDao{
        public function __construct(){
            parent::__construct("bookings");
        }

        public function getBookingsByDate($date){
            $stmt = $this->connection->prepare("SELECT * FROM " . $this->table_name . " WHERE Date(date) = :date;");
            $stmt->bindParam(":date", $date);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function bookTable($data){
            $colums = implode(", ", array_keys($data));
            $placeholders =  ":" . implode(", :", array_keys($data));
            $stmt = $this->connection->prepare("INSERT INTO " .$this->table_name. " ($colums) VALUES ($placeholders);");
            return $stmt->execute($data);
        }

        public function getUpcomingBookings(){
            $stmt = $this->connection->prepare("SELECT * FROM " . $this->table_name . " WHERE date > curdate();");
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

?>