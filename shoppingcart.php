
<?php
function showCartContent() {
    echo '<h2>Winkelwagen</h2>
    <hr>
    ';

    if (empty($_SESSION["cart"])) {
        echo 'Je winkelwagen is nog leeg';
    } else {
        echo '
        <table>
            <tr>
                <th><h3>Producten<h3></th>
                <th><h3>Prijs<h3></th>
                <th><h3>Hoeveelheid<h3></th>
                <th><h3>Subtotaal<h3></th>
            </tr>
        ';
        retrieveCartContent(); // in data layer 

        // create empty shopping cart button to display on webpage but ONLY when user is logged in
        echo '
        <form method="GET" action="index.php">  
            <input type="hidden" name="page" value="shoppingcart">
            <input type="hidden" name="action" value="clear_cart">
            <input class="emptyShoppingcart" type="submit" value="Winkelwagen leegmaken"> '; // hidden input redirects back to webshop page // if empty is clicked on clearCart(); is executed.
        echo '
        </form>';

        // create place order button
        echo '
        <form method="GET" action="index.php">  
            <input type="hidden" name="page" value="webshop">
            <input type="hidden" name="action" value="place_order">
            <input class="orderButton" type="submit" name="placeOrder" value="Bestelling plaatsen"> ';
        echo '
        </form>';
    }
};

?>

