<html lang="en">
<head>
<meta charset="utf-8">
<title>Payments</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<?php
include 'navbar.php';
// Create connection
@$conn=mysqli_connect("localhost", "root", "", "classicmodels"); #https://stackoverflow.com/questions/1987579/remove-warning-messages-in-php
// Check connection
if (mysqli_connect_error())
    {
    echo "<p class=\"error\">Error: The requested table cannot be displayed due to a problem connecting to the MySQL server.</p>";
    die; 
    }#https://www.w3schools.com/php/func_mysqli_error.asp
echo "<form action=\"payments.php\" method=\"post\" id=\"autosubmit\">";
echo "<select name=\"dropdown\" onchange=\"autosubmit.submit()\">";
?>
<option value="20" <?php echo (isset($_POST['dropdown']) && $_POST['dropdown'] == '20') ? 'selected="selected"' : ''; ?>>20 Most Recent Payments</option>;
<option value="40" <?php echo (isset($_POST['dropdown']) && $_POST['dropdown'] == '40') ? 'selected="selected"' : ''; ?>>40 Most Recent Payments</option>;
<option value="60" <?php echo (isset($_POST['dropdown']) && $_POST['dropdown'] == '60') ? 'selected="selected"' : ''; ?>>60 Most Recent Payments</option>; https://stackoverflow.com/questions/36072238/php-keep-dropdown-value-after-submit 
<?php
echo "</select>";
echo "</form>";
$limit = 20;
echo "<iframe name=\"tableframe\" src=\"customerinfo.php\" style=\"border: none; position: relative; left: 65%; width: 100%; height: 100%;\"></iframe>";
if(isset($_POST['dropdown'])) {
    $limit = $_POST['dropdown'];
}

@$sql = "SELECT checkNumber, paymentDate, amount, customerNumber FROM payments LIMIT $limit";

$result = $conn->query($sql);

if ($result === false) {
            echo "<p class=\"error\" style=\"top: -80%;\";>Error: There was a problem with the query sent to the database - please contact an administrator for further support.</p>";
            die;
        } else {
    // output data of each row
    echo "<table style=\"border: none; width: 65%; position: relative; top: -100%;\">
    <tr>
    <th>Check Number</th>
    <th>Payment Date</th>
    <th>Amount</th>
    <th>Customer Number</th>
    </tr>";
    while($row = $result->fetch_assoc()) { 
        echo "<tr>";
        echo "<td>" .$row["checkNumber"] . "</td>";
        echo "<td>" .$row["paymentDate"] . "</td>";
        echo "<td>" .$row["amount"] . "</td>";
        $customerno = $row["customerNumber"];
        echo "<td id='clickablecell'><form action=\"customerinfo.php\" target=\"tableframe\" method=\"post\" id=\"alsosubmit\"><input type=\"hidden\" value='$customerno' name=\"customerno\"><input type=\"submit\" value='$customerno' name='submit' id='hiddenbutton'></form></td>"; #form sent to inframe to prevent page refresh on submit
        echo "</tr>"; #include more info
    }
    echo "</table>";
}
include 'footer.php';
$conn->close();
?>
</html>