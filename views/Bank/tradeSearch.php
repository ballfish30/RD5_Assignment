<?php
  session_start();
  $link = include 'config.php';
  $sql = <<<mutil
      select * from trade where userId = "$_SESSION[userId]";
  mutil;
  $result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<table border="1px">
  <tr>
    <th>日期</th>
    <th>存款／提款</th>
    <th>金額</th>
    <th>備註</th>
  </tr>
<?php while ($row = mysqli_fetch_assoc($result)): ?>
  <tr>
    <td><?php echo $row["tradeDate"] ?></td>
    <td><?php echo $row["status"] ?></td>
    <td><?php echo $row["amount"] ?></td>
    <td><?php echo $row["content"] ?></td>
  </tr>
      
<?php endwhile ?>
</table><br>
<a href="http://localhost:8888/RD5_Assignment/onlineBank/bank">回首頁</a>
</body>
</html>