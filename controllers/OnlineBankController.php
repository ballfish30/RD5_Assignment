<?php

class OnlineBankController extends Controller
{

    function index(){
        if($_SERVER['REQUEST_METHOD']=='GET') {
            $this->view("User/login");
        }
    }


    function login(){
        session_start();
        if($_SERVER['REQUEST_METHOD']=='GET') {
            if(isset($_GET['Message'])){
                echo $_GET['Message'];
            }
            $this->view("User/login");
            die;
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
            header("Location: http://localhost:8888/RD5_Assignment/onlineBank/login?Message=".$Message);
            die;
        }
        elseif(!password_verify($passwd, $search['passwd'])){
            $Message = "密碼錯誤";
            header("Location: http://localhost:8888/RD5_Assignment/onlineBank/login?Message=".$Message);
            die;
        }
        $_SESSION['userId'] = $search['userId'];
        $Message = "親愛的用戶$userName" . "你好";
        header("Location: http://localhost:8888/RD5_Assignment/onlineBank/bank?Message=".$Message);
        die;
    }



    function logout(){
        session_destroy();
        $this->view("User/login");
    }



    function register(){
        if($_SERVER['REQUEST_METHOD']=='GET') {
            if(isset($_GET['Message'])){
                echo $_GET['Message'];
            }
            $this->view("User/register");
            die;
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
            die;
        }else{
            $Message = "帳號或信箱重複";
            header("Location: http://localhost:8888/RD5_Assignment/onlineBank/register?Message=".$Message);
            die;
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
        session_start();
        if($_SERVER['REQUEST_METHOD']=='GET') {
            if(isset($_GET['Message'])){
                echo $_GET['Message'];
            }
            $this->view("Bank/bank");
        }
    }



    function deposit(){
        if($_SERVER['REQUEST_METHOD']=='GET') {
            if(isset($_GET['Message'])){
                echo $_GET['Message'];
            }
            $this->view("Bank/deposit");
        }
    }


    function withdraw(){
        if($_SERVER['REQUEST_METHOD']=='GET') {
            if(isset($_GET['Message'])){
                echo $_GET['Message'];
            }
            $this->view("Bank/withdraw");
        }
    }



    function tradeSearch(){
        $this->view("Bank/tradeSearch");
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
}
