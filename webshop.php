<?php
function showWebshopContent() {

    echo '<h2>Webshop</h2>
        <hr>
      
    <p> 
        Welkom op de webshop!<br>
        Je kunt hier terecht voor leuke honden speeltjes en accesoires.<br>
        Heb je een vraag? Stel deze dan via het contactformulier! :) <br>
      </p> ' ;

    echo '<h3>Informatie producten:</h3> <br><br> ';

    // retrieve products from DB
    showProducts();
};



?>
