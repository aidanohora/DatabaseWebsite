<html lang="en">
<head>
<meta charset="utf-8">
<title>Customer Info</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<?php
// Create connection
@$conn=mysqli_connect("localhost", "root", "", "classicmodels"); #https://stackoverflow.com/questions/1987579/remove-warning-messages-in-php
// Check connection
if (mysqli_connect_error())
    {
    echo "<p class=\"customererror\">Error: The requested table cannot be displayed due to a problem connecting to the MySQL server.</p>";
    die; 
    } #https://www.w3schools.com/php/func_mysqli_error.asp

if (isset($_POST['submit'])) {
        $customer = $_POST['customerno'];
        @$sql = "SELECT phone, customerNumber, salesRepEmployeeNumber, creditLimit FROM customers WHERE customerNumber='$customer';";
        $result = $conn->query($sql);
    
        if ($result === false) {
            echo "<p class=\"customererror\">Error: There was a problem with the query sent to the database for the customer information table - please contact an administrator for further support.</p>";
        } else {
            echo "<table>
            <tr>
            <th>Customer No.</th>
            <th>Phone No.</th>
            <th>Sales Rep.</th>
            <th>Credit Limit</th>
            </tr>";
            while($row = $result->fetch_assoc()) { 
                echo "<tr>";
                echo "<td>" .$row["customerNumber"] . "</td>";
                echo "<td>" .$row["phone"] . "</td>";
                echo "<td>" .$row["salesRepEmployeeNumber"] . "</td>";
                echo "<td>" .$row["creditLimit"] . "</td>";
                echo "</tr>"; 
            }
            echo "</table>";
            }
    @$sql = "SELECT paymentDate, amount FROM payments WHERE customerNumber='$customer';";
            $result = $conn->query($sql);
    
            if ($result === false) {
            echo "<p class=\"paymenterror\">Error: There was a problem with the query sent to the database for the customer payments table - please contact an administrator for further support.</p>";
        } else {
            echo "<br>
            <table>
            <tr>
            <th>Payment Date</th>
            <th>Amount</th>
            </tr>";
            while($row = $result->fetch_assoc()) { 
                echo "<tr>";
                echo "<td>" .$row["paymentDate"] . "</td>";
                echo "<td>" .$row["amount"] . "</td>";
                echo "</tr>"; 
            }
            @$sql = "SELECT round(sum(amount), 2) as total FROM payments WHERE customerNumber='$customer';";
                $result = $conn->query($sql);
            
                if ($result === false) {
            echo "<p class=\"paymenterror\">Error: There was a problem with the query sent to the database - please contact an administrator for further support.</p>";
            die;
        }
                $row = mysqli_fetch_row($result); #stackoverflow.com/questions/12655734/single-result-from-sum-with-mysqli
            echo "<tr>";
            echo "<td>Total Paid:</td>";
            echo "<td>" . $row[0] . "</td>";
            echo "</tr>";
            echo "</table>";
            }  
        }
$conn->close();
?>
</html>