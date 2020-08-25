<?php
session_start();
if (isset($_GET["logout"])) {
  $_SESSION["userName"] = "Guest";
  header("Location: index.php");
  exit();
}

if (isset($_POST["btnHome"])) {
  header("Location: index.php");
  exit();
}

$ErrorMessage = "";

if (isset($_POST["btnOK"])) {
  $sUserName = $_POST["txtUserName"];
  $sPassword = $_POST["txtPassword"];
  if (trim($sUserName) != "" && preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8}/', $sPassword)) {
    $_SESSION["userName"] = $sUserName;
    $sql = <<<multi
  INSERT INTO userlist(UserName, Password) VALUES('$sUserName', '$sPassword');
  multi;
    require_once("connectconfig.php");
    mysqli_query($link, $sql);
    if (isset($_SESSION["lastPage"]))
      header(sprintf("Location: %s", $_SESSION["lastPage"]));
    else
      header("Location: index.php");
    exit();
  } else {
    $ErrorMessage = "帳號或密碼有誤";
  }
}

// if (isset($_POST["okButton"])) {
//   $firstName = $_POST["firstName"];
//   $lastName = $_POST["lastName"];
//   $cityId = $_POST["cityId"];
//   $sql = <<<multi
//   INSERT INTO employee(firstName, lastName, cityId) VALUES('$firstName', '$lastName', $cityId);
//   multi;
//   require_once("connectconfig.php");
//   mysqli_query($link, $sql);
//   header("location:index.php");
// }

?>

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Lab - Login</title>
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
  <form id="form1" name="form1" method="post" action="login.php">
    <table class="table table-bordered">
      <thead>
        <tr class="bg-primary text-light">
          <td colspan="2">
            <p class="title">會員系統 - 登入</p>
          </td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>帳號</td>
          <td>
            <input type="text" name="txtUserName" id="txtUserName" />
          </td>
        </tr>
        <tr>
          <td>密碼</td>
          <td>
            <input type="password" name="txtPassword" id="txtPassword" />
          </td>
        </tr>
        <tr class="bg-primary text-light">
          <td colspan="2">
            <input class="btn btn-warning" type="submit" name="btnOK" id="btnOK" value="登入" />
            <input class="btn btn-warning" type="reset" name="btnReset" id="btnReset" value="重設" />
            <input class="btn btn-warning" type="submit" name="btnHome" id="btnHome" value="回首頁" />
          </td>
        </tr>
      </tbody>
    </table>
    <p class="text-danger"><?= $ErrorMessage ?></p>
  </form>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>