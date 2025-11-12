<?php 
    
    /**
     * @OA\Get(
     *     path="/bookings",
     *     tags={"bookings"},
     *     summary="Get all bookings",
     *     description="Retrieve a list of all bookings from the database.",
     *     @OA\Response(
     *         response=200,
     *         description="Successfully retrieved all bookings",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=3),
     *                 @OA\Property(property="guest_number", type="integer", example=2),
     *                 @OA\Property(property="date", type="string", format="date-time", example="2025-11-07 18:00:00"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-11-01 15:30:00")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */

    Flight::route("GET /bookings", function(){
        Flight::json((Flight::BookingService()->getAll()));
    });

    // Flight::route("POST /bookings", function(){
    //     $data = Flight::request()->data->getData();
    //     Flight::json((Flight::BookingService()->insert($data)));
    // });

    /**
     * @OA\Get(
     *     path="/bookings/{id}",
     *     tags={"bookings"},
     *     summary="Get booking by ID",
     *     description="Retrieve a single booking from the database by its unique ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the booking to retrieve",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Booking details successfully retrieved",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="user_id", type="integer", example=3),
     *             @OA\Property(property="guest_number", type="integer", example=2),
     *             @OA\Property(property="date", type="string", format="date-time", example="2025-11-07 18:00:00"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-11-01 15:30:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Booking not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */

    Flight::route("GET /bookings/@id", function($id){
        Flight::json((Flight::BookingService()->getById($id)));
    });

    /**
     * @OA\Delete(
     *     path="/bookings/{id}",
     *     tags={"bookings"},
     *     summary="Delete a booking by ID",
     *     description="Deletes a single booking record from the database using its ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The unique ID of the booking to delete",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Booking deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Booking deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Booking not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    Flight::route("DELETE /bookings/@id", function($id){
        Flight::json((Flight::BookingService()->deleteById($id)));
    });

    /**
     * @OA\Put(
     *     path="/bookings/{id}",
     *     tags={"bookings"},
     *     summary="Update a booking by ID",
     *     description="Updates an existing booking record in the database using its ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The unique ID of the booking to update",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Booking fields to update",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="user_id", type="integer", example=3),
     *             @OA\Property(property="guest_number", type="integer", example=2),
     *             @OA\Property(property="date", type="string", format="date-time", example="2025-11-07 18:00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Booking updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Booking updated successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Booking not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */

    Flight::route("PUT /bookings/@id", function($id){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::BookingService()->update($id, $data)));
    });

    /**
     * @OA\Get(
     *     path="/bookings/date/{date}",
     *     tags={"bookings"},
     *     summary="Get bookings by date",
     *     description="Retrieve all bookings for a specific date.",
     *     @OA\Parameter(
     *         name="date",
     *         in="path",
     *         required=true,
     *         description="The date to filter bookings (format: YYYY-MM-DD)",
     *         @OA\Schema(type="string", example="2025-11-07")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of bookings for the specified date",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=3),
     *                 @OA\Property(property="guest_number", type="integer", example=2),
     *                 @OA\Property(property="date", type="string", format="date-time", example="2025-11-07 18:00:00"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-11-01 14:30:00")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No bookings found for the given date"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    //query string
    Flight::route("GET /bookings/date/@date", function($date){
        Flight::json((Flight::BookingService()->getBookingsByDate($date)));
    });

    /**
     * @OA\Post(
     *     path="/bookings",
     *     tags={"bookings"},
     *     summary="Create a new booking",
     *     description="Insert a new booking record into the database.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Booking data to create a new booking",
     *         @OA\JsonContent(
     *             type="object",
     *             required={"user_id","guest_number","date"},
     *             @OA\Property(property="user_id", type="integer", example=3),
     *             @OA\Property(property="guest_number", type="integer", example=2),
     *             @OA\Property(property="date", type="string", format="date-time", example="2025-11-07 18:00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Booking created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=10),
     *             @OA\Property(property="user_id", type="integer", example=3),
     *             @OA\Property(property="guest_number", type="integer", example=2),
     *             @OA\Property(property="date", type="string", format="date-time", example="2025-11-07 18:00:00"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-11-01 15:00:00")
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
    Flight::route("POST /bookings", function(){
        $data = Flight::request()->data->getData();
        Flight::json((Flight::BookingService()->bookTable($data)));
    });

    /**
     * @OA\Get(
     *     path="/bookings/reservations/upcoming",
     *     tags={"bookings"},
     *     summary="Get upcoming bookings",
     *     description="Retrieve all bookings with a date later than today.",
     *     @OA\Response(
     *         response=200,
     *         description="List of upcoming bookings",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=3),
     *                 @OA\Property(property="guest_number", type="integer", example=2),
     *                 @OA\Property(property="date", type="string", format="date-time", example="2025-11-07 18:00:00"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-11-01 15:00:00")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No upcoming bookings found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */

    Flight::route("GET /bookings/reservations/upcoming", function(){
        Flight::json((Flight::BookingService()->getUpcomingBookings()));
    });

?>
