<?php
session_start();
require_once("connectconfig.php");

if (!isset($_SESSION["userName"]) || $_SESSION["userName"] == "Guest") {
  header("Location: index.php");
  exit();
}

$ErrorMessage = "";

if (isset($_POST["btnOK"])) {
  $withdrawal_amount = $_POST["withdrawal_amount"];

  if (preg_match("/^[0-9]+$/", $withdrawal_amount)) {

    $id = $_SESSION["id"];
    $sql_user_data = "select * from userlist where Idnumber='$id'";
    $user_data = $db->prepare($sql_user_data);
    $user_data->execute();
    $row = $user_data->fetch(PDO::FETCH_ASSOC);
    $amount = $row['Deposit'] - $withdrawal_amount;

    if ($amount >= 0) {
      $sql_update_deposit = <<<multi
        UPDATE
            userlist
        SET
            Deposit = "$amount"
        WHERE
            Idnumber = "$id";
      multi;
      $update_deposit = $db->prepare($sql_update_deposit);
      $update_deposit->execute();

      $sql_insert_detail = <<<multi
        INSERT INTO detail(
            Withdrawal,
            Deposit,
            Balance,
            Idnumber
        )
        VALUES(
            '$withdrawal_amount',
            '0',
            '$amount',
            '$id'
        );
      multi;
      $insert_detail = $db->prepare($sql_insert_detail);
      $insert_detail->execute();

      header("Location: withdrawal_success.php");
      exit();
    } else {
      $ErrorMessage = "餘額不足";
    }
  } else {
    $ErrorMessage = "輸入金額錯誤";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>網路銀行 - 提款</title>
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

    .input_amount {
      text-align: right;
    }
  </style>
</head>

<body>
  <form id="form2" name="form2" method="post">
    <table class="table table-bordered">
      <thead>
        <tr class="bg-dark text-light">
          <td colspan="2">
            <p class="title">網路銀行 - 提款</p>
          </td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="align-middle">請輸入要提取的金額</td>
          <td>
            <input class="input_amount" type="number" name="withdrawal_amount" id="withdrawal_amount" autofocus />
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input class="btn btn-success register" type="submit" name="btnOK" id="btnOK" value="提款" />
        </tr>
        <tr class="bg-dark text-light">
          <td colspan="2">
            <a href="secret.php" class="btn btn-warning" role="button">回到首頁</a>
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