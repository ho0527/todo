<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="index.css" rel="Stylesheet">
        <title>重設帳密</title>
    </head>
    <body>
        <form>
            <?php
                include("link.php");
                if(isset($_GET["number"])){
                    $number=$_GET["number"];
                    $user=mysqli_query($db,"SELECT*FROM `user` WHERE `userNumber`='$number'");
                    $admin=mysqli_query($db,"SELECT*FROM `admin` WHERE `adminNumber`='$number'");
                    if($row=mysqli_fetch_row($user)){
                        ?>
                        <from>
                            帳號id: <input type="text" name="number" value="<?php echo($number); ?>" readonly><br><br>
                            用戶帳號: <input type="text" name="username" value="<?php echo($row[1]); ?>"><br><br>
                            用戶名: <input type="text" name="name" value="<?php echo($row[3]); ?>"><br><br>
                            密碼: <input type="text" name="code" value="<?php echo($row[2]); ?>"><br><br>
                            <button name="enter">更改帳號</button>
                        </from>
                        <?php
                    }elseif($row=mysqli_fetch_row($admin)){
                        ?>
                        <from>
                            帳號id: <input type="text" name="number" value="<?php echo($number); ?>" readonly><br><br>
                            用戶帳號: <input type="text" name="username" value="<?php echo($row[1]); ?>"><br><br>
                            用戶名: <input type="text" name="name" value="<?php echo($row[3]); ?>"><br><br>
                            密碼: <input type="text" name="code" value="<?php echo($row[2]); ?>"><br><br>
                            <button name="enter">更改帳號</button>
                        </from>
                        <?php
                    }else{
                        echo("帳號已被刪除"."<br>");
                    }
                }
            ?>
        </form><br>
        <button id="go_back" onclick="location.href='adminWelcome.php'">返回主頁</button><br>
        <?php
            if(array_key_exists("enter",$_GET)){
                $username=$_GET["username"];
                $code=$_GET["code"];
                $name=$_GET["name"];
                $user=mysqli_query($db,"SELECT*FROM `user` WHERE `userNumber`='$number'");
                $admin=mysqli_query($db,"SELECT*FROM `admin` WHERE `adminNumber `='$number'");
                if($row=mysqli_fetch_row($user)){
                    if($row[4]==$number){
                        if($username!=""&&$code!=""){
                            mysqli_query($db,"UPDATE `user` SET `name`='$name',`userCode`='$code',`userName`='$username' WHERE `userNumber`='$number'");
                            $row=mysqli_fetch_row(mysqli_query($db,"SELECT*FROM `user` WHERE `userNumber`='$number'"));
                            mysqli_query($db,"INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`logintime`,`logouttime`,`move`,`movetime`)
                            VALUES('$number','$row[1]','$row[2]','$row[3]','一般使用者','-','-','editbyadmin','$time')");
                            ?><script>alert("更改成功!");location.href="adminWelcome.php"</script><?php
                        }else{
                            echo("請填寫帳密");
                        }
                    }
                }elseif($row=mysqli_fetch_row($admin)){
                    if($row[4]==$number){
                        if($username!=""&&$code!=""){
                            mysqli_query($db,"UPDATE `admin` SET `name`='$name',`adminCode`='$code',`adminName`='$username' WHERE `adminnumber`='$number'");
                            mysqli_query($db,"INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`logintime`,`logouttime`,`move`,`movetime`)
                            VALUES('$number','$row[1]','$row[2]','$row[3]','管理者','-','-','editbyadmin','$time')");
                            $row=mysqli_fetch_row(mysqli_query($db,"SELECT*FROM `admin` WHERE `adminNumber`='$number'"));
                            mysqli_query($db,"INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`move`,`movetime`)VALUES('$number','$row[1]','$row[2]','$row[3]','管理者','editbyadmin','$time')");
                            header("location:adminedit?number=$number");
                            ?><script>alert("更改成功!");location.href="adminWelcome.php"</script><?php
                        }else{
                            echo("請填寫帳密");
                        }
                    }
                }
            }
        ?>
    </body>
</html>