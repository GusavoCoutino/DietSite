<?php
require_once "pdo.php";

# Outputs tags that go in the title tag of each file
# Has no return values or parameters
function head(){
    echo '<meta name="description" content="Diet making website to balance meals in the morning, afternoon, and night">';
    echo '<meta name="keywords" content="diet, healthy eating, balanced diet">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">';
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">';
    echo "<link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>";
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>';
    echo '<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>';
    echo '<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>';
}

# Flashes either an error message or success message
# Has no return values or parameters
function flashMessage() {
    if(isset($_SESSION["error"])){
        echo '<p style="color:red">'.$_SESSION["error"].'</p>';
        unset($_SESSION["error"]);
    }
    if(isset($_SESSION["success"])){
        echo '<p style="color:green">'.$_SESSION["success"].'</p>';
        unset($_SESSION["success"]);
    }
}

# Calculates the amount of calories a person should eat
# Parameters: age, height, weight, and gender
# Return value: returns a number symbolizing the amount of calories calulated
function Mifflin_St_Jeor($age, $height, $weight, $gender){
    if($gender == "male"){
        return (10*$weight)+(6.25*$height)-(5*$age)+5;
    } else if($gender == "female") {
        return (10*$weight)+(6.25*$height)-(5*$age)-161;
    } else {
        return false;
    }
}

# Generates a diet based on the Mifflin_St_Jeor function. The diets are chosen based on a range. If the amount of calories does not fit
# in any of the three ranges, a boolean value 'false' is returned
# Parameters: $cal, the amount of calories
# Return values: $diet, the generated diet or a false value
function chooseDiet($cal){
    if($cal == false){
        return false;
    }
    $diet = [];
    if($cal>=1000 && $cal <=1500){
        $diet = ["breakfast" => "Water: 250 ml;Apple: 1/2 piece;Prickly pear: 1/2 cup", "lunch" => "Eggs: 1 piece;Egg yolk: 4 pieces;Tomato, onion, and pepper: Up to you;Toasts: 1 piece","supper"=>"Grilled chicken breast: 100 grams;Rice: 1/2 cup;Salad: Free", "collation"=>"Almonds: 10 pieces", "dinner"=>"Tuna: 100 grams;Avocado: 1/2 piece"];
    } else if ($cal>=1501 && $cal<=2000){
        $diet = ["breakfast" => "Water: 250 ml;Apple: 1/2 piece;Prickly pear: 1/2 cup","lunch" =>"Eggs: 2 pieces;Egg yolk: 4 pieces;Tomato, onion, and pepper: Up to you;Toasts: 2 pieces","supper"=>"Grilled chicken breast: 150 grams;Rice: 1/2 cup;Salad: Free", "collation"=>"Almonds: 15 pieces", "dinner"=>"Tuna: 150 grams;Avocado: 1/2 piece"];
    } else if($cal>=2001 && $cal<=2500){
        $diet = ["breakfast" =>"Water: 500 ml;Apple: 1 piece;Prickly pear: 1 cup","lunch" =>"Eggs: 3 pieces;Egg yolk: 5 pieces;Tomato, onion, and pepper: Up to you;Toasts: 3 pieces","supper"=>"Grilled chicken breast: 200 grams;Rice: 1 cup;Salad: Free", "collation"=>"Almonds: 25 pieces", "dinner"=>"Tuna: 200 grams;Avocado: 1 piece"];
    } else {
        return false;
    }
    return $diet;
}

#Validates login by checking if the firstName and lastName sessions exist. If the variables do not exist the user is returned to the main page
#Has no return values or parameters
function validateLogin(){
    if(!isset($_SESSION["firstName"]) && !isset($_SESSION["lastName"])){
        header("location: index.php");
        return;
    }
}

#Validates actions regarding a diet by checking if the diet_id parameter is in the url. 
#Has no return values or parameters
function validateDiet(){
    if (!isset($_GET["diet_id"])){
        $_SESSION["error"] = "Missing user id";
        header("Location: dietTable.php");
        return;
    }
}

