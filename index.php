
<?php

//////////////////// This is the main application webshop DATABASE //////////////////////

// start session in session manager
require_once("session_manager.php");

// include database
include_once 'USERS/data_acces_layer.php';

// variable $page is defined to bring user to the right webpage with GET or POST request
$page = getRequestedPage();
$data = processRequest($page);
showResponsePage($data);


// functions are defined:
function getRequestedPage() { // Retrieves requested page with POST(getPostVar) or GET(getUrlVar) method 
    $requested_type = $_SERVER["REQUEST_METHOD"];
        if ($requested_type == "POST"){
            $requested_page = getPostVar("page", "home");
        } else { // So if REQUEST_METHOD = "GET"
            $requested_page = getUrlVar("page", "home");
        } return $requested_page;
};

function processRequest($page) {
    switch($page) {
        case "contact":
            require_once("contact.php");
            $data = validateContact();
            if ($data['valid']) {
                $page = "thanks";
            }
        break;
            
        case "register":
            require_once("register.php");
            require_once("user_service.php");
            $data = validateRegister();
            if ($data['valid']) {
                storeUser($data['name'], $data['email'], $data['password']);
                $page = "login";
            }
        break;
		
		case "login":
			require_once("login.php");
			$data = validateLogin();
			if ($data['valid']) {
                doLoginUser($data['name']);
				$page = "home";
            } 
		break;
        
        case "logout":
            require_once("home.php");
            require_once("user_service.php");
            
            doLogoutUser();
            $page = "home";

        break;

        case "webshop":
            require_once("webshop.php");

        break;

        case "product details":
            require_once("product_details.php");

        break;

        case "shoppingcart":
            require_once("shoppingcart.php");
            

            
    }
    // put $page into $data array
    $data['page'] = $page;
    $data['menu'] = array("home" => " Home ", "about" => " About ", "contact" => " Contact ", "webshop" => " Webshop ");
    if (isUserLoggedIn()) {
        $data['menu']['logout'] = " Log uit - " . getLoggedInUserName() . " ";
        $data['menu']['shoppingcart'] = " Winkelwagen ";
    } else {
        $data['menu']['register'] = " Registreren ";
        $data['menu']['login'] = " Log in ";
    }
    return $data;
};

// Show the requested page 
function showResponsePage($data) {
    beginDocument(); // no $page included as it stays the same on every page!
    showHeadSection();
    ShowBodySection($data); // $page included, to show the body section of the right page.
    endDocument();
};

// If variables are set in $array and $key, return these variables otherwise return the default variable $default. 

function getArrayVar($array, $key, $default="") {
    return isset($array[$key]) ? $array[$key] : $default; // If variables are set in $array and $key, return these variables otherwise return the default variable $default. 
};

// 

function getPostVar($key, $default="") {
    return getArrayVar($_POST, $key, $default);
};

// 

function getUrlVar($key, $default="") {
    return getArrayVar($_GET, $key, $default);
};

// This function starts the document:

function beginDocument() {
    echo "<!DOCTYPE html> 
            <html>";
};

// This function shows the head section of the document

function showHeadSection() {
    echo '<head> 
    <title> Emiley\'s website </title>
    <link rel="stylesheet" href="CSS\stylesheet.css">
    </head>';
};

// This function shows the body of the webpage

function showBodySection($data) {
    echo '<body> <div id="pageContainer">' . PHP_EOL; // PHP_EOL; The correct 'End Of Line' symbol for this platform. 
    showHeader($data['page']);
    showMenu($data);
    showContent($data); 
    showFooter();
    echo '</div></body>' . PHP_EOL;
};

// This fucntion shows the end of the webpage. 
function endDocument() {
    echo "</html>";
};

// This function shows the header info
// Needs the $page variable included as it is different for each webpage

function showHeader($page) {
    echo ' <h1> Welkom op mijn website! <br></h1>';     
};


// This function shows the navigation menu:
function showMenu($data) {
    echo '<ul class="navBar">' . PHP_EOL;
    foreach($data['menu'] as $link => $label) {
       showMenuItem($link, $label);
    }
    echo '</ul>';
};

// This function shows the menu items
function showMenuItem($link, $label) {
    echo '<li> ';
    echo '<a href="index.php?page=' . $link . '">' . $label . '</a>';
    echo '</li>';
};

// This function shows the content per page. 
function showContent($data){
    switch ($data['page']) {
        case "home" :
            require_once("home.php");
            showHomeContent();
            break;
        
        case "about" :
            require_once("about.php");
            showAboutContent();
            break;
            
        case "contact" :
            require_once("contact.php");
            showContactForm($data);
            break;
            
        case "thanks":
            require_once("contact.php");
            showContactThanks($data);
            break;
            
        case "register" :
            require_once("register.php");
            showRegisterForm($data);
            break;
            
        case "login" :
            require_once("login.php");
            showLoginForm($data);
            break;
            
        case "logout" :
            require_once("home.php");
            doLogoutUser();
            break;

        case "webshop" :
            require_once("webshop.php");
            showWebshop();

            break;
        
        case "product_details" :
            require_once("product_details.php");
            $id = getUrlVar('id');
            showProductDetails($id);
            break;

        case "shoppingcart" :
            require_once("shoppingcart.php");
            showCartContent();
            break;
            
        case "other" :
            require_once("other.php");
            showOtherContent();
            break;
    }
};

// create a function that will do all the checking of the data for us in the forms
function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
};
  
// This function shows the footer
function showFooter(){
    echo "
    <br><br>
    <br><br>
    
    <footer> <!-- Creates the footer -->
          <p> &copy; 2022, Emiley Kappar </p>
            </footer>";
};
function LogServer($message) {
    echo 'Log into server' . $message;
}

?>

