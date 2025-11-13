<?php 

    /**
    * @OA\Get(
    *     path="/users",
    *     tags={"users"},
    *     summary="Get all users",
    *     description="Retrieve a list of all registered users in the system.",
    *     @OA\Response(
    *         response=200,
    *         description="List of users retrieved successfully",
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(
    *                 type="object",
    *                 @OA\Property(property="id", type="integer", example=1),
    *                 @OA\Property(property="name", type="string", example="John Doe"),
    *                 @OA\Property(property="email", type="string", example="john@example.com"),
    *                 @OA\Property(property="role", type="string", example="customer")
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Server error"
    *     )
    * )
    */
    Flight::route("GET /users", function(){
        Flight::json((Flight::UserService()->getAll()));
    });

    /**
    * @OA\Post(
    *     path="/users",
    *     tags={"users"},
    *     summary="Register a new user",
    *     description="Add a new user to the database.",
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             type="object",
    *             required={"name", "email", "password"},
    *             @OA\Property(property="name", type="string", example="John Doe"),
    *             @OA\Property(property="email", type="string", example="john@example.com"),
    *             @OA\Property(property="password", type="string", example="secret123"),
    *             @OA\Property(property="role", type="string", example="customer")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="User created successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="success", type="boolean", example=true),
    *             @OA\Property(property="data", type="object")
    *         )
    *     ),
    *     @OA\Response(
    *         response=400,
    *         description="Invalid input"
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Server error"
    *     )
    * )
    */

    Flight::route("POST /users", function(){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::UserService()->insert($data)));
    });

    /**
    * @OA\Get(
    *     path="/users/{id}",
    *     tags={"users"},
    *     summary="Get user by ID",
    *     description="Retrieve a specific user using their unique ID.",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         description="User ID",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="User retrieved successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="id", type="integer", example=1),
    *             @OA\Property(property="name", type="string", example="John Doe"),
    *             @OA\Property(property="email", type="string", example="john@example.com"),
    *             @OA\Property(property="role", type="string", example="customer")
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="User not found"
    *     )
    * )
    */
    Flight::route("GET /users/@id", function($id){
        Flight::json((Flight::UserService()->getById($id)));
    });


    /**
    * @OA\Delete(
    *     path="/users/{id}",
    *     tags={"users"},
    *     summary="Delete user by ID",
    *     description="Remove a user record from the system by their ID.",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         description="User ID",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="User deleted successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="success", type="boolean", example=true)
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="User not found"
    *     )
    * )
    */
    Flight::route("DELETE /users/@id", function($id){
        Flight::json((Flight::UserService()->deleteById($id)));
    });

    /**
    * @OA\Put(
    *     path="/users/{id}",
    *     tags={"users"},
    *     summary="Update user details",
    *     description="Update user information such as name, email, or role.",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         description="User ID",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="name", type="string", example="John Doe"),
    *             @OA\Property(property="email", type="string", example="john@example.com"),
    *             @OA\Property(property="role", type="string", example="admin")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="User updated successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="success", type="boolean", example=true),
    *             @OA\Property(property="data", type="object")
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="User not found"
    *     )
    * )
    */
    Flight::route("PUT /users/@id", function($id){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::UserService()->update($id, $data)));
    });
    
    /**
    * @OA\Get(
    *     path="/users/email/{email}",
    *     tags={"users"},
    *     summary="Get user by email",
    *     description="Retrieve user information using their email address.",
    *     @OA\Parameter(
    *         name="email",
    *         in="path",
    *         required=true,
    *         description="Email address of the user",
    *         @OA\Schema(type="string", example="john@example.com")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="User found successfully",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="id", type="integer", example=1),
    *             @OA\Property(property="name", type="string", example="John Doe"),
    *             @OA\Property(property="email", type="string", example="john@example.com"),
    *             @OA\Property(property="role", type="string", example="customer")
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="User not found"
    *     )
    * )
    */
    Flight::route("GET /users/email/@email", function($email){
        Flight::json((Flight::UserService()->getByEmail($email)));
    });
    
    /**
    * @OA\Get(
    *     path="/users/role/{role}",
    *     tags={"users"},
    *     summary="Get users by role",
    *     description="Retrieve all users with a specific role such as 'admin' or 'customer'.",
    *     @OA\Parameter(
    *         name="role",
    *         in="path",
    *         required=true,
    *         description="Role of the user",
    *         @OA\Schema(type="string", example="admin")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="List of users with the specified role",
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(
    *                 type="object",
    *                 @OA\Property(property="id", type="integer", example=1),
    *                 @OA\Property(property="name", type="string", example="John Doe"),
    *                 @OA\Property(property="email", type="string", example="john@example.com"),
    *                 @OA\Property(property="role", type="string", example="admin")
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="No users found for the given role"
    *     )
    * )
    */
    Flight::route("GET /users/role/@role", function($role){
        Flight::json((Flight::UserService()->getByRole($role)));
    });


?>