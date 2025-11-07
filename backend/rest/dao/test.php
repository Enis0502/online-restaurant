<?php 
    require_once __DIR__ . '/UserDao.php';
    require_once __DIR__ . '/BookingDao.php';
    require_once __DIR__ . '/OrdersDao.php';
    require_once __DIR__ . '/FoodDao.php';
    require_once __DIR__ . '/CategoryDao.php';
    require_once __DIR__ . '/FoodOrdersDao.php';

    

    $user_dao = new UserDao();
    $booking_dao = new BookingDao();
    $order_dao = new OrdersDao();
    $food_dao = new FoodDao();
    $category_dao = new CategoryDao();
    $food_orders_dao = new FoodOrdersDao();


    $test = $booking_dao->getColumnNames();
    print_r($test);
    //some methods may not work if tested with same credentials because some fields are noted as unique.
    // $user_dao->insert([
    //     "name" => "Enis",
    //     "email" => "enis.bulbulusic@gmail.com",
    //     "password" => "pass111",
    //     "phone" => "040501231",
    //     "role" => "admin"
    // ]);

    // get all users
    //print_r($user_dao->getAll());

    //get users by id 
    //print_r($user_dao->getById(1));

    //get users by role
    //print_r($user_dao->getByRole("admin"));


    


    // $user = $user_dao->getAll();
    // print_r($user);
    //$user = $user_dao->getAll();
    //print_r($user);

    // $data = array("name" => "enis", "surname" => "Bulbulusic" );
    // $user2 = $user_dao->insert($data);
    // print_r($user2);

    //$data = array("name" => "Nedim", "email" => "nedim@gmail.com", "password" => "pass111", "phone" => "062222333", "role" => "user");
    //$user = $user_dao->insert($data);

    

    //$user2 = $user_dao->update(8,["role" => "customer"]);

    // $user = $user_dao->getByEmail("nedim@gmail.com");
    // print_r($user);

    // $user2 = $user_dao->getByRole("customer");
    // print_r($user2);

    //$insert = $user_dao->insert(array("name" => "Nedim", "email" => "nedim@gmail.com", "password" => "pass111", "phone" => "062222333", "role" => "user"));
    //$show = $user_dao->getAll();
    //print_r($insert);
    //print_r($show);    

    // $booking = $booking_dao->insert(array("guest_number" => 3, "date" => "2025-12-31 15:00:00", "user_id" => 2));
    // $show = $booking_dao->getAll();
    // print_r($show);

    // $show_bookings = $booking_dao->getBookingsByDate("2025-12-31 dadad");
    // print_r($show_bookings);

    //$insert_booking = $booking_dao->bookTable(array("guest_number" => 3, "date" => "2025-10-31 15:00:00", "user_id" => 12));
    //$show = $booking_dao->getUpcomingBookings();
    //print_r($show);

    //$current = date("Y-m-d");
    //$order = $order_dao->insert(array("order_date" => $current, "total_price" => 56, "status" => "pending", "user_id" => 2));

    // $foods = $food_dao->searchFoodsCategories("carbonara");
    // print_r($foods);

    // $get_category = $category_dao->searchFoodsCategories("pizza");
    // print_r($get_category);
    
    //$get_bookings = $booking_dao->getUpcomingBookings();
    //print_r($get_bookings);

    // $sort_foods = $food_dao->sortByPrice("asc");
    // print_r($sort_foods);

    // $get_foods = $food_orders_dao->getFoodsByOrder(1);
    // print_r($get_foods);

    // $delete_foods = $food_orders_dao->removeFromFoodOrder(1,1);
    // print_r($delete_foods);

    // $add_food_order = $food_orders_dao->insert(array("order_id" => 2, "food_id" => 6, "quantity" => 2));
    // print_r($add_food_order);

    // $update = $food_orders_dao->updateQuantity(5, 1, 10);
    // print_r($update);
    // $test = $food_orders_dao->getAll();
    // echo "<br>";
    // print_r($test);
?>