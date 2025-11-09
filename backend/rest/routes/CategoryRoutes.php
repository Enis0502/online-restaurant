<?php 

    Flight::route("GET /categories", function(){
        Flight::json((Flight::CategoryService()->getAll()));
    });

    Flight::route("POST /categories", function(){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::CategoryService()->insert($data)));
    });

    Flight::route("GET /categories/@id", function($id){
        Flight::json((Flight::CategoryService()->getById($id)));
    });

    Flight::route("DELETE /categories/@id", function($id){
        Flight::json((Flight::CategoryService()->deleteById($id)));
    });

    Flight::route("PUT /categories/@id", function($id){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::CategoryService()->update($id, $data)));
    });

?>