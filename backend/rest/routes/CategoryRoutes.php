<?php 

    /**
    * @OA\Get(
    *     path="/categories",
    *     tags={"categories"},
    *     summary="Get all categories",
    *     description="Retrieve a list of all categories",
    *     @OA\Response(
    *         response=200,
    *         description="Array of categories",
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(
    *                 type="object",
    *                 @OA\Property(property="id", type="integer"),
    *                 @OA\Property(property="name", type="string")
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Server error"
    *     )
    * )
    */
    Flight::route("GET /categories", function(){
        Flight::json((Flight::CategoryService()->getAll()));
    });

    /**
     * @OA\Post(
     *     path="/categories",
     *     tags={"categories"},
     *     summary="Create a new category",
     *     description="Insert a new food category into the database.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Category data to create a new category",
     *         @OA\JsonContent(
     *             type="object",
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Pasta")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Category created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Pasta")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Missing or invalid fields in the request body"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    Flight::route("POST /categories", function(){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::CategoryService()->insert($data)));
    });

    /**
    * @OA\Get(
    *     path="/categories/{id}",
    *     tags={"categories"},
    *     summary="Get category by ID",
    *     description="Retrieve a single category from the database using its ID.",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         description="The unique ID of the category to retrieve",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Category details retrieved successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="id", type="integer", example=1),
    *             @OA\Property(property="name", type="string", example="Pasta")
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Category not found"
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Internal server error"
    *     )
    * )
    */

    Flight::route("GET /categories/@id", function($id){
        Flight::json((Flight::CategoryService()->getById($id)));
    });

    /**
    * @OA\Delete(
    *     path="/categories/{id}",
    *     tags={"categories"},
    *     summary="Delete a category by ID",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         description="ID of the category",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Category deleted successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="success", type="boolean", example=true),
    *             @OA\Property(property="message", type="string", example="Category deleted successfully")
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Category not found",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="success", type="boolean", example=false),
    *             @OA\Property(property="message", type="string", example="Id not found (1)")
    *         )
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Server error"
    *     )
    * )
    */

    Flight::route("DELETE /categories/@id", function($id){
        Flight::json((Flight::CategoryService()->deleteById($id)));
    });

    /**
    * @OA\Put(
    *     path="/categories/{id}",
    *     tags={"categories"},
    *     summary="Update a category by ID",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         description="ID of the category",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="name", type="string", example="Pasta Updated")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Category updated successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="success", type="boolean", example=true),
    *             @OA\Property(property="data", type="object",
    *                 @OA\Property(property="id", type="integer", example=1),
    *                 @OA\Property(property="name", type="string", example="Pasta Updated")
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Category not found"
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Server error"
    *     )
    * )
    */
    Flight::route("PUT /categories/@id", function($id){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::CategoryService()->update($id, $data)));
    });

?>