<?php 

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::group('/auth', function(){
    /**
    * @OA\Post(
    *     path="/auth/register",
    *     summary="Register new user.",
    *     description="Add a new user to the database.",
    *     tags={"auth"},
    *     security={
    *         {"ApiKey": {}}
    *     },
    *     @OA\RequestBody(
    *         description="Add new user",
    *         required=true,
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 required={"password", "email"},
    *                 @OA\Property(
    *                     property="password",
    *                     type="string",
    *                     example="some_password",
    *                     description="User password"
    *                 ),
    *                 @OA\Property(
    *                     property="email",
    *                     type="string",
    *                     example="demo@gmail.com",
    *                     description="User email"
    *                 ),
    *                 @OA\Property(
    *                     property="name",
    *                     type="string",
    *                     example="enis",
    *                     description="User name"
    *                 ),
    *                 @OA\Property(
    *                     property="phone",
    *                     type="string",
    *                     example="0644260553",
    *                     description="User phone number"
    *                 ),
    *                 @OA\Property(
    *                     property="role",
    *                     type="string",
    *                     example="admin",
    *                     description="User role"
    *                 )
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="User has been added."
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Internal server error."
    *     )
    * )
    */

     Flight::route("POST /register", function(){
        $data = Flight::request()->data->getData();
        $response = Flight::auth()->register($data);

        // Check if response is valid array and has success key
        if(!empty($response["success"]) && $response["success"]){
            Flight::json([
                "message" => "User registered successfully",
                "data" => $response["data"] ?? null
            ]);
        }else{
            // Safely get error message
            $errorMsg = $response["error"] ?? $response["message"] ?? "Unknown error during registration";
            Flight::halt(500, $errorMsg);
        }
    });

    /**
    * @OA\Post(
    *      path="/auth/login",
    *      tags={"auth"},
    *      summary="Login to system using email and password",
    *      @OA\Response(
    *           response=200,
    *           description="Student data and JWT"
    *      ),
    *      @OA\RequestBody(
    *          description="Credentials",
    *          @OA\JsonContent(
    *              required={"email","password"},
    *              @OA\Property(property="email", type="string", example="demo@gmail.com", description="Student email address"),
    *              @OA\Property(property="password", type="string", example="some_password", description="Student password")
    *          )
    *      )
    * )
    */

    Flight::route("POST /login", function(){
        Flight::json([
        "success" => true,
        "data" => "NO DB"
        ]);
        $data = Flight::request()->data->getData();
        $response = Flight::auth()->login($data);

        error_log("LOGIN RESPONSE: " . print_r($response, true));


        // Check if response is valid array and has success key
        if(!empty($response["success"]) && $response["success"]){
            Flight::json([
                "message" => "User logged in successfully",
                "data" => $response["data"] ?? null
            ]);
        }else{
            // Safely get error message
            $errorMsg = $response["error"] ?? $response["message"] ?? "Unknown error during login";
            Flight::halt(500, $errorMsg);
        }
    });
})

?>