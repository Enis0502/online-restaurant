<?php 

    require_once "BaseService.php";
    require_once __DIR__. "/../dao/BookingDao.php";

    class BookingService extends BaseService{
        public function __construct(){
            $dao = new BookingDao();
            parent::__construct($dao);
        }

        public function getBookingsByDate($date){
            return $this->dao->getBookingsByDate($date);
        }

        public function bookTable($data){
            if($data["date"] <= date("Y-m-d")){
                throw new Exception("Reservation date can't be before or on today's date!");
            }elseif($data["guest_number"] < 1){
                throw new Exception("Number of guests can't be less than 1");
            }else{
                return $this->dao->bookTable($data);
            }
        }

        public function getUpcomingBookings(){
            return $this->dao->getUpcomingBookings();
        }

    }
?>