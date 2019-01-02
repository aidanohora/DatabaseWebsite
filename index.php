<html lang="en">
<head>
<meta charset="utf-8">
<title>Index</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<?php
include 'navbar.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "classicmodels";

// Create connection
@$conn=mysqli_connect("localhost", "root", "", "classicmodels"); #https://stackoverflow.com/questions/1987579/remove-warning-messages-in-php
// Check connection
if (mysqli_connect_error())
    {
    echo "<p class=\"error\">Error: The requested table cannot be displayed due to a problem connecting to the MySQL server.</p>";
    die; 
    }#https://www.w3schools.com/php/func_mysqli_error.asp

$sql = "SELECT productLine, textDescription FROM productlines";

$result = $conn->query($sql);

if ($result === false) { #https://stackoverflow.com/questions/2414569/if-mysql-query-fails-what-to-do
    echo "<p class=\"error\">Error: There was a problem with the query sent to the database - please contact an administrator for further support.</p>";
    die; #catching a query error
} else {
    // output data of each row
    echo "<table>
    <tr>
    <th>Product Line</th>
    <th>Text Description</th>
    </tr>";
    while($row = $result->fetch_assoc()) { 
        echo "<tr>";
        echo "<td>" .$row["productLine"] . "</td>";
        echo "<td>" .$row["textDescription"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} 
include 'footer.php';
$conn->close();
?>
</html>