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

function doLogoutUser() {
    session_unset();
    session_destroy(); 
}
?>