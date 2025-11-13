<?php 

    /**
    * @OA\Get(
    *     path="/foodOrders",
    *     tags={"foodOrders"},
    *     summary="Get all food orders",
    *     description="Retrieve a list of all food orders in the database",
    *     @OA\Response(
    *         response=200,
    *         description="Array of food orders",
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(
    *                 type="object",
    *                 @OA\Property(property="order_id", type="integer"),
    *                 @OA\Property(property="food_id", type="integer"),
    *                 @OA\Property(property="quantity", type="integer")
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Server error"
    *     )
    * )
    */
    Flight::route("GET /foodOrders", function(){
        Flight::json((Flight::FoodOrdersService()->getAll()));
    });

    /**
    * @OA\Post(
    *     path="/foodOrders",
    *     tags={"foodOrders"},
    *     summary="Add a new food order",
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="order_id", type="integer", example=1),
    *             @OA\Property(property="food_id", type="integer", example=2),
    *             @OA\Property(property="quantity", type="integer", example=3)
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Food order inserted successfully",
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
    Flight::route("POST /foodOrders", function(){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::FoodOrdersService()->insert($data)));
    });

    /**
    * @OA\Get(
    *     path="/foodOrders/order/{order}",
    *     tags={"foodOrders"},
    *     summary="Get all foods for a specific order",
    *     @OA\Parameter(
    *         name="order",
    *         in="path",
    *         required=true,
    *         description="ID of the order",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="List of foods in the order",
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(
    *                 type="object",
    *                 @OA\Property(property="food_id", type="integer", example=2),
    *                 @OA\Property(property="quantity", type="integer", example=3)
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Order not found"
    *     )
    * )
    */
    Flight::route("GET /foodOrders/order/@order", function($order){
        Flight::json((Flight::FoodOrdersService()->getFoodsByOrder($order)));
    });
    
    
    /**
    * @OA\Delete(
    *     path="/foodOrders/food/{food}/order/{order}",
    *     tags={"foodOrders"},
    *     summary="Remove a food from a specific order",
    *     @OA\Parameter(
    *         name="food",
    *         in="path",
    *         required=true,
    *         description="ID of the food item",
    *         @OA\Schema(type="integer", example=2)
    *     ),
    *     @OA\Parameter(
    *         name="order",
    *         in="path",
    *         required=true,
    *         description="ID of the order",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Food removed from order successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="success", type="boolean", example=true)
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Food or order not found"
    *     )
    * )
    */
    Flight::route("DELETE /foodOrders/food/@food/order/@order", function($food, $order){
        Flight::json((Flight::FoodOrdersService()->removeFromFoodOrder($food, $order)));
    });


    /**
    * @OA\Put(
    *     path="/foodOrders/{order_id}/food/{food_id}",
    *     tags={"foodOrders"},
    *     summary="Update the quantity of a food item in an order",
    *     @OA\Parameter(
    *         name="order_id",
    *         in="path",
    *         required=true,
    *         description="ID of the order",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\Parameter(
    *         name="food_id",
    *         in="path",
    *         required=true,
    *         description="ID of the food item",
    *         @OA\Schema(type="integer", example=2)
    *     ),
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="quantity", type="integer", example=5)
    *         )
    *     ),
    * @OA\Response(
    *         response=200,
    *         description="Quantity updated successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="success", type="boolean", example=true)
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Food or order not found"
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Server error"
    *     )
    * )
    */
    Flight::route('PUT /foodOrders/@order_id/food/@food_id', function($order_id, $food_id) {
        $data = json_decode(Flight::request()->getBody(), true);
        $quantity = $data['quantity'];
        Flight::json(Flight::FoodOrdersService()->updateQuantity($food_id, $order_id, $quantity));
    });

?>