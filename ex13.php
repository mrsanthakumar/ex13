<?php

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve student records
$sql = "SELECT id, name, grade FROM students";
$result = $conn->query($sql);

// Check if there are any records
if ($result->num_rows > 0) {
    // Fetch all rows into an associative array
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }

    // Function to sort students by grade in descending order
    function sortByGradeDesc($a, $b) {
        return $b['grade'] - $a['grade'];
    }

    // Sort students array by grade in descending order
    usort($students, 'sortByGradeDesc');

    // Display sorted student records in descending order
    echo "<h2>Sorted Student Records (Descending Order)</h2>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Grade</th>
            </tr>";

    foreach ($students as $student) {
        echo "<tr>
                <td>{$student['id']}</td>
                <td>{$student['name']}</td>
                <td>{$student['grade']}</td>
            </tr>";
    }

    echo "</table>";

} else {
    echo "No records found in the database.";
}

// Close the database connection
$conn->close();

?>
