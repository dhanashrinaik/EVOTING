<?php
session_start();

include("connection.php");
include("functions.php");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Retrieve form inputs
    $C_name = $_POST['C_name'];
    $C_email = $_POST['C_email'];
    $C_mobile = $_POST['C_mobile'];
    $C_password = $_POST['C_password'];
    $cpassword = $_POST['cpassword'];
    $image = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
 
    

    // Check if the username, email, or mobile already exists in the database
    $usernameCheckQuery = "SELECT * FROM candidate WHERE C_name = '$C_name'";
    $usernameCheckResult = mysqli_query($con, $usernameCheckQuery);

    $emailCheckQuery = "SELECT * FROM candidate WHERE C_email = '$C_email'";
    $emailCheckResult = mysqli_query($con, $emailCheckQuery);

    $mobileCheckQuery = "SELECT * FROM candidate WHERE C_mobile = '$C_mobile'";
    $mobileCheckResult = mysqli_query($con, $mobileCheckQuery);

    if (mysqli_num_rows($usernameCheckResult) > 0) {
        echo '<script>alert("Username already exists. Please choose a different username.");';
        echo 'window.location="signup.php";</script>';
    } elseif (mysqli_num_rows($emailCheckResult) > 0) {
        echo '<script>alert("Email already exists. Please use a different email.");';
        echo 'window.location="signup.php";</script>';
    } elseif (mysqli_num_rows($mobileCheckResult) > 0) {
        echo '<script>alert("User already exists. Please use a different mobile number.");';
        echo 'window.location="signup.php";</script>';
    } else {
        // Check for password match and other validations
        if ($C_password != $cpassword) {
            echo '<script>alert("Passwords do not match");</script>';
        } elseif (empty($C_name) || empty($C_mobile) || empty($C_password) || empty($cpassword)) {
            echo '<script>alert("Please enter valid information!");</script>';
        } else {
            // Save user to the database if everything is valid
            // $user_id = random_num(20);
            move_uploaded_file($tmp_name, "uploads/$image");

            $query = "INSERT INTO candidate (cid, C_name, C_email, C_mobile, C_password, photo,  status, votes) VALUES ('$cid', '$C_name', '$C_email', '$C_mobile', '$C_password', '$image', 0, 0)";
          

            if (mysqli_query($con, $query)) {
                echo '<script>alert("Registration Successful");';
                echo 'window.location="login.php";</script>';
                die;
            } else {
                echo '<script>alert("Error: Unable to register. Please try again later.");</script>';
            }
        }
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
    </style>
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <?php include('../nav.php') ?>
    <h1 class="text-center pt-4">E-Voting System</h1>
    <hr>
    <h2 class="text-center pt-4">Candidate Registration</h2>
    <div class="container text-center">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <input type="text" class="form-control w-50 m-auto" name="C_name" placeholder="Enter Your Name" required="required">
            </div>
            <div class="mb-3">
                <input type="email" class="form-control w-50 m-auto" name="C_email" placeholder="Enter Your Email" required="required">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control w-50 m-auto" name="C_mobile" placeholder="Enter Your Mobile number" required="required" maxlength="10" minlength="10">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control w-50 m-auto" name="C_password" placeholder="Enter Your Password" required="required">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control w-50 m-auto" name="cpassword" placeholder="Confirm Password" required="required">
            </div>
            <span style="margin-right:390px;font-size:18px;margin-bottom:3px; padding:5px;">Uplaod Id Photo:</span>
            <div class="mb-3">
                <input type="file" class="form-control w-50 m-auto" name="photo">
            </div>

            <button type="submit" class=" btn btn-dark my-4">Register</button>
            <p>Already have an account ? <a href="login.php" class="text-info fw-bolder ">Login Here</a></p>

    </div>

    </form>
    <?php include '../footer.php' ?>

</body>

</html>