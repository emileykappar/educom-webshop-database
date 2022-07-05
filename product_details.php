<!-- script for shopping cart icon in button -->
<script src="https://kit.fontawesome.com/554142ec46.js" crossorigin="anonymous"></script>

<?php
function showProductDetails($data) {

    //echo ' <pre> ';
    //print_r($data);
    //echo ' </pre> ';

    echo '<h2>Product details</h2>
    <hr>';

    $product = $data["productDetails"];

    echo '
        <div class="products">  <img src="Images/' .$product["filename"] .'" width="200">
        <h4>' . $product["name"] . '<br> &euro;' . $product["price"] . ' <br></h4> ' . $product["description"] . '</div> ';

    if(isUserLoggedIn()) {
    echo '
        <form method="POST" action="index.php">
            <input type="hidden" name="page" value="webshop">
            <input type="text" name="quantity" value="1" min="1" max"100" style="width:30px"><br>
            <button type="submit" style="width:150px"><i class="fa-solid fa-cart-plus"></i> Toevoegen</button>
        </form>
        </div>'; 
    }    
};

?>
