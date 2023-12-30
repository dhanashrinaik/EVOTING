<?php
session_start();

include("connection.php");


if (isset($_POST ['submit'])) {

    $ad_name = $_POST['ad_name'];
    $ad_password = $_POST['ad_password'];


    $sql="select * from admin where ad_name='$ad_name' and ad_password='$ad_password'" ;

    $query=mysqli_query($con,$sql);

    $row=mysqli_num_rows($query);
    
       if($row==1){
            echo "Login Successful";
            $_SESSION['ad_name']=$ad_name;
            header('location:adminDashboard.php');
        }
        else{
            echo "Login Failed";
            header('location:admin.php');
            
        }
    
    }


    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

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

</head>
<body>
 <?php include('../nav.php') ?>
    
    <h1 class="text-center pt-4">E-Voting System</h1>
    <hr>
    <h2 class="text-center pt-4">Login</h2>
    <div class="container text-center">
        <form method="POST" enctype="multipart/form-data" action="">
            <div class="mb-3 mt-3">
                <input type="text" class="form-control w-50 m-auto" name="ad_name" placeholder="Enter Your Name" required="required">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control w-50 m-auto" name="ad_password" placeholder="Enter Your Password" required="required">
            </div>
            <button type="submit" class=" btn btn-dark my-4" name="submit">Login</button>

           
</body>
</html>