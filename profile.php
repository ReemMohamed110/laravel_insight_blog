
<?php 
///////////////////////////for test
include "../fixed/links.php" ?>
<body>
    <!-- Navigation-->
    <?php include "../fixed/nav.php"; ?>
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('../assets/img/home-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">

                    <h1>welcome to your profile</h1>
                    <span class="subheading"><?php echo "hello " . $_POST["name"]; ?></span>
                </div>
            </div>
        </div>
        </div>
    </header>

    <?php

    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["phone"])) {
        // echo "name =>" . $_POST["name"] . "<br>";
        // echo "email =>" . $_POST["email"] . "<br>";
        // echo "password =>" . $_POST["password"] . "<br>";
        // echo "phone =>" . $_POST["phone"] . "<br>";
        if (empty($_POST['name'])) {
            echo "email is required";
        } else {
            if (strlen($_POST['name']) > 100 || strlen($_POST['name']) < 20) {
                echo " the name must be between 20 and 100 char";
            }
        }
    }
