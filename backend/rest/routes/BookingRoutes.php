<?php 
    
    Flight::route("GET /bookings", function(){
        Flight::json((Flight::BookingService()->getAll()));
    });

    // Flight::route("POST /bookings", function(){
    //     $data = Flight::request()->data->getData();
    //     Flight::json((Flight::BookingService()->insert($data)));
    // });

    Flight::route("GET /bookings/@id", function($id){
        Flight::json((Flight::BookingService()->getById($id)));
    });

    Flight::route("DELETE /bookings/@id", function($id){
        Flight::json((Flight::BookingService()->deleteById($id)));
    });

    Flight::route("PUT /bookings/@id", function($id){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::BookingService()->update($id, $data)));
    });

    //query string
    Flight::route("GET /bookings/date/@date", function($date){
        Flight::json((Flight::BookingService()->getBookingsByDate($date)));
    });

    Flight::route("POST /bookings", function(){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::BookingService()->bookTable($data)));
    });

    //needs fix
    Flight::route("GET /bookings/upcoming", function(){
        Flight::json((Flight::BookingService()->getUpcomingBookings()));
    });
?>