#Deconstructs the values of breakfast, lunch, supper, collation and dinner from a diet. Separates the values of food and quantity
#by using ':' and ';' as delimiters
#Parameters: $row, original information of the diet
#Return: $diets, the modified diet
function deconstructDiet($row){
    $delimiters = [":", ";"];

    $oldBreakfast = str_replace($delimiters, $delimiters[0], $row["breakfast"]);
    $breakfast = explode($delimiters[0], $oldBreakfast);
    array_unshift($breakfast, "Breakfast");

    $oldLunch = str_replace($delimiters, $delimiters[0], $row["lunch"]);
    $lunch = explode($delimiters[0], $oldLunch);
    array_unshift($lunch, "Lunch");
    
    $oldSupper = str_replace($delimiters, $delimiters[0], $row["supper"]);
    $supper = explode($delimiters[0], $oldSupper);
    array_unshift($supper, "Supper");

    $oldCollation = str_replace($delimiters, $delimiters[0], $row["collation"]);
    $collation = explode($delimiters[0], $oldCollation);
    array_unshift($collation, "Collation");

    $oldDinner = str_replace($delimiters, $delimiters[0], $row["dinner"]);
    $dinner = explode($delimiters[0], $oldDinner);
    array_unshift($dinner, "Dinner");

    $diets = [$breakfast, $lunch, $supper, $collation, $dinner];
    return $diets;
}

# Creates the components that will be displayed in the Modify Diet page
# Parameters: $row, original information of the diet
# No return value
function convertDietData($row){
    $diets = deconstructDiet($row);
    
    for($i = 0; $i<count($diets); $i++){
        echo "<h1>".$diets[$i][0]."</h1>";
        echo "<div class='".$diets[$i][0]."'>";
        echo "<div class='row'>";
        for($ii = 1; $ii<count($diets[$i]); $ii++){
            if($ii%2==0){
                echo "<input id='".$diets[$i][0].$ii."' type='text' name='".$diets[$i][0].$ii."'>";
                echo "<p>".htmlentities($diets[$i][$ii])."</p>";
            }
        }
        echo "</div class='row'>";
        echo "</div>";
    }
}

# Turns the modified diet into the same format as it was first inserted in the database
# Parameters: $diet, the modified diet
# Return value: $diet, the reconstructed diet
function rebuildDiet($diet){
    for($i = 0; $i<count($diet); $i++){
        if ($i % 2 == 0) {
            $diet[$i] = $diet[$i].": ";
        } else {
            if($i!==count($diet)-1){
                $diet[$i] = $diet[$i].";";
            }
        }
    }
    $breakfast = [];
    $lunch = [];
    $supper = [];
    $collation = [];
    $dinner = [];
    for($i = 0; $i<count($diet); $i++){
        if($i<6){
            $breakfast[$i] = $diet[$i];
        } else if($i>5 && $i<14){
            $lunch[$i-6] = $diet[$i];
        } else if($i>13 && $i<20){
            $supper[$i-14] = $diet[$i];
        } else if($i>19 && $i<22){
            $collation[$i-20] = $diet[$i];
        } else if($i>21){
            $dinner[$i-22] = $diet[$i];
        }
    }
    $breakfast = rtrim(implode($breakfast), ";");
    $lunch = rtrim(implode($lunch), ";");
    $supper = rtrim(implode($supper), ";");
    $collation = rtrim(implode($collation), ";");
    $dinner = implode($dinner);


    $diet = [$breakfast, $lunch, $supper, $collation, $dinner];
    return $diet;
}

# Finds the index where a word is an array
# Parameters: $target, string of the wanted word; $array, array of strings where the word is
# Return value: index of the wanted word
function findIndex($target, $array){
    $index = 0;
    for($i = 0; $i<count($array); $i++){
        if($array[$i] == $target){
            $index = $i;
        }
    }
    return $index;
}
?>

