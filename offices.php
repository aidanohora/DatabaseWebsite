<html lang="en">
<head>
<meta charset="utf-8">
<title>Offices</title>
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

$sql = "SELECT DISTINCT offices.city, offices.addressLine1, offices.addressLine2, offices.phone, offices.officeCode FROM offices ORDER BY offices.officeCode;";
$result = $conn->query($sql);

if ($result === false) {
            echo "<p class=\"error\">Error: There was a problem with the query sent to the database - please contact an administrator for further support.</p>";
            die;
} else {
    // output data of each row 
    echo "<table style=\"width: 100%;\">
    <tr>
    <th>City</th>
    <th>Address</th>
    <th>Phone No.</th>
    <th>Employees</th>
    </tr>";
    $i=1;
    while($row = $result->fetch_assoc()) { 
        echo "<tr>";
        echo "<td>" .$row["city"] . "</td>"; #use javascript, pass in the office no
        echo "<td>" .$row["addressLine1"] . " " .$row["addressLine2"] . "</td>";
        echo "<td>" .$row["phone"] . "</td>";
        $x = $row["officeCode"];
        echo "<td><form action=\"offices.php\" method=\"post\"><input type=\"hidden\" value='$x' name=\"office\"><input type=\"submit\" id='hiddenbutton' value='Expand Table' name='submit'></form></td>"; #form.guide/php-form/php-form-select.html #w3schools.com/tags/att_input_type_hidden.asp
        echo "</tr>"; #include more info 
    }
    echo "</table>";
} 

    
    
    if (isset($_POST['submit'])) {
        $officeno = $_POST['office'];
        $sql = "SELECT employees.employeeNumber, employees.lastName, employees.firstName, employees.extension, employees.email, employees.officeCode, employees.reportsTo, employees.jobTitle FROM employees WHERE employees.officeCode='$officeno' ORDER BY employees.jobTitle;";
        $result = $conn->query($sql);
        
        if ($result === false) {
            echo "<p id=\"employeeerror\">Error: There was a problem with the query sent to the database for the employees table - please contact an administrator for further support.</p>";
        } else {
            echo "<br><table>
            <tr>
            <th>Name</th>
            <th>Job Title</th>
            <th>Employee No.</th>
            <th>Email</th>
            </tr>";
            while($row = $result->fetch_assoc()) { 
                echo "<tr>";
                echo "<td>" .$row["firstName"] . " " .$row["lastName"] . "</td>";
                echo "<td>" .$row["jobTitle"] . "</td>";
                echo "<td>" .$row["employeeNumber"] . "</td>";
                echo "<td>" .$row["email"] . "</td>";
                echo "</tr>"; #include more info
            }
            echo "</table>";
            }
    }
          
            $conn->close();
include 'footer.php';
?>
</html>