<?php
session_start();
require_once "util.php";
require_once "db/pdo.php";

validateLogin();
validateDiet();

if(isset($_POST["cancel"])){
    header("location: diet.php");
    return;
}

$stmt = $pdo->prepare("SELECT * FROM diets WHERE diet_id = :did");
$stmt->execute(array(":did" => $_GET["diet_id"]));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false){
    header("Location: index.php");
    return;
}

$breakfast = explode(";", $row["breakfast"]);
$lunch = explode(";", $row["lunch"]);
$supper = explode(";", $row["supper"]);
$collation = explode(";", $row["collation"]);
$dinner = explode(";", $row["dinner"]);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Diet</title>
        <?php head();?>
        <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>">
    </head>    
    <body>
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
                        <?php
                        if (isset($_SESSION["firstName"]) && isset($_SESSION["lastName"])) {
                            echo '<li class="nav-item"><a href="diet.php" class="nav-link">View Diets</a></li>';
                            echo '<li class="nav-item"><a href="logout.php" class="nav-link">Log Out</a></li>';
                        }
                        else {
                            echo '<li class="nav-item"><a href="login.php" class="nav-link">Log In</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="signin.php">Sign In</a>
                        </li>';
                        }
                        ?>
                    </ul>
                    <div class="hamburger">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </div>
                </nav>
            </header>
        <div class="containerView">
            <div class="row">
                <div class="column">
                    <h1>Breakfast</h1>
                    <?php 
                    for($i = 0; $i<count($breakfast); $i++){
                        echo "<p>".htmlentities($breakfast[$i])."</p>";
                    }
                    ?>
                </div>
                <div class="column">
                    <h1>Lunch</h1>  
                    <?php 
                    for($i = 0; $i<count($lunch); $i++){
                        echo "<p>".htmlentities($lunch[$i])."</p>";
                    }
                    ?>
                </div>
                <div class="column">
                    <h1>Supper</h1>
                    <?php 
                    for($i = 0; $i<count($supper); $i++){
                        echo "<p>".htmlentities($supper[$i])."</p>";
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <h1>Collation</h1>
                    <?php 
                    for($i = 0; $i<count($collation); $i++){
                        echo "<p>".htmlentities($collation[$i])."</p>";
                    }
                    ?>
                </div>
                <div class="column">
                    <h1>Dinner</h1>
                    <?php 
                    for($i = 0; $i<count($dinner); $i++){
                        echo "<p>".htmlentities($dinner[$i])."</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <form method="POST">
            <div class="returnButton">
                <input type="submit" value="Return to diet list" name="cancel">
            </div>
        </form>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="js/viewDiet.js"></script>
    </body>
</html>