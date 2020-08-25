<?php
require_once("connectconfig.php");
$commandText = <<<multi
SELECT
    employeeId,
    firstName,
    lastName,
    e.cityId,
    cityName
FROM
    city c
JOIN employee e ON
    e.cityId = c.cityId;
multi;
$result = mysqli_query($link, $commandText);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Striped Rows</h2>
        <p>The .table-striped class adds zebra-stripes to a table:</p>
        <table class="table table-striped">
            <thead>
                <a href="addform.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Add New</a>

                <tr class="text-center">
                    <th class="align-middle">Firstname</th>
                    <th class="align-middle">Lastname</th>
                    <th class="align-middle">City</th>
                    <th class="align-middle"></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr class="text-center">
                        <td class="align-middle"><?= $row['firstName'] ?></td>
                        <td class="align-middle"><?= $row['lastName'] ?></td>
                        <td class="align-middle"><?= $row['cityName'] ?></td>
                        <td class="align-middle">
                            <span>
                                <a href="editform.php?id=<?= $row['employeeId'] ?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Edit</a>
                                <a href="deleteform.php?id=<?= $row['employeeId'] ?>" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Delete</a>
                            </span>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>