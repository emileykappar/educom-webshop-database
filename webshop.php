<?php
function showWebshopContent() {

    echo '<h2>Webshop</h2>
        <hr>
      
    <p> <!-- Small welcoming text -->
        Welkom op de webshop!<br>
        Je kunt hier terecht voor leuke honden speeltjes en accesoires.<br>
        Heb je een vraag? Stel deze dan via het contactformulier! :) <br>
      </p> ' ;

    // retrieve products from DB
    echo '<b>Informatie producten</b>: <br><br> ';
    $products = showProducts();

    
};


?>
