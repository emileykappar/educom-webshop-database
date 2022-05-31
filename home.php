<?php 


    
// This function shows the HOME content.
function showHomeContent(){
    
    // Set session variables for login and logout
    $_SESSION["username"] = "";
    $_SESSION["password"] = "";
    $_SESSION["name"] = "";

  echo '<h2>Home pagina</h2>
        <hr>
      
    <p> <!-- Small welcoming text -->
        Dit is mijn eerste website!<br>
        Kijk gerust rond door op de menu knoppen bovenaan de pagina te klikken.<br>
        Je kunt vragen stellen via het contactformulier! :) <br>
      </p> ' ;
};


?>
