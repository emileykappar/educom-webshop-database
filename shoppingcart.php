<?php
function showCartContent() {
    echo '<h2>Winkelwagen</h2>
    <hr>
    ';

    if (empty($_SESSION["cart"])) {
        echo 'Je winkelwagen is nog leeg';
    } else {
        echo '
        <div class="cartTable">
        <table>
            <tr>
                <th><h3>Producten<h3></th>
                <th><h3>Prijs<h3></th>
                <th><h3>Hoeveelheid<h3></th>
                <th><h3>Subtotaal<h3></th>
            </tr>
        </div>';
        retrieveCartContent();
        };

};




?>

