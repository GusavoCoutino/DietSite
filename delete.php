<?php
session_start();
require_once "db/pdo.php";
require_once "util.php";

validateLogin();
validateDiet();

if(isset($_POST["cancel"])){
    header("location: diet.php");
    return;
}

if(isset($_POST['delete']) && isset($_GET['diet_id'])){
    $sql = "DELETE FROM diets WHERE diet_id = :dit";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(":dit" => $_GET["diet_id"]));
    header("Location: diet.php");
    return;
}

if (!isset($_GET["diet_id"])){
    $_SESSION["error"] = "Missing user id";
    header("Location: diet.php");
    return;
}

$stmt = $pdo->prepare("SELECT * FROM diets WHERE diet_id = :dit");
$stmt->execute(array(":dit" => $_GET["diet_id"]));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false){
    $_SESSION["error"] = "Bad value for diet id";
    header("Location: diet.php");
    return;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Delete Diet</title>
        <?php head(); ?>
        <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>">
    </head>
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
                    <?php
                    if (isset($_SESSION["firstName"]) && isset($_SESSION["lastName"])) {
                        echo '<li class="nav-item"><a href="diet.php" class="nav-link">View Diets</a></li>';
                        echo '<li class="nav-item"><a href="logout.php" class="nav-link">Log Out</a></li>';
                    } else {
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
            <div class="container">
                <div class="deleteContainer">
                    <h1>Delete Diet</h1>
                    <?php echo "<p>Are you sure you want to delete the diet with ID ".htmlentities($_GET["diet_id"])."?</p>"?>
                    <form method="POST">
                        <div class="deleteButton">
                            <input type="submit" value="Delete" name="delete">
                        </div>
                        <div class="cancelButton">
                            <input type="submit" value="Cancel" name="cancel">
                        </div>
                    </form>
                </div>
            </div>
            <script src="js/delete.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
    </body>
</html>