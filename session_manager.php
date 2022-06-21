<?php
// Set session variables for login and logout
session_start();

function doLoginUser($name, $userID) {
    $_SESSION["login"] = $name;
    $_SESSION["id"] = $userID; // puts the users' ID in the session
};

function isUserLoggedIn() {
    return isset($_SESSION["login"]);
};

function getLoggedInUserName() {
    return $_SESSION["login"];
};

function getCustomerID(){
    return $_SESSION["id"];
};

function getCart() {
    if (!(isset($_SESSION["cart"]))) {
        $_SESSION["cart"] = array(); // if the cart session doesn't exist; it is created.
    }
    return $_SESSION["cart"];
};

function addToCart($id, $quantity){

    if($quantity > 0 && filter_var($quantity, FILTER_VALIDATE_INT)) { // quantity needs to be more that 0 and filtered on characters
        // buy
        if(isset(getCart()[$id])){
            $_SESSION["cart"][$id] += $quantity; // if there is already a quantity in the cart, the new quantity is added
        } else {
            $_SESSION["cart"][$id] = $quantity; // else; quantity is added to empty cart
        } 
        print_r($_SESSION["cart"]); // print the cart to check what products were added
    } 
};

function clearCart() { // empty shopping cart
    $_SESSION["cart"] = array(); // if "empty" or "place order" is clicked on, the session cart becomes an empty array.
};

function doLogoutUser() {
    session_unset();
    session_destroy(); 
}

?>