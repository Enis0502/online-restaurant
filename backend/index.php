<?php 
    
    //why does this path work but this one does not?  require "vendor/autoload.php";
    require __DIR__ . "/../vendor/autoload.php";
    Flight::route("/", function(){
        echo "Hello guuuuuyssss";

    });
    Flight::start();

?>