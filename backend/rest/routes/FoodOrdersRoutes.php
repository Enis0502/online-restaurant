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
    
    //fixed
    Flight::route("DELETE /foodOrders/food/@food/order/@order", function($food, $order){
        Flight::json((Flight::FoodOrdersService()->removeFromFoodOrder($food, $order)));
    });

    Flight::route('PUT /foodOrders/@order_id/food/@food_id', function($order_id, $food_id) {
        $data = json_decode(Flight::request()->getBody(), true);
        $quantity = $data['quantity'];
        Flight::json(Flight::FoodOrdersService()->updateQuantity($food_id, $order_id, $quantity));
    });

?>