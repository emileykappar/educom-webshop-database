<?php

// in this function the connection is created with the database

function connectToDatabase() {
    $servername = "localhost";
    $username = "WebShopUser";
    $password = "Emswebshopuser123!";
    $dbname = "emileys_webshop";


    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
    throw new Exception("Connection failed: " . mysqli_connect_error());
    }    
    return $conn;
};

    //mysqli_close($conn);


// find user by email

function findUserByEmail($email) {
    
    // set variables 
    $conn = connectToDatabase(); // $conn now holds the function that creates the connection with the DB
    $sql = "SELECT * FROM users WHERE email = '".$email."' "; // selects the right email from DB
try {// function is triggered in a "try" block: so if the email is found and there is no exception the normal code is executed

    // mysqli_query runs the query (request of info) and puts the resulting data into a variable called $result.
    $result = mysqli_query($conn, $sql);
    
    if(!$result) {
        throw new Exception("Find user query failed, SQL: " . $sql . "error" . mysqli_error($conn));
    } else { 
        $user = mysqli_fetch_assoc($result); // fetches a row from table as an associative array, $result is required!
        // var_dump($user);
        return $user;
    }
} finally {
        mysqli_close($conn);
    }
};
?>
