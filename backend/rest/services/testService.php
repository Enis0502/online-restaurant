<?php 
    require_once __DIR__. "/BookingService.php";
    require_once __DIR__. "/FoodService.php";
    require_once __DIR__. "/FoodOrdersService.php";

    $booking_service = new BookingService();
    $food_service = new FoodService();
    // $get_all = $booking_service->getAll();
    // print_r($get_all);

    // $delete_booking = $booking_service->deleteById(111); 
    // print_r($delete_booking)

    // $insert_booking = $booking_service->insert(["guest_number" => 2, "date" => "2025-11-07 18:00:00"]);
    // print_r($insert_booking);

    // $food_service = new FoodService();
    // $sort = $food_service->sortByPrice("desc");
    // // print_r($sort);

    // $food_orders_service = new FoodOrdersService();
    // $update_qty = $food_orders_service->updateQuantity(5, 1, -1);
    // print_r($update_qty);

    $test = $food_service->getFoodsByCategory("pizza");
    print_r($test);

?>