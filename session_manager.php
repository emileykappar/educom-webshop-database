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

function getCart() {
    if (!(isset($_SESSION["cart"]))) {
    $_SESSION["cart"] = array(); // if the cart session doesn't exist; it is created.
    }
};

function clearCart() { // empty shopping cart
    if(isset($_GET["empty"])) {
        $_SESSION["cart"] = array(); // if "empty" is clicked on, the session cart becomes an empty array.
    }
};

function doLogoutUser() {
    session_unset();
    session_destroy(); 
}
?>