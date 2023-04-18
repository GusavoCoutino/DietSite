<?php
require_once "db/pdo.php";
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

function Mifflin_St_Jeor($age, $height, $weight, $gender){
    if($gender == "male"){
        return (10*$weight)+(6.25*$height)-(5*$age)+5;
    } else if($gender == "female") {
        return (10*$weight)+(6.25*$height)-(5*$age)-161;
    } else {
        return false;
    }
}

function chooseDiet($msj){
    if($msj == false){
        return false;
    }
    $diet = [];
    if($msj>=1000 && $msj <=1500){
        $diet = ["breakfast" => "Water: 250 ml;Apple: 1/2 piece;Prickly pear: 1/2 cup", "lunch" => "Eggs: 1 piece;Egg yolk: 4 pieces;Tomato, onion, and pepper: Up to you;Toasts: 1 piece","supper"=>"Grilled chicken breast: 100 grams;Rice: 1/2 cup;Salad: Free", "collation"=>"Almonds: 10 pieces", "dinner"=>"Tuna: 100 grams;Avocado: 1/2 piece"];
    } else if ($msj>=1501 && $msj<=2000){
        $diet = ["breakfast" => "Water: 250 ml;Apple: 1/2 piece;Prickly pear: 1/2 cup","lunch" =>"Eggs: 2 pieces;Egg yolk: 4 pieces;Tomato, onion, and pepper: Up to you;Toasts: 2 pieces","supper"=>"Grilled chicken breast: 150 grams;Rice: 1/2 cup;Salad: Free", "collation"=>"Almonds: 15 pieces", "dinner"=>"Tuna: 150 grams;Avocado: 1/2 piece"];
    } else if($msj>=2001 && $msj<=2500){
        $diet = ["breakfast" =>"Water: 500 ml;Apple: 1 piece;Prickly pear: 1 cup","lunch" =>"Eggs: 3 pieces;Egg yolk: 5 pieces;Tomato, onion, and pepper: Up to you;Toasts: 3 pieces","supper"=>"Grilled chicken breast: 200 grams;Rice: 1 cup;Salad: Free", "collation"=>"Almonds: 25 pieces", "dinner"=>"Tuna: 200 grams;Avocado: 1 piece"];
    }
    return $diet;
}

function validateLogin(){
    if(!isset($_SESSION["firstName"]) && !isset($_SESSION["last_name"])){
        header("location: index.php");
        return;
    }
}

function validateDiet(){
    if (!isset($_GET["diet_id"])){
        $_SESSION["error"] = "Missing user id";
        header("Location: diet.php");
        return;
    }
}

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
    #$diet = implode($diet);
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

