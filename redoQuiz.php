<?php
session_start();
require_once "util.php";
require_once "pdo.php";

# Checks if user is logged in
if(!isset($_SESSION["firstName"]) && !isset($_SESSION["last_name"])){
    header("location: dietTable.php");
    return;
}

# Checks if diet_id is in the url
if (!isset($_GET["diet_id"])){
    $_SESSION["error"] = "Missing user id";
    header("Location: dietTable.php");
    return;
}

#Chechks if all fields are complete and numeric
if(isset($_POST["age"]) && isset($_POST["height"]) && isset($_POST["weight"]) && isset($_POST["gender"])){
    if(is_numeric($_POST["age"]) && is_numeric($_POST["height"]) && is_numeric($_POST["weight"])){
        #Generates the diet automtically, and if diets is not false, the database is updated
        $diets = chooseDiet(Mifflin_St_Jeor($_POST["age"], $_POST["height"], $_POST["weight"], $_POST["gender"]));
        if($diets!==false){
            $date["date"] = date('d-m-y h:i:s');
            $stmt = $pdo->prepare('UPDATE diets SET
            user_id=:uid, diet_id=:did, breakfast=:bf, lunch=:ln, supper=:sp, collation=:cl, dinner=:di, date=:dt, age=:ag, height=:he, weight=:we, gender=:ge WHERE user_id = :uid AND diet_id = :did');
            $stmt->execute(array(
            ':uid' => $_POST['user_id'],
            ':did' => $_POST['diet_id'],
            ':bf' => $diets["breakfast"],
            ':ln' => $diets["lunch"],
            ':sp' => $diets["supper"],
            ':cl' => $diets['collation'],
            ':di' => $diets['dinner'],
            ':dt' => $date,
            ':ag' => $_POST["age"],
            ':he' => $_POST["height"],
            ':we' => $_POST["weight"],
            ':ge' => $_POST["gender"]));
            header("location: dietTable.php");
            return;
        } else {
            $_SESSION["error"] = "A diet could not be calculated";
            header("location: createDiet.php");
            return;
        }
    } else {
        $_SESSION["error"] = "All data must be numeric";
        header("location: createDiet.php");
        return;
    }
}

$stmt = $pdo->prepare("SELECT * FROM diets WHERE diet_id = :did AND user_id = :uid");
$stmt->execute(array(":did" => $_GET["diet_id"], ":uid" => $_SESSION["user_id"]));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false){
    $_SESSION["error"] = "Bad value for profile id";
    header("Location: dietTable.php");
    return;
}
?>
<!doctype html lang="en">
<html>
    <head>
        <meta charset="UTF-8">
        <title>Diet Create</title>
        <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>">
        <?php head(); ?>
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
                        <li class="nav-item">
                            <a href="dietTable.php" class="nav-link">View Diets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Log Out</a>
                        </li>
                    </ul>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </nav>
        </header>
       <div class="quiz">
            <div class="errorMessage">
                <?php
                 flashMessage();
         
                 $age = htmlentities($row["age"]);
                 $height = htmlentities($row["height"]);
                 $weight = htmlentities($row["weight"]);
                 $gender = htmlentities($row["gender"]);
                 $user_id = $row["user_id"];
         
                ?>
            </div>
            <form method="POST">
                <div class="ageContainer">
                    <input type="text" name="age" value="<?=$age?>">
                    <label>Age</label>  
                </div>

                <div class="heightContainer">
                    <input type="text" name="height" value="<?=$height?>">
                    <label>Height</label>
                </div>

                <div class="weightContainer">
                    <input type="text" name="weight" value="<?=$weight?>">
                    <label>Weight</label>
                </div>

                <div class="genderContainer">
                    <select name="gender" value="<?=$gender?>">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <label>Gender</label>
                </div>
                <input type="hidden" value="<?=$user_id?>" name="user_id">
                <input type="hidden" value="<?=$_GET["diet_id"]?>" name="diet_id">

                <input type="submit" value="Submit">
            </form>
       </div>
        <script src="js/scriptDiet.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
    </body>