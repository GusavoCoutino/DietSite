<?php
session_start();
require_once "db/pdo.php"; require_once "util.php";
if(isset($_SESSION["firstName"]) && isset($_SESSION["lastName"])){
    header("Location: index.php");
    return;
}
if(isset($_POST["email"]) && isset($_POST["pass"])){
    $check = hash("md5", $_POST["pass"]);
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:em AND password=:pd");
    $stmt->execute(array(
        ":em"=>$_POST["email"], 
        ":pd"=>$check));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row["password"]===$check && $row["email"] === $_POST["email"]){
        $_SESSION["firstName"] = $row["first_name"];
        $_SESSION["lastName"] = $row["last_name"];
        header("Location: index.php");
        return;
    }
    else{
        $_SESSION["error"] = "Incorrect password";
        header("Location: login.php");
        return;
    }
}
?>


<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
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
                <a href="index.html" class="nav-branding">Always Healthy</a>
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
                    <div class="loginForm">
                        <h1>Login Page</h1>
                        <form method="POST">
                            <?php
                            flashMessage();
                            ?>
                            <div class="emailField">
                                <input id="email" type="text" name="email">
                                <label>Email</label>
                            </div>

                            <div class="passField">
                                <input id="pass" type="password" name="pass">
                                <label>Password</label>
                            </div>

                            <input type="submit" value="Submit" onclick="return validateLogin();">

                            <div class="signup_link">
                                Don't have an account?<a href="signin.html"> Sign up</a>
                            </div>

                        </form>
                    </div>
            </div>
        <script src="js/script3.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
    </body>
</html>
