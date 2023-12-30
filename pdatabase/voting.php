<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);


    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        $votes = $_POST['candidateVotes'];
        $total_votes = $votes + 1;
        $cid = $user_data['id'];

        $update_votes = mysqli_query($con, "UPDATE userdata SET votes=$total_votes WHERE id='$cid");
        $upadte_user_status = mysqli_query($con, "UPDATE userdata SET status=1 WHERE id='$cid' ");

        if ($total_votes and $upadte_user_status) {
            $sql = "select * from userdata";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
                $sql = "select username,photo,email from userdata where role='candidate'";
                $resultcandidate = mysqli_query($con, $sql);
                if (mysqli_num_rows($resultcandidate) > 0) {
                    $candidate = mysqli_fetch_all($resultcandidate, MYSQLI_ASSOC);
                    $_SESSION['candidate'] = $candidate;
                    $_SESSION['$user_data']['status'] = 1;
                    $_SESSION['candidate'] = $candidate;
                    echo '<script>alert("Voting Successful!!")
                    window.location="index.php" </script>';
                }
            }
        } else {
            echo '<script>alert("Some error occurred!!");
            window.location="index.php" </script>';
        }
    

  ?>