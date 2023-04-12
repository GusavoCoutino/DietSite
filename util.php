<?php

function head(){
    echo '<meta name="description" content="Diet making website to balance meals in the morning, afternoon, and night">';
    echo '<meta name="keywords" content="diet, healthy eating, balanced diet">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">';
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">';
    echo "<link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>";
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>';
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
        $diet = ["breakfast" => "Water: 250 ml;Apple: 1/2 piece;Prickly pear: 1/2 cup","lunch" =>"Eggs: 2 pieces;Egg yolk: 4 pieces;Tomato, onion, and pepper: Up to you;Toasts: 2 pieces","supper"=>"Grilled chicken breast: 150 grams;Rice: 1/2 cup,Salad: Free", "collation"=>"Almonds: 15 pieces", "dinner"=>"Tuna: 150 grams;Avocado: 1/2 piece"];
    } else if($msj>=2001 && $msj<=2500){
        $diet = ["breakfast" =>"Water: 500 ml;Apple: 1 piece;Prickly pear: 1 cup","lunch" =>"Eggs: 3 pieces;Egg yolk: 5 pieces;Tomato, onion, and pepper: Up to you;Toasts: 3 pieces","supper"=>"Grilled chicken breast: 200 grams;Rice: 1 cup;Salad: Free", "collation"=>"Almonds: 25 pieces", "dinner"=>"Tuna: 200 grams;Avocado: 1 piece"];
    }
    return $diet;
}
?>