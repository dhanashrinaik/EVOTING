<?php
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Retrieve form inputs
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $image = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $role = $_POST['role'];
    $candidateRole = ($role == 'candidate') ? $_POST['candidateRole'] : '';

    // Check if the username, email, or mobile already exists in the database
    $usernameCheckQuery = "SELECT * FROM userdata WHERE username = '$username'";
    $usernameCheckResult = mysqli_query($con, $usernameCheckQuery);

    $emailCheckQuery = "SELECT * FROM userdata WHERE email = '$email'";
    $emailCheckResult = mysqli_query($con, $emailCheckQuery);

    $mobileCheckQuery = "SELECT * FROM userdata WHERE mobile = '$mobile'";
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
        if ($password != $cpassword) {
            echo '<script>alert("Passwords do not match");</script>';
        } elseif (empty($username) || empty($mobile) || empty($password) || empty($cpassword) || empty($role)) {
            echo '<script>alert("Please enter valid information!");</script>';
        } else {
            // Save user to the database if everything is valid
            $user_id = random_num(20);
            move_uploaded_file($tmp_name, "uploads/$image");

            $query = "INSERT INTO userdata (user_id, username, email, mobile, password, photo, role, status, votes";

            if ($role == 'candidate') {
                $query .= ", candidateRole) VALUES ('$user_id', '$username', '$email', '$mobile', '$password', '$image', '$role', 0, 0, '$candidateRole')";
            } else {
                $query .= ") VALUES ('$user_id', '$username', '$email', '$mobile', '$password', '$image', '$role', 0, 0)";
            }

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
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css>

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

   
    <h1 class="text-center pt-4">E-Voting System</h1>
    <hr>
    <h2 class="text-center pt-4">Voter Registration</h2>
    <div class="container text-center">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <input type="text" class="form-control w-50 m-auto" name="username" placeholder="Enter Your Name" required="required">
            </div>
            <div class="mb-3">
                <input type="email" class="form-control w-50 m-auto" name="email" placeholder="Enter Your Email" required="required">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control w-50 m-auto" name="mobile" placeholder="Enter Your Mobile number" required="required" maxlength="10" minlength="10">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control w-50 m-auto" name="password" placeholder="Enter Your Password" required="required">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control w-50 m-auto" name="cpassword" placeholder="Confirm Password" required="required">
            </div>
            <span style="margin-right:390px;font-size:18px;margin-bottom:3px; padding:5px;">Uplaod Id Photo:</span>
            <div class="mb-3">
                <input type="file" class="form-control w-50 m-auto" name="photo">
            </div>


            <div class="mb-3">
                <select name="role" class="form-select w-50 m-auto" id="roleSelect" required>
                    <option value="">Select Role</option>
                    <option value="candidate">Candidate</option>
                    <option value="voter">Voter</option>
                </select>
            </div>
            <div id="candidateRoleSelection" style="display: none;">
                <select name="candidateRole" class="form-select w-50 m-auto" id="candidateSelect">
                    <option value="">Select Candidate Role</option>
                    <option value="Senior class President">Senior class President</option>
                    <option value="Senior class vice President">Senior class vice President</option>
                    <option value="Senior class Secretary">Senior class Secretary</option>
                </select>
            </div>

            <script>
                // Show candidate role selection if the candidate option is selected in the role dropdown
                document.getElementById('roleSelect').addEventListener('change', function() {
                    var candidateDiv = document.getElementById('candidateRoleSelection');
                    if (this.value === 'candidate') {
                        candidateDiv.style.display = 'block';
                    } else {
                        candidateDiv.style.display = 'none';
                        // Reset the candidate role selection when the role is changed to "voter"
                        document.getElementById('candidateSelect').selectedIndex = 0;
                    }
                });
            </script>

            <button type="submit" class=" btn btn-dark my-4">Register</button>
            <p>Already have an account ? <a href="login.php" class="text-info fw-bolder ">Login Here</a></p>

    </div>

    </form>
    <?php include '../footer.php' ?>

</body>

</html>