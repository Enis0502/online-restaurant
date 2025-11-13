<?php 

    /**
    * @OA\Get(
    *     path="/orders",
    *     tags={"orders"},
    *     summary="Get all orders",
    *     description="Retrieve a list of all orders in the database",
    *     @OA\Response(
    *         response=200,
    *         description="Array of orders",
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(
    *                 type="object",
    *                 @OA\Property(property="id", type="integer", example=1),
    *                 @OA\Property(property="user_id", type="integer", example=1),
    *                 @OA\Property(property="status", type="string", example="pending"),
    *                 @OA\Property(property="total_price", type="number", format="float", example=25.50),
    *                 @OA\Property(property="created_at", type="string", format="date-time")
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Server error"
    *     )
    * )
    */
    Flight::route("GET /orders", function(){
        Flight::json((Flight::OrdersService()->getAll()));
    });


    /**
    * @OA\Post(
    *     path="/orders",
    *     tags={"orders"},
    *     summary="Add a new order",
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="user_id", type="integer", example=1),
    *             @OA\Property(property="status", type="string", example="pending"),
    *             @OA\Property(property="total_price", type="number", format="float", example=25.50)
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Order inserted successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="success", type="boolean", example=true),
    *             @OA\Property(property="data", type="object")
    *         )
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Server error"
    *     )
    * )
    */
    Flight::route("POST /orders", function(){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::OrdersService()->insert($data)));
    });


    /**
    * @OA\Get(
    *     path="/orders/{id}",
    *     tags={"orders"},
    *     summary="Get an order by ID",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         description="ID of the order",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Returns the order",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="id", type="integer", example=1),
    *             @OA\Property(property="user_id", type="integer", example=1),
    *             @OA\Property(property="status", type="string", example="pending"),
    *             @OA\Property(property="total_price", type="number", format="float", example=25.50),
    *             @OA\Property(property="created_at", type="string", format="date-time")
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Order not found"
    *     )
    * )
    */
    Flight::route("GET /orders/@id", function($id){
        Flight::json((Flight::OrdersService()->getById($id)));
    });

    //needs fix
    /**
    * @OA\Delete(
    *     path="/orders/del/{id}",
    *     tags={"orders"},
    *     summary="Delete an order by ID",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         description="ID of the order to delete",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Order deleted successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="success", type="boolean", example=true)
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Order not found"
    *     )
    * )
    */
    Flight::route("DELETE /orders/del/@id", function($id){
        Flight::json((Flight::OrdersService()->deleteById($id)));
    });

    // Flight::route("PUT /categories/@id", function($id){
    //     $data = Flight::request()->data->getData();
    //     Flight::json((Flight::CategoryService()->update($id, $data)));
    // });


    /**
    * @OA\Get(
    *     path="/orders/status/{status}",
    *     tags={"orders"},
    *     summary="Get orders by status for a specific user",
    *     @OA\Parameter(
    *         name="status",
    *         in="path",
    *         required=true,
    *         description="Status of the order (e.g., pending, completed)",
    *         @OA\Schema(type="string", example="pending")
    *     ),
    *     @OA\Parameter(
    *         name="user_id",
    *         in="query",
    *         required=true,
    *         description="User ID to filter orders",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Orders filtered by status for the given user",
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(
    *                 type="object",
    *                 @OA\Property(property="id", type="integer", example=1),
    *                 @OA\Property(property="user_id", type="integer", example=1),
    *                 @OA\Property(property="status", type="string", example="pending"),
    *                 @OA\Property(property="total_price", type="number", format="float", example=25.50),
    *                 @OA\Property(property="created_at", type="string", format="date-time")
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="No orders found"
    *     )
    * )
    */
    Flight::route("GET /orders/status/@status", function($status){
        $user_id = Flight::request()->query["user_id"];
        Flight::json((Flight::OrdersService()->getByStatus($user_id, $status)));
    });

    /**
    * @OA\Get(
    *     path="/orders/user/{user_id}",
    *     tags={"orders"},
    *     summary="Get all orders for a specific user",
    *     @OA\Parameter(
    *         name="user_id",
    *         in="path",
    *         required=true,
    *         description="User ID",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Orders for the given user",
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(
    *                 type="object",
    *                 @OA\Property(property="id", type="integer", example=1),
    *                 @OA\Property(property="user_id", type="integer", example=1),
    *                 @OA\Property(property="status", type="string", example="pending"),
    *                 @OA\Property(property="total_price", type="number", format="float", example=25.50),
    *                 @OA\Property(property="created_at", type="string", format="date-time")
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="No orders found for this user"
    *     )
    * )
    */
    Flight::route("GET /orders/user/@user_id", function($user_id){
        Flight::json((Flight::OrdersService()->getByUserId($user_id)));
    });

?>