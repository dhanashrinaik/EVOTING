<?php
session_start();

include("connection.php");
include("functions.php");

// $user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['position'])) {
    $selectedPosition = $_GET['position'];

    // Perform database query to fetch candidates based on the selected position
    $sql = "SELECT username, photo, email,votes FROM userdata WHERE role = 'candidate' AND candidateRole = '$selectedPosition'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Display candidate information
            echo '<div class="container mt-5">
                    <div class="row">
                        <div class="col-sm mb-5">
                            <img src="uploads/' . $row['photo'] . ' " alt="Candidate image" class="Cimg">
                        </div>
                        <div class="col-sm mb-5">
                            <span>' . $row['username'] . ' </span>
                        </div>
                        <div class="col-sm mb-5">
                            <span>' . $row['email'] .  ' </span>
                        </div>
           
                        <div class="col-sm mb-5">';
                        echo '<form action="voting.php" method="post">';
                        echo'  <input type="hidden" name="candidateVotes"  value=" '. $user_data['votes'] .' "> ';
                        echo'  <input type="hidden" name="cid"  value=" '. $user_data['id'] .' "> ';


            if ($user_data['status'] == 1) {
                echo '<input type="submit" value="Voted" disabled>';
              
            } else {
                echo '<input type="submit" value="Vote" >';
            }

            echo '</div>
            
            </form></div></div>';
            
        }
    } else {
        echo 'No candidates found for the selected position.';
    }
    if ($user_data['status'] == 1){
        echo' <center><a href="result.php"><input type="submit" value="Get Results" ></a></center>';
    }
}


