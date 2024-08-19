<?php

define('DB_SERVER', "srv1496.hstgr.io");
define('DB_USERNAME', "u730102058_trailer");
define('DB_PASSWORD', "Isitok@2003");
define('DB_DATABASE', "u730102058_trailer");

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (!$conn) {

    die("Connection failed" . mysqli_connect_error());
}
