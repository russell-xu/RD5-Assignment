<?php
// MAMP uses the following scheme
// $link = mysqli_connect("localhost", "root", "root", "userdata", 8889);
// mysqli_query($link, "set names utf-8");

// XAMPP uses the following scheme
// $link = mysqli_connect("localhost", "root", "", "userdata", 3306);
// mysqli_query($link, "set names utf-8");

$link = @new mysqli("localhost", "root", "", "userdata");
$link->query("set names utf-8");

// $dbms = 'mysql';
// $host = 'localhost';
// $dbName = 'userdata';
// $user = 'root';
// $pass = ''; // MAMP:root
// $dsn = "$dbms:host=$host;dbname=$dbName";

// try {
//     $dbh = new PDO($dsn, $user, $pass);
    // echo "連接成功<br/>";
//     $dbh = null;
// } catch (PDOException $e) {
//     die("Error!: " . $e->getMessage() . "<br/>");
// }
// $db = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true));
