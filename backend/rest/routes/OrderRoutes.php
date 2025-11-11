<?php 

    Flight::route("GET /orders", function(){
        Flight::json((Flight::OrdersService()->getAll()));
    });

    Flight::route("POST /orders", function(){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::OrdersService()->insert($data)));
    });

    Flight::route("GET /orders/@id", function($id){
        Flight::json((Flight::OrdersService()->getById($id)));
    });

    //needs fix
    Flight::route("DELETE /orders/@id", function($id){
        Flight::json((Flight::OrdersService()->deleteById($id)));
    });

    // Flight::route("PUT /categories/@id", function($id){
    //     $data = Flight::request()->data->getData();
    //     Flight::json((Flight::CategoryService()->update($id, $data)));
    // });

    Flight::route("GET /orders/status/@status", function($status){
        $user_id = Flight::request()->query["user_id"];
        Flight::json((Flight::OrdersService()->getByStatus($user_id, $status)));
    });

    Flight::route("GET /orders/user/@user_id", function($user_id){
        Flight::json((Flight::OrdersService()->getByUserId($user_id)));
    });

?>