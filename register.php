<?php

$con = mysqli_connect("localhost", "nhemenway", "p35170", "nhemenway_moveeshop");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// check if the email is already associated with an account
$query = mysqli_query($con, "SELECT email FROM Customers WHERE email = '_POST[email]';");

if (mysqli_num_rows($query) > 0) {
    echo 'An account with the email address you entered already exists. Please, sign-in below.';
} else {

$sql = "INSERT INTO Customers VALUES
(0, '$_POST[cname]', '$_POST[street]', '$_POST[city]', '$_POST[state]', '$_POST[zip]',
    '$_POST[phone]', '$_POST[email]', '$_POST[password]', now());";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . mysqli_error($con));
  }

echo 'Your registration was successful. Your customer number is' . mysqli_insert_id($con) . '.';

}

echo 
'<html>
<body>
    <form action="signin.php" method="post">
        <strong>MoveeShop Customer Sign-in</strong>
        <br>
        Email:
        <input name="email">
        <br>
        Password:
        <input name="password" type="password">
        <br>
        <input name="Submit" value="Submit" type="submit">
</body>
</html>';

mysqli_close($con);
?>