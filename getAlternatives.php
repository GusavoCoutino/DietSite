<?php
session_start();
require_once "util.php";
require_once "pdo.php";

validateLogin();
validateDiet();

$stmt = $pdo->prepare("SELECT * FROM diets WHERE diet_id = :did AND user_id = :uid");
$stmt->execute(array(":did" => $_GET["diet_id"], ":uid" => $_SESSION["user_id"]));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false){
    $_SESSION["error"] = "Bad value for profile id";
    header("Location: dietTable.php");
    return;
}

#Checks if all fields are complete
if(isset($_POST["Breakfast2"]) && isset($_POST["Breakfast4"]) && isset($_POST["Breakfast6"]) && isset($_POST["Lunch2"]) && isset($_POST["Lunch4"]) && isset($_POST["Lunch6"]) && isset($_POST["Lunch8"]) && isset($_POST["Supper2"]) && isset($_POST["Supper4"]) && isset($_POST["Supper6"]) && isset($_POST["Collation2"]) && isset($_POST["Dinner2"]) && isset($_POST["Dinner4"])){
    #Creates an array of all the answers
    $answers = [$_POST["Breakfast2"], $_POST["Breakfast4"], $_POST["Breakfast6"], $_POST["Lunch2"], $_POST["Lunch4"], $_POST["Lunch6"], $_POST["Lunch8"], $_POST["Supper2"], $_POST["Supper4"], $_POST["Supper6"], $_POST["Collation2"], $_POST["Dinner2"], $_POST["Dinner4"]];
    $diet = [];
    #Deconstructs and combines the diet into a single array to be displayed in the page
    $valuesManyArrays = deconstructDiet($row);
    $valuesOneArray = array_merge($valuesManyArrays[0], $valuesManyArrays[1], $valuesManyArrays[2], $valuesManyArrays[3], $valuesManyArrays[4]);
    #Erases data that is not actual information about the diet from the array
    array_splice($valuesOneArray, findIndex("Breakfast", $valuesOneArray), 1);
    array_splice($valuesOneArray, findIndex("Lunch", $valuesOneArray), 1);
    array_splice($valuesOneArray, findIndex("Supper", $valuesOneArray), 1);
    array_splice($valuesOneArray, findIndex("Collation", $valuesOneArray), 1);
    array_splice($valuesOneArray, findIndex("Dinner", $valuesOneArray), 1);

    #Adds to the new food alternatives the quantity that must be eaten
    $answersCounter = 0;
    for($i = 0; $i < count($valuesOneArray); $i++){
        if ($i % 2 == 0) {
            $diet[$i] = $answers[$answersCounter];
            $answersCounter = $answersCounter+1;
        } else {
            $diet[$i] = $valuesOneArray[$i];
        }
    }
    
    #Diet is rebuilt and updated into the database
    $newDiet = rebuildDiet($diet);
    $date = date('d-m-y h:i:s');
    $stmt = $pdo->prepare('UPDATE Diets SET
    user_id=:uid, diet_id=:did, breakfast=:bf, lunch=:ln, supper=:sp, collation=:cl, dinner=:di, date=:dt, age=:ag, height=:he, weight=:we, gender=:ge  WHERE diet_id = :did AND user_id=:uid');
    $stmt->execute(array(
    ':uid' => $_POST["user_id"],
    ':did' => $_POST["diet_id"],
    ':bf' => $newDiet[0],
    ':ln' => $newDiet[1],
    ':sp' => $newDiet[2],
    ':cl' => $newDiet[3],
    ':di' => $newDiet[4],
    ':dt' => $date,
    ':ag' => $_POST["age"],
    ':he' => $_POST["height"],
    ':we' => $_POST["weight"],
    ':ge' => $_POST["gender"])); 
    header("location:dietTable.php");
    return;
} 

?>
<!doctype html lang="en">
<html>
    <head>
        <meta charset="UTF-8">
        <title>Diet Create</title>
        <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>">
        <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/ui-lightness/jquery-ui.css" rel="stylesheet" type="text/css" />
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
        <div class="editDiets">
            <form method="POST">
                <?php
                $stmt = $pdo->prepare("SELECT * FROM diets WHERE diet_id = :did");
                $stmt->execute(array(":did" => $_GET["diet_id"]));
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row === false){
                    header("Location: dietTable.php");
                    return;
                }
                convertDietData($row);
                ?>
                <script>
                    //Uses Ajax to receive JSON data that will be used by the autocomplete widget
                    $('#Breakfast2').autocomplete({
                    source: function(request, response) {
                    $.ajax({
                        url: 'alternatives/alternativesMenu.php',
                        dataType: 'json',
                        data: {
                        term: request.term,
                        input: 'Breakfast2'
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                    }
                });

                    $('#Breakfast4').autocomplete({
                        source: function(request, response) {
                        $.ajax({
                            url: 'alternatives/alternativesMenu.php',
                            dataType: 'json',
                            data: {
                            term: request.term,
                            input: 'Breakfast4'
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                        }
                    });

                    $('#Breakfast6').autocomplete({
                        source: function(request, response) {
                        $.ajax({
                            url: 'alternatives/alternativesMenu.php',
                            dataType: 'json',
                            data: {
                            term: request.term,
                            input: 'Breakfast6'
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                        }
                    });

                    $('#Lunch2').autocomplete({
                        source: function(request, response) {
                        $.ajax({
                            url: 'alternatives/alternativesMenu.php',
                            dataType: 'json',
                            data: {
                            term: request.term,
                            input: 'Lunch2'
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                        }
                    });

                    $('#Lunch4').autocomplete({
                        source: function(request, response) {
                        $.ajax({
                            url: 'alternatives/alternativesMenu.php',
                            dataType: 'json',
                            data: {
                            term: request.term,
                            input: 'Lunch4'
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                        }
                    });

                    $('#Lunch6').autocomplete({
                        source: function(request, response) {
                        $.ajax({
                            url: 'alternatives/alternativesMenu.php',
                            dataType: 'json',
                            data: {
                            term: request.term,
                            input: 'Lunch6'
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                        }
                    });

                    $('#Lunch8').autocomplete({
                        source: function(request, response) {
                        $.ajax({
                            url: 'alternatives/alternativesMenu.php',
                            dataType: 'json',
                            data: {
                            term: request.term,
                            input: 'Lunch8'
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                        }
                    });

                    $('#Supper2').autocomplete({
                    source: function(request, response) {
                    $.ajax({
                        url: 'alternatives/alternativesMenu.php',
                        dataType: 'json',
                        data: {
                        term: request.term,
                        input: 'Supper2'
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                    }
                });

                    $('#Supper4').autocomplete({
                        source: function(request, response) {
                        $.ajax({
                            url: 'alternatives/alternativesMenu.php',
                            dataType: 'json',
                            data: {
                            term: request.term,
                            input: 'Supper4'
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                        }
                    });

                    $('#Supper6').autocomplete({
                        source: function(request, response) {
                        $.ajax({
                            url: 'alternatives/alternativesMenu.php',
                            dataType: 'json',
                            data: {
                            term: request.term,
                            input: 'Supper6'
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                        }
                    });

                    $('#Collation2').autocomplete({
                        source: function(request, response) {
                        $.ajax({
                            url: 'alternatives/alternativesMenu.php',
                            dataType: 'json',
                            data: {
                            term: request.term,
                            input: 'Collation2'
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                        }
                    });

                    $('#Dinner2').autocomplete({
                        source: function(request, response) {
                        $.ajax({
                            url: 'alternatives/alternativesMenu.php',
                            dataType: 'json',
                            data: {
                            term: request.term,
                            input: 'Dinner2'
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                        }
                    });

                    $('#Dinner4').autocomplete({
                        source: function(request, response) {
                        $.ajax({
                            url: 'alternatives/alternativesMenu.php',
                            dataType: 'json',
                            data: {
                            term: request.term,
                            input: 'Dinner4'
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                        }
                    });

                
                </script>
                <input type="hidden" value="<?=$row["user_id"]?>" name="user_id">
                <input type="hidden" value="<?=$_GET["diet_id"]?>" name="diet_id">
                <input type="hidden" value="<?=$row["age"]?>" name="age">
                <input type="hidden" value="<?=$row["height"]?>" name="height">
                <input type="hidden" value="<?=$row["weight"]?>" name="weight">
                <input type="hidden" value="<?=$row["gender"]?>" name="gender">
                <div class="modifyDiet">
                    <input type="submit" value="Modify Diet">
                </div>
            </form>
        </div>
       
        
    <script src="js/editDiet.js"></script>
    </body>