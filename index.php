<?php
session_start()
?>
<!doctype html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>AlwaysHealthy</title>
        <meta name="description" content="Diet making website to balance meals in the morning, afternoon, and night">
        <meta name="keywords" content="diet, healthy eating, balanced diet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>">
        <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <head>
    <body>
        <header>
            <nav class="navbar">
                <a href="index.php" class="nav-branding">Always Healthy</a>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Menu</a>
                    </li>
                    <?php
                    if (isset($_SESSION["firstName"]) && isset($_SESSION["lastName"])) {
                        echo '<li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>';
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

        <div class="section title">
                <div class="titleMessage">
                        <p>Create your own diets </p>
                        <p>or choose one!</p>
                        <form method="POST">
                            <div class="dailyEmail">
                                <input type="text" placeholder="Enter your email to receive a daily plan!">
                            </div>
                            <input class="inputEmail" type="submit" value="Submit">
                        </form>
                </div>
        </div>

        <div id="about" class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <img id="appleImage" src="img/appleBackground.png" alt="apple">
                    </div>
                    <div class="col-md-7">
                        <h2 class="secondDivTitle">What is this about?</h2>
                        <p class="secondDivDescription">We know how hard it is to stay healthy with all 
                        the planning involving in making your meals. That's why we offer
                        creating a meal plan for all 3 meals in the day, or you can just 
                        choose a predetermined diet.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div id="stats" class="statsSection section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>Why is this important?</h1>
                    </div>
                    <div class="owl-carousel owl-theme">
                        <div class="stat">
                            <span class="chart" data-percent="67">
                                <span class="percent">67</span>
                                <canvas height="152" width="152"></canvas>
                            </span>
                            <h4>Increases motor skills</h4>
                            <p>Muscles retain 67% more stength in a healthy body</p>
                        </div>

                        <div class="stat">
                            <span class="chart" data-percent="50">
                                <span class="percent">50</span>
                                <canvas height="152" width="152"></canvas>
                            </span>
                            <h4>Retains eyesight</h4>
                            <p>Eyesight is 50% better as old age increases</p>
                        </div>

                        <div class="stat">
                            <span class="chart" data-percent="20">
                                <span class="percent">20</span>
                                <canvas height="152" width="152"></canvas>
                            </span>
                            <h4>Improves thinking</h4>
                            <p>Eating healthy ensures you use around 20% more of your mental capacity</p>
                        </div>

                        <div class="stat">
                            <span class="chart" data-percent="16">
                                <span class="percent">16</span>
                                <canvas height="152" width="152"></canvas>
                            </span>
                            <h4>Increases lifespan</h4>
                            <p>The average human eating a balanced diet lives 16% more years in comparison to the population</p>
                        </div>

                        <div class="stat">
                            <span class="chart" data-percent="33">
                                <span class="percent">33</span>
                                <canvas height="152" width="152"></canvas>
                            </span>
                            <h4>Speeds up digestive system</h4>
                            <p>Eating non-processed foods increases the digestion speed by 33%</p>
                        </div>

                    </div>
                    <div class="col-md-12 text-center">
                        <p class="descriptionStats">While you may not notice the physical effects on your body all the time, 
                        a balanced diet helps you live longer, supports the strength of your muscles, and lowers risk of heart
                         disease, among others.</p>
                    </div>
                </div>
            </div>

        </div>
        <script src="js/jquery.easypiechart.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>
    </body>
</html>