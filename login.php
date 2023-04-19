<?php
session_start();
require_once "pdo.php"; require_once "util.php";
require  __DIR__ . "/vendor/autoload.php";


if(isset($_SESSION["firstName"]) && isset($_SESSION["lastName"])){
    header("Location: index.php");
    return;
}

#Checks if both fields are complete, and if passwords match the user is set to logged in. Otherwise an error message is displayed
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
        $_SESSION["user_id"] = $row["user_id"];
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
        <?php head();?>
        <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>">
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
                        <a class="nav-link" href="store.php">Store</a>
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
                                Don't have an account?<a href="signin.php"> Sign up</a>
                            </div>

                        

                            

                        </form>
                    </div>
            </div>
        <script src="js/login.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
        
    </body>
</html>
