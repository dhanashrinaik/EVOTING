<?php 
session_start();



include("connection.php");
include("functions.php");

$username = isset($_POST["username"]) ? $_POST["username"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

$query = "select * from userdata ";
$result = mysqli_query($con, $query);




// if ($result) {
// 	if ($result && mysqli_num_rows($result) > 0) {

// 		$user_data = mysqli_fetch_assoc($result);
// 	}
// }

$sql = "select * from userdata";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
	$sql = "select username,photo,email from userdata where role='candidate'";
	$resultcandidate = mysqli_query($con, $sql);
	if (mysqli_num_rows($resultcandidate) > 0) {
		$candidate = mysqli_fetch_all($resultcandidate, MYSQLI_ASSOC);
		$_SESSION['candidate'] = $candidate;
		
	}
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css>
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
		/* Basic CSS styles for ballot */
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			/* padding: 20px; */
			padding: 0;
            max-width: 100%;
            overflow-x: hidden;
            background-color: #000;
            /* color:#fff; */

		}

		
		h2 {
			text-align: center;
			color: white;
			font-size: 40px;

		}


		input[type="radio"] {
			margin-bottom: 10px;
		}

		input[type="submit"] {
			padding: 10px 20px;
			background-color: #4CAF50;
			color: white;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #45a049;
		}

		.Vtext {

			font-family: Poppins;
			font-size: 28px;
			font-weight: 400;
			color: white;
			text-shadow: #4CAF50;
			text-transform: capitalize;
			margin-top: 30px;
		}

		.Vimg {
			position: relative;
			display: block;
			margin-left: 30px auto;
			margin-right: auto;
			z-index: 1;
			width: 350px;
			height: 320px;
			border-radius: 50%;
			border: 5px solid white;
		}

		.VotingBtn {
			padding: 12px 24px;
			background-image: linear-gradient(to left, #3498db, #00a4bd);
			color: white;
			border-radius: 6px;
			border: 2px white solid;
			transition: transform 250ms ease-in-out;
			font-weight: 600;
			margin-top: 50px;
		}

		.VotingBtn:hover {
			transform: scale(1.1);
		}

		.VotingBtn.active {
			transform: scale(0.9);
		}

		.Cimg {
			position: relative;
			display: block;
			margin-left: 0px;
			margin-right: auto;
			z-index: 1;
			width: 150px;
			height: 150px;
			border-radius: 45%;
			border: 5px solid white;
		}

        footer {
			background: #111;
			height: auto;
			/* width:100vw; */
			font-family: "Open Sans";
			padding-top: 10px;
			color: #fff;
			margin-top: 100px;
		}

		.footer-content {
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			text-align: center;

		}

		.footer-content h3 {
			font-size: 1.2rem;
			font-weight: 400;
			text-transform: capitalize;
			line-height: 3rem;

		}

		.footer-content p {
			max-width: 500px;
			margin: 10px auto;
			line-height: 28px;
			font-size: 14px;
		}

		.socials {
			list-style: none;
			display: flex;
			align-items: center;
			justify-content: center;
			max-width: 1rem 0 3rem 0;
		}

		.socials li {
			margin: 0 10px;
		}

		.socials a {
			text-decoration: none;
			color: #fff;
		}

		.socials a i {
			font-size: 1.2rem;
			transition: color .4s ease;
		}

		.socials a:hover {
			color: aqua;
		}

		.footer-bottom {
			background: #000;
			padding: 10px 0;
			text-align: center;
		}

		.footer-bottom p {
			font-size: 14px;
			word-spacing: 2px;
			text-transform: capitalize;
		}

		.footer-bottom span {
			text-transform: uppercase;
			opacity: 4;
			font-weight: 200;
		}

		/* FOOTER SECTION ENDS */
        </style>
</head>
<body>

<?php include '../nav.php' ?>
    
	<br>
    <br>
	<?php
	$sql = "SELECT username, photo, email,votes FROM userdata WHERE role = 'candidate' ";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
       
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
           
						<div class="col-sm mb-5">
						<span><input type="submit" class="bg-success" value="Add" ></span>
					</div>
						
					<div class="col-sm mb-5">
					<span><input type="submit" class="bg-danger" value="Delete" ></span>
				</div>';
           

            echo '</div>
            
            </form></div></div>';
            
        }
    }
   

?>
	
	<!-- <select name="vote_position" class="form-select w-50 m-auto  mb-5" id="positionSelect">
				<option value="">Choose Candidate Position</option>
				<option value="Senior class President">Senior class President</option>
				<option value="Senior class Vice President">Senior class Vice President</option>
				<option value="Senior class Secretary">Senior class Secretary</option>
			</select>

			Div to display candidates based on the selected position
			<div class="mainDiv mt-5 pt-5" id="candidateRoleSelection" style="display: none;"></div>

			JavaScript to display candidates based on selected position
			<script>
				document.getElementById('positionSelect').addEventListener('change', function() {
					var position = this.value;
					if (position !== '') {
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if (this.readyState === 4 && this.status === 200) {
								document.getElementById('candidateRoleSelection').innerHTML = this.responseText;
								document.getElementById('candidateRoleSelection').style.display = 'block';
							}
						};
						xhttp.open('GET', 'get_candidates.php?position=' + position, true);
						xhttp.send();
					} else {
						document.getElementById('candidateRoleSelection').style.display = 'none';
					}
				});
			</script> -->
    <?php include '../footer.php' ?>
</body>
</html>