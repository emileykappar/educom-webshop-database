<?php

    
function authenticateUser($email, $password) {
    require_once("login.php");
   
   $user = findUserByEmail($email); // variable $user now holds the function to check if the user's email exists in DB.
   // var_dump($user);
   if ($user == null) { // if $user is null (a variable with no value assigned to it) NULL is returned..
       return null;
   } 
   if ($user['password'] != $password) { //if.. 
       return null;
   } 
   return $user; // ..else return $user
};
   



?>