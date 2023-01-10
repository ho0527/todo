<?php
    include('link.php')    if(isset($_GET["username"])){
        if(!isset($_SESSION["error"])){
            $_SESSION["error"]=0;
        }
        unset($_SESSION["data"]);
        $username=$_GET['username'];
        $code=$_GET['code'];
        $user=mysqli_query($db,"SELECT*FROM `user` WHERE `userName`='$username'");
        $admin=mysqli_query($db,"SELECT*FROM `admin` WHERE `adminName`='$username'");
        if($row=mysqli_fetch_row($user)){
            $name=$row[3];
            $password=$row[2];
            $usernumber=$row[4];
            if($row[2]==$code){
                if(isset($_GET["vererror"])){
                    $_SESSION["error"]=$_SESSION["error"]+1;
                    if($_SESSION["error"]<3){
                        ?><script>alert("圖形驗證碼有誤");location.href="index.php"</script><?php
                    }else{
                        header('Location: usererror.php');
                        unset($_SESSION["error"]);
                    }
                }else{
                    ?><script>alert("登入成功");location.href="userWelcome.php"</script><?php
                    $login=mysqli_query($db,"INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`logintime`,`logouttime`,`move`,`movetime`)
                    VALUES('$usernumber','$username','$password','$name','一般使用者','$time','','登入成功','$time')");
                    unset($_SESSION["error"]);
                    $_SESSION["data"]=$usernumber;
                    $_SESSION["date"]=date("Y-m-d");
                }
            }else{
                $_SESSION["error"]=$_SESSION["error"]+1;
                if($_SESSION["error"]<3){
                    ?><script>alert("密碼有誤");location.href="index.php"</script><?php
                }else{
                    $login=mysqli_query($db,"INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`logintime`,`logouttime`,`move`,`movetime`)
                    VALUES('$usernumber','$username','$password','$name','一般使用者','$time','null','登入失敗','$time')");
                    header('Location:usererror.php');
                    unset($_SESSION["error"]);
                }
            }
        }elseif($row=mysqli_fetch_row($admin)){
            $name=$row[3];
            $password=$row[2];
            $usernumber=$row[4];
            if($row[2]==$code){
                if(isset($_GET["vererror"])){
                    $_SESSION["error"]=$_SESSION["error"]+1;
                    if($_SESSION["error"]<3){
                        ?><script>alert("圖形驗證碼有誤");location.href="index.php"</script><?php
                    }else{
                        header('Location: usererror.php');
                        unset($_SESSION["error"]);
                    }
                }else{
                    ?><script>alert("登入成功");location.href="adminWelcome.php"</script><?php
                    $login=mysqli_query($db,"INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`logintime`,`logouttime`,`move`,`movetime`)
                    VALUES('$usernumber','$username','$password','$name','管理者','$time','','登入成功','$time')");
                    unset($_SESSION["error"]);
                    $_SESSION["data"]=$usernumber;
                }
            }else{
                $_SESSION["error"]=$_SESSION["error"]+1;
                if($_SESSION["error"]<3){
                    ?><script>alert("密碼有誤");location.href="index.php"</script><?php
                }else{
                    $login=mysqli_query($db,"INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`logintime`,`logouttime`,`move`,`movetime`)
                    VALUES('$usernumber','$username','$password','$name','管理者','$time','null','登入失敗','$time')");
                    header('Location: usererror.php');
                    unset($_SESSION["error"]);
                }
            }   
        }else{
            if($_SESSION["error"]<3){
                ?><script>alert("帳號有誤");location.href="index.php"</script><?php
                $_SESSION["error"]=$_SESSION["error"]+1;
            }else{
                header('Location: usererror.php');
                unset($_SESSION["error"]);
            }
        }
    }
?>