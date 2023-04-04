<?php
function flashMessage(){
    if(isset($_SESSION["error"])){
        echo '<p style="color:red">'.$_SESSION["error"].'</p>';
        unset($_SESSION["error"]);
    }
    if(isset($_SESSION["success"])){
        echo '<p style="color:green">'.$_SESSION["success"].'</p>';
        unset($_SESSION["success"]);
    }
}
?>