<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>網路銀行會員 - 首頁</title>
  <script src="/RD5_Assignment/js/jquery.min.js"></script>
</head>
<body>
  <br>
  您的餘額：<input id="amount" type="password" value="<?php $this->amountSearch(); ?>" readonly><br><button id='show'>顯示餘額</button><br>
  <a href="http://localhost:8888/RD5_Assignment/onlineBank/deposit">存款</a>
  <a href="http://localhost:8888/RD5_Assignment/onlineBank/withdraw">提款</a>
  <a href="http://localhost:8888/RD5_Assignment/onlineBank/tradeSearch">查詢明細</a>
  <a href="http://localhost:8888/RD5_Assignment/onlineBank/logout">登出</a>

</body>
<script>
$("#show").on("click", function() {
  $this = $(this);
  if ($this.html() == "顯示餘額"){
    $this.html("隱藏餘額");
    document.getElementById('amount').type = 'text';
    return;
  }
  $this.html("顯示餘額");
  document.getElementById('amount').type = 'password';
  
  
});
</script>
</html>