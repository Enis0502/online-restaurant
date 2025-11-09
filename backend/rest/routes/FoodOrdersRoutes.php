<?php 

    Flight::route("GET /foodOrders", function(){
        Flight::json((Flight::FoodOrdersService()->getAll()));
    });

    Flight::route("POST /foodOrders", function(){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::FoodOrdersService()->insert($data)));
    });

    Flight::route("GET /foodOrders/@id", function($id){
        Flight::json((Flight::FoodOrdersService()->getById($id)));
    });

    Flight::route("DELETE /foodOrders/@id", function($id){
        Flight::json((Flight::FoodOrdersService()->deleteById($id)));
    });

    Flight::route("PUT /foodOrders/@id", function($id){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::FoodOrdersService()->update($id, $data)));
    });

    Flight::route("GET /foodOrders/order/@order", function($order){
        Flight::json((Flight::FoodOrdersService()->getFoodsByOrder($order)));
    });
    
    //needs fix
    Flight::route("GET /foodOrders/order/@order/food/@food", function($order, $food){
        Flight::json((Flight::FoodOrdersService()->removeFromFoodOrder($order, $food)));
    })

?>