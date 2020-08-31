<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>網路銀行會員 - 登入</title>
</head>
<body>
<form id="form1" name="form1" method="post" action="http://localhost:8888/RD5_Assignment/onlineBank/login">
  <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC"><font color="#FFFFFF">網路銀行會員 - 登入</font></td>
    </tr>
    <tr>
      <td width="80" align="center" valign="baseline">帳號</td>
      <td valign="baseline"><input type="text" name="userName" id="userName" required="required"/></td>
    </tr>
    <tr>
      <td width="80" align="center" valign="baseline">密碼</td>
      <td valign="baseline"><input type="password" name="passwd" id="passwd" required="required"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="btnOK" id="btnOK" value="登入" />
      <!-- <a href="http://localhost:8888/RD5_Assignment/onlineBank/restpasswd" class="restpasswd">重設密碼</a> -->
      <a href="http://localhost:8888/RD5_Assignment/onlineBank/register" class="register">註冊</a>
      </td>
    </tr>
  </table>
</form>
</body>
</html>