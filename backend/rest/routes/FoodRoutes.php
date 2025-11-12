<?php 
    /**
    * @OA\Get(
    *     path="/foods",
    *     tags={"foods"},
    *     summary="Get all foods",
    *     description="Retrieve a list of all foods in the database",
    *     @OA\Response(
    *         response=200,
    *         description="Array of foods",
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(
    *                 type="object",
    *                 @OA\Property(property="id", type="integer", example=1),
    *                 @OA\Property(property="name", type="string", example="Homemade Pasta"),
    *                 @OA\Property(property="description", type="string", example="Delicious pasta with cheese"),
    *                 @OA\Property(property="price", type="number", format="float", example=12.5),
    *                 @OA\Property(property="category", type="string", example="Pasta"),
    *                 @OA\Property(property="category_id", type="integer", example=2)
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Server error"
    *     )
    * )
    */
    Flight::route("GET /foods", function(){
        Flight::json((Flight::FoodService()->getAll()));
    });


    /**
    * @OA\Post(
    *     path="/foods",
    *     tags={"foods"},
    *     summary="Add a new food item",
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="name", type="string", example="Homemade Pasta"),
    *             @OA\Property(property="description", type="string", example="Delicious pasta with cheese"),
    *             @OA\Property(property="price", type="number", format="float", example=12.5),
    *             @OA\Property(property="category", type="string", example="Pasta"),
    *             @OA\Property(property="category_id", type="integer", example=2)
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Food item inserted successfully",
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
     Flight::route("POST /foods", function(){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::FoodService()->insert($data)));
    });


    /**
    * @OA\Get(
    *     path="/foods/{id}",
    *     tags={"foods"},
    *     summary="Get a food item by ID",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         description="ID of the food item",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Returns the food item",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="id", type="integer", example=1),
    *             @OA\Property(property="name", type="string", example="Homemade Pasta"),
    *             @OA\Property(property="description", type="string", example="Delicious pasta with cheese"),
    *             @OA\Property(property="price", type="number", format="float", example=12.5),
    *             @OA\Property(property="category", type="string", example="Pasta"),
    *             @OA\Property(property="category_id", type="integer", example=2)
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Food item not found"
    *     )
    * )
    */
    Flight::route("GET /foods/@id", function($id){
        Flight::json((Flight::FoodService()->getById($id)));
    });


    /**
    * @OA\Delete(
    *     path="/foods/{id}",
    *     tags={"foods"},
    *     summary="Delete a food item by ID",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         description="ID of the food item to delete",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Food item deleted successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="success", type="boolean", example=true)
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Food item not found"
    *     )
    * )
    */
    Flight::route("DELETE /foods/@id", function($id){
        Flight::json((Flight::FoodService()->deleteById($id)));
    });


    /**
    * @OA\Put(
    *     path="/foods/{id}",
    *     tags={"foods"},
    *     summary="Update a food item by ID",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         description="ID of the food item to update",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="name", type="string", example="Homemade Pasta"),
    *             @OA\Property(property="description", type="string", example="Delicious pasta with cheese"),
    *             @OA\Property(property="price", type="number", format="float", example=12.5),
    *             @OA\Property(property="category", type="string", example="Pasta"),
    *             @OA\Property(property="category_id", type="integer", example=2)
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Food item updated successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="success", type="boolean", example=true),
    *             @OA\Property(property="data", type="object")
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Food item not found"
    *     )
    * )
    */
    Flight::route("PUT /foods/@id", function($id){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::FoodService()->update($id, $data)));
    });

   /**
    * @OA\Get(
    *     path="/foods/order/{order}",
    *     tags={"foods"},
    *     summary="Sort foods by price",
    *     @OA\Parameter(
    *         name="order",
    *         in="path",
    *         required=true,
    *         description="Sort order: ASC or DESC",
    *         @OA\Schema(type="string", example="ASC")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Sorted list of foods",
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(
    *                 type="object",
    *                 @OA\Property(property="id", type="integer", example=1),
    *                 @OA\Property(property="name", type="string", example="Homemade Pasta"),
    *                 @OA\Property(property="price", type="number", format="float", example=12.5)
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=400,
    *         description="Invalid sort order"
    *     )
    * )
    */ 
    Flight::route("GET /foods/order/@order", function($order){
       Flight::json((Flight::FoodService()->sortByPrice($order)));
    });


    /**
    * @OA\Get(
    *     path="/foods/category/{category}",
    *     tags={"foods"},
    *     summary="Get all foods in a category",
    *     @OA\Parameter(
    *         name="category",
    *         in="path",
    *         required=true,
    *         description="Category name",
    *         @OA\Schema(type="string", example="Pasta")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="List of foods in the category",
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(
    *                 type="object",
    *                 @OA\Property(property="id", type="integer", example=1),
    *                 @OA\Property(property="name", type="string", example="Homemade Pasta"),
    *                 @OA\Property(property="price", type="number", format="float", example=12.5),
    *                 @OA\Property(property="category", type="string", example="Pasta")
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Category not found"
    *     )
    * )
    */
    Flight::route("GET /foods/category/@category", function($category){
       Flight::json((Flight::FoodService()->getFoodsByCategory($category)));
    });


?>