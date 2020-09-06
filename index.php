<?php
session_start();

$ErrorMessage = "";

if (isset($_POST["btnOK"])) {
  $sIdNumber = $_POST["txtIdNumber"];
  $sUserName = $_POST["txtUserName"];
  $sPassword = $_POST["txtPassword"];

  require_once("connectconfig.php");
  $sql = "SELECT * FROM userlist where Idnumber = '$sIdNumber'";
  $result = $link->query($sql);
  $row = @$result->fetch_row();

  if ($row !== null && $sIdNumber != null && $sUserName != null && $sPassword != null && $row[0] == $sIdNumber && $row[1] == $sUserName && $row[2] == $sPassword) {
    $_SESSION["id"] = $sIdNumber;
    $_SESSION["userName"] = $sUserName;
    header("Location: secret.php");
    exit();
  } else {
    $ErrorMessage = "身分證字號、使用者代號或網銀密碼有誤";
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>網路銀行 - 登入</title>
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

    .register {
      font-size: 20px;
      padding: 6px 60px;
    }
  </style>
</head>

<body>
  <form id="form1" name="form1" method="post" action="index.php">
    <table class="table table-bordered">
      <thead>
        <tr class="bg-dark text-light">
          <td colspan="2">
            <p class="title">網路銀行 - 登入</p>
          </td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="align-middle">身分證字號</td>
          <td>
            <input type="text" name="txtIdNumber" id="txtIdNumber" />
          </td>
        </tr>
        <tr>
          <td class="align-middle">使用者代號</td>
          <td>
            <input type="text" name="txtUserName" id="txtUserName" />
          </td>
        </tr>
        <tr>
          <td class="align-middle">網銀密碼</td>
          <td>
            <input type="password" name="txtPassword" id="txtPassword" />
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input class="btn btn-success register" type="submit" name="btnOK" id="btnOK" value="登入" />
        </tr>
        <tr class="bg-dark text-light">
          <td colspan="4">
            <a href="registered.php" class="btn btn-warning">註冊帳戶</a>
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