<?php 
    $connect = new mysqli("localhost", "root", "555666", "codetest2");
    if ($connect->connect_error){
        die("Database connection failed".$connect->connect_error);
    }
?>