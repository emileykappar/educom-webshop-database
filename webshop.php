<?php
function showWebshop() {

    echo '<h2>Webshop</h2>
    <hr>
      
    <p> 
    Welkom op de webshop!<br>
    Je kunt hier terecht voor leuke honden speeltjes en accesoires.<br>
    Heb je een vraag? Stel deze dan via het contactformulier! :) <br>
    </p>';

    echo '<h3> Producten: </h3>
    <br><br> ';

    // create connection with database & retrieve products 
    $conn = connectToDatabase();
    $sql = "SELECT id, filename, name, price FROM products";
    $result = mysqli_query($conn, $sql);

    if(!$result) {
        throw new Exception("Webshop could not be retrieved, SQL: " . $sql . "error" . mysqli_error($conn));
    } else {
            while($products =  mysqli_fetch_assoc($result)) {
                if(isset($_SESSION["login"])) {
                    echo '
                    <form method="GET" action="index.php?id="'.$products["id"].'"> 
                    <div class="productContainer">
                    <div class="productList">

                    <input type="image" src="Images/'.$products["filename"].'" style="width:150px;height:150px;" > <br>
                    ' . $products["name"] . ' <br>
                    €' . $products["price"] . ' <br>

                    <input type="hidden" name="page" value="product_details">
                    <input type="hidden" name="id" value="'.$products["id"].'">
                    </form> 

                    <form method="POST" action="index.php">
                    <input type="hidden" name="id" value="'.$products["id"].'">
                    <input type="hidden" name="name" value="'.$products["name"].'">
                    <input type="hidden" name="page" value="webshop">
                    <input type="number" name="quantity" value="1" min="1" style="width:50px">
                    <input type="submit" name="add_to_cart "value="Add to cart" style="width:150px"/>
                    </div></div>
                    </form>';
                    addToCart();

                } else {
                    echo '
                    <form method="GET" action="index.php"> 
                    <div class="productContainer">
                    <div class="productList">

                    <input type="image" src="Images/'.$products["filename"].'" style="width:150px;height:150px;" > <br>
                    ' . $products["name"] . ' <br>
                    €' . $products["price"] . ' <br>

                    <input type="hidden" name="page" value="product_details">
                    <input type="hidden" name="id" value="'.$products["id"].'">
                    </div></div></form> ';
                }
            } 
        }
        return $products;

};





?>
