<?php

// Create the variables that will be used
   $email = $password = ""; // Empty variables as they will be declared/filled in by the user that registers on the website 
   $emailError = $passwordError = ""; // Empty variables as they will be declared later in the function
   $username = $userPassword = $name = "";
   $valid = false;

function authenticateUser($email, $password) {
   
   $user = findUserByEmail($email); // variable $user now holds the function to find the user.
   
   if ($user == null) { // if $user is null (a variable with no value assigned to it) NULL is returned..
       return null;
   } 
   if ($user['password'] != $password) { //if.. 
       return null;
   } 
   return $user; // ..else return $user
};
   

////////////////////////////////////////////////// check if email exists in users.txt (FOR REGISTER FORM)
function doesEmailExist($email) {
   
    // opens the file to read or write data, read if user already exists and if not write the new useraccount data in the file.
    $myfile = fopen("USERS/users.txt", "a+"); 
    
    while(!feof($myfile)) { // as long as end of file has not been reached, 
                $string = fgets($myfile); // $string reads the user input per line
                $parts = explode("|", $string); // $parts breaks string into array with explode function: easy to find specific parts in the file.
                
                if ($email == $parts[0]) {
                    $emailError = "Email al in gebruik";
                }        
            } 
            fclose($myfile);
    
};

function storeUser($data) { 
    $myfile = fopen("USERS/users.txt", "a+");
    
    $userData = $data['email'] .'|'. $data['name'] .'|'. $data['password']; // $userData is received from user input and added to USERS/users.txt
    fwrite($myfile,  PHP_EOL . $userData);
    fclose($myfile);
};


?>