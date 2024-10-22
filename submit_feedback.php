<?php
// Step 2:	Write code to capture the form data using the $_POST array.
$name = $_POST['name'];
$email = $_POST['email'];
$feedback = $_POST['feedback'];
$rating = $_POST['rating'];

// Step 3: Establish a connection to the campaign_feedback database
$servername = "localhost";  
$username = "root";         
$password = "";            
$dbname = "campaign_feedback";  

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Step 6: Implement error handling for the database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 4: Insert the captured data into the feedback table.
$sql = "INSERT INTO feedback (name, email, feedback, rating, submission_date) 
        VALUES ('$name', '$email', '$feedback', '$rating', NOW())";

// Step 5:	Provide a confirmation message to the user upon successful submission.
if (mysqli_query($conn, $sql)) {
    echo "Thank you for your feedback! Your submission was successful.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
