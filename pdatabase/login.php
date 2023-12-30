<?php

session_start();

include("connection.php");
include("functions.php");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $username = $_POST['username'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];
    $std = $_POST['std'];



    if (!empty($username) && !empty($password) && !is_numeric($username) && !empty($mobile) && $std !== "select") {

        //read from database
        $query = "select * from userdata where username = '$username' limit 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {

                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $password) {

                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }
            }
        }

        echo "wrong username or password!";
    } else {
        echo "wrong username or password!";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            background-image: url("../Images/img15.jpg") !important;
            background-repeat: no-repeat;
            background-size: cover;
            filter: opacity(0.9);
            height: auto;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            max-width: 100%;
            overflow-x: hidden;
        }

        .navbar {
            min-height: 13vh;
            padding: 3rem 2rem;
            height: 0vh;

        }

        .navbar-brand {
            margin-left: 3rem;
            font-family: 'poppins';


        }
    </style>

    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


</head>



<body>
    <!--Navigation BAR STARTS  -->
    <nav class="navbar navbar bg-white fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fs-1 text-primary fw-bolder" href="#">E-VOTING</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Navigation Bar</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body text-primary">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item ">
                            <a class="nav-link active" aria-current="page" href="../home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#footer">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../otp.php">User Details</a>
                        </li>

                    </ul>
                    <form class="d-flex mt-3" role="search" method="post" action="Contact Form/mail.php">
                        <input class="form-control me-2" type="search" placeholder="Post your queries" aria-label="Search">
                        <button name="btn-send" class="btn btn-success" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <br>
    <br>
    <br>
    <!--Navigation BAR ENDS  -->


    <h1 class="tex-lightlink text-center p-3">E-Voting System</h1>
    <hr>
    <div class=" py-4">
        <h2 class="text-center">LOGIN</h2>
        <div class="container text-center">
            <form method="post">
                <div class="mb-3">
                    <input type="text" class="form-control w-50 m-auto" name="username" placeholder="Enter Your Name" required="required">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control w-50 m-auto" name="mobile" placeholder="Enter Your Mobile number" required="required" maxlength="10" minlength="10">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control w-50 m-auto" name="password" placeholder="Enter Your Password" required="required">
                </div>
                <div class="mb-3">
                    <select name="std" class="form-select w-50 m-auto">
                        <option value="select">Select</option>
                        <option value="Candidate">Candidate</option>
                        <option value="Voter">Voter</option>
                    </select>
                    <button type="submit" class=" btn btn-dark my-4">LOGIN</button>
                    <p>Don't have an account? <a href="signup.php" class="text-primary fw-bolder fs-5">Register Here</a></p>

                </div>


            </form>

        </div>
    </div>
    <?php include '../footer.php' ?>
</body>

</html>