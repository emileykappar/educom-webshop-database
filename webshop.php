

<!-- script for shopping cart icon in button -->
<script src="https://kit.fontawesome.com/554142ec46.js" crossorigin="anonymous"></script>

<?php

function showWebshop($data) {
    echo '<h2>Webshop</h2>
    <hr>
      
    <p> 
        Welkom op de webshop!<br>
        Je kunt hier terecht voor leuke honden speeltjes en accesoires.<br>
        Heb je een vraag? Stel deze dan via het contactformulier! :) <br>
    </p>';

    echo '<h3> Producten: </h3>
          <br><br> ';

    echo '<div class="productContainer">';
    foreach($data["products"] as $product) { 

    //var_dump($data["product"]); 
    echo '<div class="productList">
            <form method="GET" action="index.php"> 
                <input type="image" src="Images/'.$product["filename"].'" style="width:150px;height:150px;" > <br> ' . $product["name"] . ' <br> &euro;' . $product["price"] . ' <br>
                <input type="hidden" name="page" value="product_details">
                <input type="hidden" name="id" value="'.$product["id"].'">
            </form>'; 

        if(isUserLoggedIn()) {
        echo '<form method="GET" action="index.php">
                    <input type="hidden" name="id" value="'.$product["id"].'">
                    <input type="hidden" name="name" value="'.$product["name"].'">
                    <input type="hidden" name="page" value="webshop">
                    <input type="hidden" name="action" value="add_to_cart">
                    <input type="text" name="quantity" value="1" min="1" max"100" style="width:30px">
                    <button type="submit" style="width:150px"><i class="fa-solid fa-cart-plus"></i> Toevoegen</button>

                    
                </form>';
        };
        echo '</div>';
            
    }    
    echo '</div>';   
    
};

function orderPlaced() {
    echo '<div class="orderPlaced"><span>';
    echo '<p>Je bestelling is geplaatst!</p>';
    echo '</div></span>';
};

?>
            








               
