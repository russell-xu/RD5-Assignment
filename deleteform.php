<?php
if (!isset($_GET["id"])) {
    die("id not found");
}

$id = $_GET["id"];


if (!is_numeric($id)) {
    die("id not number");
}

$sql = <<<multi
DELETE
FROM
    employee
WHERE
    employeeId = $id
multi;

require_once("connectconfig.php");
mysqli_query($link, $sql);
header("location:index.php");
