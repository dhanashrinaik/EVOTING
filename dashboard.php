<?php
session_start();


    $db = new PDO('mysql:host=localhost;dbname=e-votingsystem', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $voter_data = [];

// Retrieve voter data from the database
$query = "SELECT * FROM userdata WHERE user_id = :user_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $user_id); // Set $user_id to the verified user's ID
$stmt->execute();
if ($stmt->rowCount() > 0) {
    $voter_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "No data found for the provided user ID.";
}

// Display voter data on the dashboard page
foreach ($voter_data as $voter) {
    echo "username: " . $voter['username'] . "<br>";
    echo "mobile: " . $voter['mobile'] . "<br>";
    echo "email: " . $voter['email'] . "<br>";
    echo "photo: " . $voter['photo'] . "<br>";
    echo "role: " . $voter['username'] . "<br>";
    echo "user_id: " . $voter['user_id'] . "<br>";
   
    // Add more fields as needed


// Close the database connection
$db = null;
}
?>



<?php
// Assume $db is your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a form field named 'user_id'
    $user_id = $_POST['user_id'];

    // Retrieve voter data from the database
    $query = "SELECT * FROM userdata WHERE user_id = :user_id";
    $stmt = $db ->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $voter_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the database connection
    $db  = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voter Dashboard</title>
</head>
<body>

<h1>WELCOME TO E-VOTING</h1>

<!-- Form to input user_id -->
<form method="post" action="">
    <label for="user_id">Enter Mobile No:</label>
    <input type="text" name="mobile" required>
    <button type="submit">Submit</button>
</form>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <!-- Display voter data in a table if form is submitted -->
    <table border="1">
        <tr>
            <th>username</th>
            <th>mobile</th>
            <th>email</th>
            <th>role</th>
            <th>user_id</th>
           
            <!-- Add more table headers as needed -->
        </tr>

        <?php foreach ($voter_data as $voter): ?>
            <tr>
                <td><?php echo $voter['username']; ?></td>
                <td><?php echo $voter['mobile']; ?></td>
                <td><?php echo $voter['email']; ?></td>
                <td><?php echo $voter['role']; ?></td>
                <td><?php echo $voter['user_id']; ?></td>
              
                <!-- Add more table cells for additional fields -->
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>