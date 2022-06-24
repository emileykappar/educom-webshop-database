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
          $user = array();
          $user = mysqli_fetch_assoc($result); // fetches a row from table as an associative array, $result is required!
          //var_dump($user);
          return $user;
        }
    }
    finally {
    mysqli_close($conn);
    }
};

// find email to see if email adress is already used to create an account (register form)
function doesEmailExist($email) {
    return !empty(findUserByEmail($email));
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

function retrieveCartContent() {
    if (empty($_SESSION["cart"])) {
        echo 'Je winkelwagen is nog leeg';
    } else {
    $total = 0;
    foreach($_SESSION["cart"] as $productID => $quantities) { // $quantities of the product, comes from the session.
        $conn = connectToDatabase();
        $sql= "SELECT * FROM products WHERE id=".$productID; 
        $result = mysqli_query($conn, $sql);
    
        if(!$result) {
            echo 'Retrieving data for shoppingcart failed, SQL: ' . $sql . 'error' . mysqli_error($conn);
        } else {
            $products = mysqli_fetch_assoc($result);
            $subtotal_calculate = ($quantities * (int)$products["price"]); // int() converts the value to an integer, so the number can be shown correctly.
            $subtotal = number_format($subtotal_calculate, 2, '.', ',');
            $total += $subtotal; // $total is 0 + the subtotal.
        }
        //////////////// dit stuk moet naar shoppingcart.php
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

function placeOrder($userID) {
    // send the order details to the database
    $date = date("y/m/d");
    $conn = connectToDatabase(); // $conn now holds the function that creates the connection with the DB
    $sql = "INSERT INTO orders (customerID, shipDate) VALUES ('$userID','$date')";
    $result = mysqli_query($conn, $sql);

    if (!$result){
        echo 'Error: Kan geen connectie maken met database. Order kan niet worden geplaatst ' . $sql . 'error' . mysqli_error($conn);
    } else {
        //connect ordered products+quantities with the order details
        $last_id = mysqli_insert_id($conn); // generates the last ID used in a connection. This will return the orderID, to connect to the orders_products table later. 
        foreach($_SESSION["cart"] as $productID => $quantities) { // for each product in the cart, insert the productID and quantity to the DB
            $sql = "INSERT INTO orders_product (ordersID, productID, quantity) VALUES ('$last_id', '$productID', '$quantities')";
            $result = mysqli_query($conn, $sql);
        }
        if (!$result) {
            echo 'Error: Order kan niet worden geplaatst. Probeer later nog eens. ' . $sql .'<br>' . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    
};





    





?>
