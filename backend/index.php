<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/middleware/AuthMiddleware.php";

require __DIR__ . "/rest/services/AuthService.php";
require_once __DIR__ . "/rest/routes/AuthRoutes.php";

require __DIR__ . "/rest/services/BookingService.php";
require_once __DIR__ . "/rest/routes/BookingRoutes.php";

require __DIR__ . "/rest/services/CategoryService.php";
require_once __DIR__ . "/rest/routes/CategoryRoutes.php";

require __DIR__ . "/rest/services/FoodService.php";
require_once __DIR__ . "/rest/routes/FoodRoutes.php";

require __DIR__ . "/rest/services/FoodOrdersService.php";
require_once __DIR__ . "/rest/routes/FoodOrdersRoutes.php";

require __DIR__ . "/rest/services/OrdersServices.php";
require_once __DIR__ . "/rest/routes/OrderRoutes.php";

require __DIR__ . "/rest/services/UserService.php";
require_once __DIR__ . "/rest/routes/UserRoutes.php";

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

header("Access-Control-Allow-Origin: https://coral-app-vmx7w.ondigitalocean.app");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, Authentication");
header("Access-Control-Allow-Credentials: true");

Flight::route('OPTIONS /*', function() {
    Flight::halt(200);
});

Flight::before('start', function(&$params, &$output){
    $url = Flight::request()->url;

    if (strpos($url, '/auth/login') !== false || strpos($url, '/auth/register') !== false) {
        return;
    }

    // Protected routes
    $authHeader = Flight::request()->getHeader('Authorization');
    if (!$authHeader) {
        Flight::halt(401, 'Missing Authorization header');
    }

    $token = str_replace('Bearer ', '', $authHeader);

    try {
        $decoded = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));
        Flight::set('user', $decoded->user);
    } catch (Exception $e) {
        Flight::halt(401, $e->getMessage());
    }
});

// --- Test route ---
Flight::route("GET /ping", function () {
    Flight::json([
        "status" => "OK",
        "message" => "Flight is alive"
    ]);
});

Flight::start();
?>
