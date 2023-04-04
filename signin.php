<?php
session_start();
require_once "db/pdo.php"; require_once "util.php";

if(isset($_SESSION["firstName"]) && isset($_SESSION["lastName"])){
    header("Location: index.php");
    return;
}

if(isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["firstName"]) && isset($_POST["lastName"])){
    $check = hash("md5", $_POST["pass"]);
    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES(:fn, :ln, :em, :pd)");
    $stmt->execute(array(
        ":fn"=>$_POST["first_name"],
        "ln"=>$_POST["last_name"],
        ":em"=>$_POST["email"], 
        ":pd"=>$check));
    $_SESSION["firstName"] = $row["first_name"];
    $_SESSION["lastName"] = $row["last_name"];
    header("Location: index.php");
    return;
}
?>


<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <title>Sign In</title>
        <meta name="description" content="Diet making website to balance meals in the morning, afternoon, and night">
        <meta name="keywords" content="diet, healthy eating, balanced diet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        
    <head>
    <body style="background-color: aquamarine;">
        <header>
                <nav class="navbar">
                    <a href="index.php" class="nav-branding">Always Healthy</a>
                    <ul class="nav-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a href="login.php" class="nav-link">Log In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signin.php">Sign In</a>
                        </li>
                    </ul>
                    <div class="hamburger">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </div>
                </nav>
            </header>

            <div class="container">
                    <div class="signinForm">
                        <h1>Sign In Page</h1>
                        <form method="POST">
                            <?php
                            ?>
                            <div class="firstName">
                                <input name="firstName" type="text" id="firstName">
                                <label>First Name</label>
                            </div>
                            <div class="lastName">
                                <input name="lastName" type="text" id="lastName">
                                <label>Last Name</label>
                            </div>

                            <div class="emailCreate">
                                <input name="email" type="text" id="email">
                                <label>Email</label>
                            </div>

                            <div class="passCreate">
                                <input name="pass" type="password" id="pass">
                                <label>Password</label>
                            </div>
                            <div class="confirmPass">
                                <input type="password" id="passConfirm">
                                <label>Confirm Password</label>
                            </div>
                            <input type="submit" value="Submit" onclick="return validateSignin();">

                            <div class="loginLink">
                                Already have an account?<a href="login.html"> Log in</a>
                            </div>
                        </form>                
                    </div>
            </div>
        <script src="js/script2.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
    </body>
</html>
