<?php 

    //why does this path work but this one does not?  require "vendor/autoload.php";
    require __DIR__ . "/vendor/autoload.php";

    require __DIR__. "/middleware/AuthMiddleware.php";

    require __DIR__. "/rest/services/AuthService.php";
    require_once __DIR__. "/rest/routes/AuthRoutes.php";

    require __DIR__. "/rest/services/BookingService.php";
    require_once __DIR__. "/rest/routes/BookingRoutes.php";

    require __DIR__. "/rest/services/CategoryService.php";
    require_once __DIR__. "/rest/routes/CategoryRoutes.php";

    require __DIR__. "/rest/services/FoodService.php";
    require_once __DIR__. "/rest/routes/FoodRoutes.php";

    require __DIR__. "/rest/services/FoodOrdersService.php";
    require_once __DIR__. "/rest/routes/FoodOrdersRoutes.php";
    
    require __DIR__. "/rest/services/OrdersServices.php";
    require_once __DIR__. "/rest/routes/OrderRoutes.php";

    require __DIR__. "/rest/services/UserService.php";
    require_once __DIR__. "/rest/routes/UserRoutes.php";
    
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;       

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    Flight::register("BookingService", "BookingService");
    Flight::register("CategoryService", "CategoryService");
    Flight::register("FoodService", "FoodService");
    Flight::register("FoodOrdersService", "FoodOrdersService");
    Flight::register("OrdersService", "OrdersService");
    Flight::register("UserService", "UserService");

    Flight::register("auth", "AuthService");

    Flight::route("/*", function(){
        if(
            strpos(Flight::request()->url, "auth/login") === 0 ||
            strpos(Flight::request()->url, "auth/register") === 0 
        ){
            return true;
        }else{
            try{
                $token = Flight::request()->getHeader("Authentication");
                if(!$token){
                    Flight::halt(500, "Missing authentication header.");
                }

                $decoded_token = JWT::decode($token, new Key(Config::JWT_secret(), "HS256"));

                Flight::set("user", $decoded_token->user);
                Flight::set("jwt_token", $token);
                return true;
            }catch(\Exception $e){
                Flight::halt(401, $e->getMessage());
            }
        }
    });


    // Flight::route("/", function(){
    //     echo "Hello guuuuuyssss";

    // });


    Flight::start();

?>