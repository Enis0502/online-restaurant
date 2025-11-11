<?php 

    Flight::route("GET /users", function(){
        Flight::json((Flight::UserService()->getAll()));
    });

    Flight::route("POST /users", function(){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::UserService()->insert($data)));
    });

    Flight::route("GET /users/@id", function($id){
        Flight::json((Flight::UserService()->getById($id)));
    });

    Flight::route("DELETE /users/@id", function($id){
        Flight::json((Flight::UserService()->deleteById($id)));
    });

    Flight::route("PUT /users/@id", function($id){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::UserService()->update($id, $data)));
    });
    
    Flight::route("GET /users/email/@email", function($email){
        Flight::json((Flight::UserService()->getByEmail($email)));
    });
    
    Flight::route("GET /users/role/@role", function($role){
        Flight::json((Flight::UserService()->getByRole($role)));
    });


?>