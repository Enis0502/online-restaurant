<?php 

    Flight::route('GET /booking', function(){
        Flight::json((Flight::BookingService()->getBookingsByDate()));
    })

?>
