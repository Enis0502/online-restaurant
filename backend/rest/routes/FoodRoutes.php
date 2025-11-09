<?php 

    Flight::route("GET /foods", function(){
        Flight::json((Flight::FoodService()->getAll()));
    });

     Flight::route("POST /foods", function(){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::FoodService()->insert($data)));
    });

    Flight::route("GET /foods/@id", function($id){
        Flight::json((Flight::FoodService()->getById($id)));
    });

    Flight::route("DELETE /foods/@id", function($id){
        Flight::json((Flight::FoodService()->deleteById($id)));
    });

    Flight::route("PUT /foods/@id", function($id){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::FoodService()->update($id, $data)));
    });

    
    Flight::route("GET /foods/order/@order", function($order){
       Flight::json((Flight::FoodService()->sortByPrice($order)));
    });

    Flight::route("GET /foods/category/@category", function($category){
       Flight::json((Flight::FoodService()->getFoodsByCategory($category)));
    });


?>