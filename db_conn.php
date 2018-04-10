<?php
//mysql connection (hostname, username, password, dbname);
$mysqli = new mysqli("localhost","root","","username");

//check connection
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>
