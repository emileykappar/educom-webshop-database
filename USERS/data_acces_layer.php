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


function getWebshopProducts() {
    // create connection with database & retrieve products 
    $conn = connectToDatabase();
    $sql = "SELECT id, filename, name, price FROM products";
    $result = mysqli_query($conn, $sql);
    
    if(!$result) {
        throw new Exception("Webshop could not be retrieved, SQL: " . $sql . "error" . mysqli_error($conn));
    } else {
        $products = array();
        while($product = mysqli_fetch_assoc($result)) { // fetches a row from table as an associative array, while loops makes sure all rows will be looped through. 
            $id = $product["id"]; // $productID is the same as $products["id"] (retrieved from DB table)
            $products[$id] = $product; // $product is put back into this new variable as only the id was selected in sql!
        }
    return $products;
    }
};

function getProductDetails($id) {
    $conn = connectToDatabase();
    $sql = "SELECT * from products WHERE id=".$id;
    $result = mysqli_query($conn, $sql);

    if(!$result) {
        throw new Exception("Product details could not be retrieved, SQL: " . $sql . "error" . mysqli_error($conn));
    } else {
        $productDetails = mysqli_fetch_assoc($result);
        $id = $productDetails["id"];
        return $productDetails;
    }  
};

function retrieveCartContent(){
    if (empty($_SESSION["cart"])) {
        echo 'Je winkelwagen is nog leeg';
    } else {
    $total = 0;
    foreach($_SESSION["cart"] as $productNumbers => $quantities) { // $quantities is the quantity of the product, comes from the session.
        $conn = connectToDatabase();
        $sql= "SELECT * FROM products WHERE id=".$productNumbers; 
        $result = mysqli_query($conn, $sql);

        if(!$result) {
            echo 'Retrieving data for shoppingcart failed, SQL: ' . $sql . 'error' . mysqli_error($conn);
        } else {
            $products = mysqli_fetch_assoc($result);
            $subtotal_calculate = ($quantities * (int)$products["price"]); // int() converts the value to an integer, so the number can be shown correctly.
            $subtotal = number_format($subtotal_calculate, 2, '.', ',');
            $total += $subtotal; // $total is 0 + the subtotal.
        }
        echo '<div class="cartTable">
            <tr>';
                echo ' <td>'.$products["name"].' </td> '; // shows all product names that are in cart
                echo ' <td>€ '.$products["price"].' </td> '; // shows the price
                echo ' <td>'.$quantities.'</td> '; // shows the quantity
                echo ' <td>€ '.$subtotal.'</td> '; // shows the subtotal 
        echo '</tr></div>';
       
        } // the total price is outside the foreach loop because we only have one total. it is the last row in the table.
        echo '<tr><td colspan="4"><h3>Totaalprijs €'.$total.'</h3>
        </td></tr>
        ';
    }

};





    





?>
