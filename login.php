<?php

function validateLogin() {
    
    // Create the variables that will be used
    $email = $password = ""; // Empty variables as they will be declared/filled in by the user that registers on the website 
    $emailError = $passwordError = ""; // Empty variables as they will be declared later in the function
    $username = $userPassword = $name = "";
    $valid = false;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        
        // testing the input
        $email = testInput(getPostVar("email")); 
        $password = testInput(getPostVar("password"));
        
        if (empty($email)) {
            $emailError="Gebruikersnaam verplicht";
        } 
        if (empty($password)) {
            $passwordError="Wachtwoord verplicht";
        }
        // This if/else statement checks if all the errors are empty and shows if the form is valid or not.
        if (empty($emailError) && empty($passwordError)) {
            try {
                require_once("user_service.php");
                $user = authenticateUser($email, $password);
                
                //var_dump($user);
                if (empty($user)) {                
                    $emailError = "Gebruiker niet bekend of wachtwoord incorrect";
                } else {
                    $name = $user['name'];
                    $valid = true;
                }
            } catch (Exception $e) { // if there is an exception, this catch echo's the Exception message. 
                LogServer('autenticatie failed : '. $e->getMessage());
                $emailError = "Er is een technisch probleem, probeer later nog eens";
              }   
        }
    }
   
    return array("email" => $email, "emailError" => $emailError, "password" => $password, 
                 "passwordError" => $passwordError,"name" => $name, "valid" => $valid);

};
	
function showLoginForm($data) { 
echo '
<!-- The login form is created: -->

    <h2>Log in met je account</h2>
  <hr>
  
<form method="POST" action="index.php">
<p><span class="error">* Verplicht </span></p>

<label for="email">Gebruikersnaam:</label>
    <input type="text" name="email" value="' . $data['email'] . '" title= "Gebruik je email als gebruikersnaam">
  <span class="error">* ' . $data['emailError'] . ' </span>
  
  <br>
  
    <label for="password">Wachtwoord:</label>
    <input type="password" name="password" value="'. $data['password'] .'">
  <span class="error">* '. $data['passwordError'] .' </span>
  
  <br>
  <br>
  
    <button type="submit">Log in</button>
  <input type="hidden" id="page" name="page" value="login">';
  
  };
  
    
?>