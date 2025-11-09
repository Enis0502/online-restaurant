<?php 
    
    //why does this path work but this one does not?  require "vendor/autoload.php";
    require __DIR__ . "/../vendor/autoload.php";

    require __DIR__. "/rest/services/BookingService.php";
    require_once __DIR__. "/rest/routes/BookingRoutes.php";

    require __DIR__. "/rest/services/CategoryService.php";
    require_once __DIR__. "/rest/routes/CategoryRoutes.php";

    require __DIR__. "/rest/services/FoodService.php";
    require_once __DIR__. "/rest/routes/FoodRoutes.php";

    
    require __DIR__. "/rest/services/FoodOrdersService.php";
    require_once __DIR__. "/rest/routes/FoodOrdersRoutes.php";
    
    Flight::register("BookingService", "BookingService");
    Flight::register("CategoryService", "CategoryService");
    Flight::register("FoodService", "FoodService");
    Flight::register("FoodOrdersService", "FoodOrdersService");


    Flight::route("/", function(){
        echo "Hello guuuuuyssss";

    });


    Flight::start();

?>