<?php

class OnlineBankController extends Controller
{

    function index(){
        if($_SERVER['REQUEST_METHOD']=='GET') {
            return $this->view("User/login");
        }
    }


    function login(){
        session_start();
        if($_SERVER['REQUEST_METHOD']=='GET') {
            if(isset($_GET['Message'])){
                echo $_GET['Message'];
            }
            return $this->view("User/login");
        }
        //POST
        $userName = $_POST['userName'];
        $passwd = $_POST['passwd'];
        $link = include 'config.php';
        $sql = <<<mutil
            select * from user where userName = "$userName";
        mutil;
        $result = mysqli_query($link, $sql);
        $search = mysqli_fetch_assoc($result);
        if ($search == Null){
            $Message = "查無此用戶";
            return header("Location: http://localhost:8888/RD5_Assignment/onlineBank/login?Message=".$Message);
        }
        elseif(!password_verify($passwd, $search['passwd'])){
            $Message = "密碼錯誤";
            return header("Location: http://localhost:8888/RD5_Assignment/onlineBank/login?Message=".$Message);
        }
        $_SESSION['userId'] = $search['userId'];
        $Message = "親愛的用戶$userName" . "你好";
        return header("Location: http://localhost:8888/RD5_Assignment/onlineBank/bank?Message=".$Message);
    }



    function logout(){
        session_start();
        session_destroy();
        $this->view("User/login");
    }



    function register(){
        if($_SERVER['REQUEST_METHOD']=='GET') {
            if(isset($_GET['Message'])){
                echo $_GET['Message'];
            }
            return $this->view("User/register");
        }
        //POST
        $userName = $_POST['userName'];
        $passwd = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
        $email = $_POST['email'];
        // 資料庫連線參數
        $link = include 'config.php';
        $sql = <<<mutil
            insert into user(
                userName, passwd, email, total
            )
            values(
                "$userName",  "$passwd", "$email", '0'
            )
        mutil;
        if (mysqli_query($link, $sql)){
            header("Location: http://localhost:8888/RD5_Assignment/onlineBank/");
        }else{
            $Message = "帳號或信箱重複";
            header("Location: http://localhost:8888/RD5_Assignment/onlineBank/register?Message=".$Message);
        }
    }



    // function restpasswd(){
    //     if($_SERVER['REQUEST_METHOD']=='GET') {
    //         $this->view("User/restpasswd");
    //         die();
    //     }
    //     //POST
    //     $userName = $_POST['userName'];
    //     $passwd = $_POST['passwd'];
    // }



    function bank(){
        $this->userCheck();
        if($_SERVER['REQUEST_METHOD']=='GET') {
            if(isset($_GET['Message'])){
                echo $_GET['Message'];
            }
            return $this->view("Bank/bank");
        }
    }



    function deposit(){
        $this->userCheck();
        session_start();
        $today = date("Y/m/d");
        if($_SERVER['REQUEST_METHOD']=='GET') {
            if(isset($_GET['Message'])){
                echo $_GET['Message'];
            }
            return $this->view("Bank/deposit");
        }
        $link = include 'config.php';
        $sql = <<<mutil
            insert into trade(
                userId, status, amount, content, tradeDate
            )
            values(
                "$_SESSION[userId]", "存款", "$_POST[amount]",
                "$_POST[comment]", "$today"
            )
        mutil;
        mysqli_query($link, $sql);
        $sql = <<<mutil
                update user set total = total + $_POST[amount] where userId = "$_SESSION[userId]";
        mutil;
        mysqli_query($link, $sql);
        $Message = "存款成功";
            return header("Location: http://localhost:8888/RD5_Assignment/onlineBank/bank?Message=".$Message);
    }


    function withdraw(){
        $this->userCheck();
        session_start();
        $today = date("Y/m/d");
        if($_SERVER['REQUEST_METHOD']=='GET') {
            if(isset($_GET['Message'])){
                echo $_GET['Message'];
            }
            return $this->view("Bank/withdraw");
        }
        $link = include 'config.php';
        $sql = <<<mutil
            insert into trade(
                userId, status, amount, content, tradeDate
            )
            values(
                "$_SESSION[userId]", "提款", "$_POST[amount]",
                "$_POST[comment]", "$today"
            )
        mutil;
        mysqli_query($link, $sql);
        $sql = <<<mutil
                update user set total = total - $_POST[amount] where userId = "$_SESSION[userId]";
        mutil;
        mysqli_query($link, $sql);
        $Message = "提款成功";
            return header("Location: http://localhost:8888/RD5_Assignment/onlineBank/bank?Message=".$Message);
    }



    function tradeSearch(){
        $this->userCheck();
        return $this->view("Bank/tradeSearch");
    }



    function amountSearch(){
        session_start();
        $link = include 'config.php';
        $sql = <<<mutil
            select * from user where userId = "$_SESSION[userId]";
        mutil;
        $result = mysqli_query($link, $sql);
        $search = mysqli_fetch_assoc($result);
        echo $search['total'];
    }



    function userCheck(){
        session_start();
        if(!isset($_SESSION['userId'])){
            $Message = "請登入會員";
            return header("Location: http://localhost:8888/RD5_Assignment/onlineBank/login?Message=".$Message);
        }
    }
}
