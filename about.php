<?php

    
function showAboutContent(){     

    // Set session variables for login and logout
    $_SESSION["username"] = "";
    $_SESSION["password"] = "";
    $_SESSION["name"] = "";
    
echo '<h2>Over mij</h2>
      <hr>
     
   <p class="intro"> <!-- Small introduction text-->
      Mijn naam is Emiley, 23 jaar en ik woon in Dordrecht samen met mijn vriend en onze puppy. <br>
      Ik ben in oktober afgestudeerd met een bachelor in International Tourism. <br>
      Deze studie was erg leuk en ik heb veel mooie reizen mogen maken, maar ik miste wel uitdaging in dit vakgebied. <br>
      Daarom heb ik er voor gekozen om mij te verdiepen in Development! <br><br>


      Mijn hobbies zijn: <br>
     </p>

     <ul class="hobbies"> <!-- Unordered list -->
       <li>Wandelen met de hond</li>
       <li>Gamen</li>
       <li>Afspreken met vrienden</li>
       <li>Fitness in de sportschool</li>
     </ul> ';
};
?>