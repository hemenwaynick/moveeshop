<?php

$con = mysqli_connect("localhost", "nhemenway", "p35170", "nhemenway_moveeshop");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// check if the quantity requested is available for order. If not, display error message
$query = mysqli_query($con, "SELECT * FROM Titles WHERE tno = '$_POST[tnumber]';");

$row1 = mysqli_fetch_assoc($query);

if ($row1[inventory] < $_POST[quantity]) {
    die("Order failed to process: the quantity you requested is not available.");
} else {

    // update quantity
    $query1 = mysqli_query($con, "UPDATE Titles SET inventory = inventory - '$_POST[quantity]' WHERE tno = '$_POST[tnumber]';");

    // store order information in the database and display order number to customer
    $query2 = mysqli_query($con, "SELECT cno FROM Customers WHERE email = '$_POST[email]';");

    $row2 = mysqli_fetch_assoc($query2);

    $query3 = mysqli_query($con, "INSERT INTO Orders VALUES (0, '$row2[cno]', now());");

    $ono = mysqli_insert_id($con);

    $query4 = mysqli_query($con, "INSERT INTO Odetails VALUES ('$ono', '$_POST[tnumber]', '$_POST[quantity]');");

    echo 'Order success! Your order number is ' . $ono . '.';

}

mysqli_close($con);

?>