<?php
session_start();
require_once "util.php";
require_once "pdo.php";
validateLogin();
?>
<!doctype html lang="en">
<html>
    <head>
        <meta charset="UTF-8">
        <title>Diet List</title>
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
            <div class="dietContain">
                <div class="row">
                    <div class="col">
                        <h1 class="text-start">Diet List</h1>
                    </div>
                    <div class="col">
                        <a class="dietCreate" href="createDiet.php">New Diet</a>
                    </div>
                </div>
                <section class="p-5">
                    <h3 class="pb-2">Diet Table</h3>
                    <div class="table-responsive" id="no-more-tables">
                        <table class="table bg-white">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Creation Date</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            #Creates the table to interact with the diet
                            $stmt = $pdo->query("SELECT * FROM diets WHERE user_id = ".$_SESSION["user_id"].";");
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                echo "<tr><td data-title='ID'>".$row["diet_id"]."</td><td data-title='Date'>".$row["date"]."</td><td data-title='View'><a href=view.php?diet_id=".$row["diet_id"].">View Diet</a></td><td data-title='Edit'><a href=edit.php?diet_id=".$row["diet_id"].">Edit Diet</a></td><td data-title='Delete'><a href=delete.php?diet_id=".$row["diet_id"].">Delete Diet</a>";
                                echo "</td></tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
            <script src="js/tableScript.js"></script>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
    </body>
</html>