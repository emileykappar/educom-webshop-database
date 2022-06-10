<?php

// Set session variables for login and logout
session_start();

function doLoginUser($name) {
    $_SESSION["login"] = $name;
};

function isUserLoggedIn() {
    return isset($_SESSION["login"]);
};

function getLoggedInUserName() {
    return $_SESSION["login"];
};

function addToCart() {
    if(isset($_POST["add_to_cart"])) {

        if(isset($_SESSION["shopping_cart"])) {

            $session_array_id = array_column($_SESSION["shopping_cart"], "id");

            if (!in_array($_GET['id'], $session_array_id)) {
                $session_array = array(
                    "id" => $_GET["id"],
                    "name" => $_POST["name"],
                    "price" => $_POST["price"],
                    "quantity" => $_POST_["quantity"]
                );
                $_SESSION["shopping_cart"] = $session_array;
            }
                } else {
        
                $session_array = array(
                    "id" => $_GET["id"],
                    "name" => $_POST["name"],
                    "price" => $_POST["price"],
                    "quantity" => $_POST_["quantity"]
                );
                $_SESSION["shopping_cart"] = $session_array;
                }
    }
};

function doLogoutUser() {
    session_unset();
    session_destroy(); 
}
?>