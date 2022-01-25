<?php
    $servername='localhost';
    $username='root';
    $password='mysql';
    $dbname='login_logout';
    $con=mysqli_connect($servername, $username, $password, "$dbname");
    if(!$con){
        die('Connection impossible avec MySql: ' .mysql_error());
    }
?>