<?php

session_start();

if (!isset($_SESSION['CARRITO'])) {
   var_dump($_SESSION['CARRITO']); 
}else{
    header("location:user3.php");
}