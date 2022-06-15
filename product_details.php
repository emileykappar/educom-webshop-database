<?php
function showProductDetails($data) {
    echo '<h2>Product details</h2>
    <hr>';

    foreach($data["productDetails"] as $product) {
    echo '
        <div class="products">  <img src="Images/' .$product["filename"] .'" width="200">
        <h4>' . $product["name"] . '<br> €' . $product["price"] . ' <br></h4> ' . $product["description"] . '</div> ';

        if(isUserLoggedIn()) {
        echo '
            <form method="POST" action="index.php">
                <input type="hidden" name="page" value="webshop">
                <input type="text" name="quantity" value="1" min="1" max"100" style="width:50px">
                <input type="submit" value="Add to cart"/>
            </form>
            </div>';
        }
    } 
};


?>
