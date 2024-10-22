<?php
// Step 2:	Establish a connection to the campaign_feedback database.
$servername = "localhost";
$username = "root";        
$password = "";            
$dbname = "campaign_feedback"; 

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 6: Set up pagination
$limit = 5;  // Number of entries per page
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$offset = ($page - 1) * $limit;

// Step 3:	Write a SQL query to select all records from the feedback table.
$sql = "SELECT * FROM feedback LIMIT $offset, $limit";
$result = mysqli_query($conn, $sql);

// Step 4:	Display the retrieved data in an HTML table on the web page.
if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Feedback</th>
            <th>Rating</th>
            <th>Submission Date</th>
          </tr>";
    
    // Fetch and display each row of data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['feedback'] . "</td>
                <td>" . $row['rating'] . "</td>
                <td>" . $row['submission_date'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No feedback records found.";
}

// Step 6: Pagination logic
$sql_total = "SELECT COUNT(*) FROM feedback";
$total_records = mysqli_fetch_array(mysqli_query($conn, $sql_total))[0];
$total_pages = ceil($total_records / $limit);

// Display pagination links
if ($total_pages > 1) {
    echo '<div style="margin-top: 20px; text-align: center;">';
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='view_feedback.php?page=$i' style='margin: 0 5px;'>$i</a>";
    }
    echo '</div>';
}

// Close the database connection
mysqli_close($conn);
?>


<style>
    table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #009999;
}

th {
    background-color: orange;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

a {
    padding: 8px 16px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    margin: 0 5px;
}

a:hover {
    background-color: #45a049;
}

    </style>
