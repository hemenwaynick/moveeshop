<?php

$con = mysqli_connect("localhost", "nhemenway", "p35170", "nhemenway_moveeshop");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// verify that email-password combination is valid
$checkEmailPass = mysqli_query($con, "SELECT email, password FROM Customers WHERE email = '$_POST[email]' AND password = '$_POST[password]'");

if (mysqli_num_rows($checkEmailPass) == 0) {
    die('The email-password combination you entered was invalid.');
}

// select movie title info
$query = mysqli_query($con, "SELECT tno, tname, price FROM Titles WHERE inventory != 0");

if (!$query)
  {
  die('Error: ' . mysqli_error($con));
  }

// display table of selected movie title info
echo '<table>';

echo '<tr><td><strong>TitleNo</strong></td><td><strong>Title</strong></td><td><strong>Price ($)</strong></td></tr>';

while ($row = mysqli_fetch_array($query)) {
    echo '<tr><td>' . $row['tno'] . '</td><td>' . $row['tname'] . '</td><td>' . $row['price'] . '</td></tr>';
}

echo '</table><br>';

// display order form
echo 
'<html>
<body>
    <form action="order.php" method="post">
        <strong>Order Form</strong>
        <br>
        Title Number:
        <input name="tnumber">
        <br>
        Email:
        <input name="email">
        <br>
        Quantity:
        <input name="quantity">
        <br>
        <input name="Submit" value="Submit Order" type="submit">
</html>';

mysqli_close($con);
?>