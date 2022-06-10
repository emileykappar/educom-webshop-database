<?php

// connection is created with the database
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


// find user by email to see if user exitst (login form)
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
    }
    finally {
    mysqli_close($conn);
    }
};

// find email to see if email adress is already used to create an account (register form)
function doesEmailExist($email) {

    // set variables 
    $conn = connectToDatabase(); // $conn now holds the function that creates the connection with the DB
    $sql = "SELECT * FROM users WHERE email = '".$email."' "; // selects (looks for) the email that user put in
    
    try { // code if there is NO exception
        $result = mysqli_query($conn, $sql); // mysqli_query runs the query (request of info) and puts the resulting data into a variable called $result.
    
        if(!$result) {
            throw new Exception("Data could not be retrieved, SQL: " . $sql . "error" . mysqli_error($conn)); // no result will show error message in CATCH
        } else { // if there is a result; the result is returned.
            $user = mysqli_fetch_assoc($result); // fetches a row from table as an associative array, $result is required!
            //var_dump($user);
            return $user;
        }
    }
    finally {
        mysqli_close($conn);
        }
};

function storeUser($name, $email, $password) {
 
    // set variables 
    $conn = connectToDatabase(); // $conn now holds the function that creates the connection with the DB
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password') "; // insert new user into DB
          
    $result = mysqli_query($conn, $sql);
        if(!$result) {
            echo 'Store new user query failed, SQL: ' . $sql . 'error' . mysqli_error($conn);
        }
        mysqli_close($conn);
       
};
 
// GET URL var van ID variabele 

function getProductDetails($id) {
    $conn = connectToDatabase();
    $sql = "SELECT * from products WHERE id=".$id;
    $result = mysqli_query($conn, $sql);

    try {
        if(!$result) {
            throw new Exception("Product details could not be retrieved, SQL: " . $sql . "error" . mysqli_error($conn));
        } else{
            $productDetails = mysqli_fetch_assoc($result);
                if(isset($_SESSION["login"])) {
                    echo '
                    <div class="products">  <img src="Images/' .  $productDetails["filename"] .'" width="200">
                    <h4>' . $productDetails["name"] . ' <br>
                    €' . $productDetails["price"] . ' <br></h4>
                    ' . $productDetails["description"] . ' <br><br></div> 
                
                    <form method="POST" action="index.php">
                    <input type="submit" value="Add to cart"/>
                    <input type="hidden" name="page" value="webshop">
                    </div></div>
                    </form>';
                } else {
                    echo '
                    <div class="products">  <img src="Images/' .  $productDetails["filename"] .'" width="200">
                    <h4>' . $productDetails["name"] . ' <br>
                    €' . $productDetails["price"] . ' <br></h4>
                    ' . $productDetails["description"] . '</div> ';
                }
        }
        return $productDetails;
    }
    finally {
    mysqli_close($conn);
    }
};





    





?>
