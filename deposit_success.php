<?php
session_start();
if (!isset($_SESSION["userName"]) || $_SESSION["userName"] == "Guest") {
    header("Location: index.php");
    exit();
}

if (isset($_POST["btnSignOut"])) {
    $_SESSION["userName"] = "Guest";
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>網路銀行 － 存款成功</title>
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-family: Microsoft JhengHei;
        }

        .title {
            margin: 0;
        }

        .table td {
            text-align: center;
            padding: 20px;
        }
    </style>
</head>

<body>
    <form method="post">
        <table class="table table-bordered">
            <thead>
                <tr class="bg-primary text-light">
                    <td>
                        <p class="title">網路銀行 － 存款成功</p>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>存款成功！</td>
                </tr>
                <tr class="bg-primary text-light">
                    <td>
                        <a href="secret.php" class="btn btn-warning" role="button">回到首頁</a>
                        <input class="btn btn-warning" type="submit" name="btnSignOut" id="btnSignOut" value="登出" />
                    </td>
                </tr>
            </tbody>
        </table>
    </form>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>