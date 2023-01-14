<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>一般會員專區</title>
        <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
        <link href="index.css" rel="Stylesheet">
    </head>
    <body>
        <?php
            include("link.php");
            include("userdef.php");
            unset($_SESSION["todoval"]);
        ?>
        <table class="main-table">
            <tr>
                <td class="user-table2">
                    <class class="date-time">
                        <form>
                            <?php
                                $date=$_SESSION["date"];
                                echo("目前日期: ".$date);
                            ?><br>
                                <input type="date" id="date" value="" name="date">
                                <button type="submit" name="enter" id="date-button">送出</button>
                                <script src="todaydate.js"></script>
                        </form>
                        <?php
                            if(isset($_GET["enter"])){
                                @$_SESSION["date"]=$_GET["date"];
                                header("location:userWelcome.php");
                            }
                        ?>
                    </class>
                </td>
                <td class="title">一般會員專區</td>
                <td class="all" rowspan="2"></td>
            </tr>
            <tr>
                <td class="todo">
                    <class>TODO工作表</class>
                    <span id=uper>
                        <table style="border-collapse:collapse;">
                            <form>
                                <tr>
                                    <td class="todo-title-time">時間</td>
                                    <td class="todo-title-work">工作計畫</td>
                                </tr>
                                <?php
                                    $m=0;
                                    for($i=0;$i<=22;$i=$i+2){
                                        ?>
                                        <tr>
                                            <td class="todo-title-main<?= $m%2+1; ?>"><?php echo(str_pad($i,2,"0",STR_PAD_LEFT)."~".str_pad($i+2,2,"0",STR_PAD_LEFT)); ?></td>
                                            <td class="todo-main<?= $m%2+1; ?>" id="<?= $m+1 ?>"></td>
                                        </tr>
                                        <?php
                                        $m=$m+1;
                                    }
                                    if(isset($_SESSION["priority"])||isset($_SESSION["deal"])){
                                        @$priority=$_SESSION["priority"];
                                        @$deal=$_SESSION["deal"];
                                        $todo_conditions="`date`='$date'";
                                        if($deal=="未處理"||$deal=="處理中"||$deal=="已完成"){
                                            $todo_conditions=$todo_conditions." AND `deal`='$deal'";
                                        }
                                        if($priority=="普通"||$priority=="速件"||$priority=="最速件"){
                                            $todo_conditions=$todo_conditions." AND `priority`='$priority'";
                                        }
                                        $todo=mysqli_query($db, "SELECT*FROM `todo` WHERE $todo_conditions");
                                        uper($todo);
                                    }else{
                                        $todo=mysqli_query($db, "SELECT*FROM `todo` WHERE `date`='$date'");
                                        uper($todo);
                                    }
                                ?>
                            </form>
                        </table>
                    </span>
                    <span id=lower>
                        <table style="border-collapse:collapse;">
                            <form>
                                <tr>
                                    <td class="todo-title-time">時間</td>
                                    <td class="todo-title-work">工作計畫</td>
                                </tr>
                                <?php
                                    $m=0;
                                    for($i=22;$i>=0;$i=$i-2){
                                        ?>
                                        <tr>
                                            <td class="todo-title-main<?= $m%2+1; ?>"><?php echo(str_pad($i+2,2,"0",STR_PAD_LEFT)."~".str_pad($i,2,"0",STR_PAD_LEFT)); ?></td>
                                            <td class="todo-main<?= $m%2+1; ?>" id="<?= $m+1; ?>"></td>
                                        </tr>
                                        <?php
                                        $m=$m+1;
                                    }
                                    if(isset($_SESSION["priority"])||isset($_SESSION["deal"])){
                                        @$priority=$_SESSION["priority"];
                                        @$deal=$_SESSION["deal"];
                                        $todo_conditions="`date`='$date'";
                                        if($deal=="未處理"||$deal=="處理中"||$deal=="已完成"){
                                            $todo_conditions=$todo_conditions." AND `deal`='$deal'";
                                        }
                                        if($priority=="普通"||$priority=="速件"||$priority=="最速件"){
                                            $todo_conditions=$todo_conditions." AND `priority`='$priority'";
                                        }
                                        $todo=mysqli_query($db, "SELECT*FROM `todo` WHERE $todo_conditions");
                                        lower($todo);
                                    }else{
                                        $todo=mysqli_query($db, "SELECT*FROM `todo` WHERE `date`='$date'");
                                        lower($todo);
                                    }
                                ?>
                            </form>
                        </table>
                    </span>
                </td>
                <td class="user-table4">
                    <form>
                        開始時間: <input type="button" id="starttime" value="升冪" style="width:165px"><br>
                        處理情形: <input type="button" id="dealc" value="升冪" style="width:85px">
                        <select style="width:75px" name="deal-select">
                            <option>篩選器</option>
                            <option>未處理</option>
                            <option>處理中</option>
                            <option>已完成</option>
                        </select><br>
                        優先情形: <input type="button" id="priorityc" value="升冪" style="width:85px">
                        <select style="width:75px" name="priority-select">
                            <option>篩選器</option>
                            <option>普通</option>
                            <option>速件</option>
                            <option>最速件</option>
                        </select><br>
                        <button type="submit" id="newtodo" class="right" name="selecter">確定(篩選器)</button>
                        <button type="button" id="newtodo" class="newtodo" onclick="location.href='useradd.php'">新增todo</button><br><br>
                        <button type="button" id="setting-button" class="setting-button" onclick="location.href='setting.php'">setting</button>
                        <button type="submit" id="loggout-button" class="loggout-button" name="logout">logout</button>
                        <button type="button" id="user-button" class="user-button">用戶</button>
                    </form>
                    <?php
                        if(isset($_GET["preview"])){
                            $id=$_GET["preview"];
                            @$row=mysqli_fetch_row(mysqli_query($db,"SELECT*FROM `todo` WHERE `id`='$id'"));
                            ?>
                            <div class="div">
                                標題: <?= @$row[1]; ?><br>
                                詳細內容: <?= @$row[7]; ?>
                                <button onclick="location.href='userWelcome.php'" id="button4">關閉</button>
                            </div>
                            <?php
                        }
                    ?>
                </td>
            </tr>
        </table>
        <form>
            <?php
                @$user_data=$_SESSION["data"];
                if(isset($_GET["logout"])){
                    $user=mysqli_query($db,"SELECT*FROM `user` WHERE `userNumber`='$user_data'");
                    $row=mysqli_fetch_row($user);
                    if(isset($user_data)){
                        mysqli_query($db,"UPDATE `data` SET `logouttime`='$time' WHERE `usernumber`='$user_data' AND `logouttime`=''");
                        mysqli_query($db,"INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`logintime`,`logouttime`,`move`,`movetime`)
                        VALUES('$user_data','$row[1]','$row[2]','$row[3]','一般使用者','-','-','登出','$time')");
                        ?><script>alert("登出成功!");location.href="index.php"</script><?php
                        session_unset();
                    }else{
                        mysqli_query($db,"INSERT INTO `data`(`usernumber`,`username`,`password`,`name`,`permission`,`logintime`,`logouttime`,`move`,`movetime`)
                        VALUES('null','','','','','','','登出','$time')");
                        ?><script>alert("登出成功!");location.href="index.php"</script><?php
                        session_unset();
                    }
                }
                if(isset($_GET["edit"])){
                    unset($_SESSION["todoval"]);
                    $_SESSION["todoval"]=$_GET["edit"];
                    ?><script>location.href="useradd.php"</script><?php
                }
                if(isset($_GET["selecter"])){
                    $_SESSION["priority"]=$_GET["priority-select"];
                    $_SESSION["deal"]=$_GET["deal-select"];
                    ?><script>location.href="userWelcome.php"</script><?php
                }
            ?>
        </form>
        <script src="todo.js"></script>
        <script src="todobox.js"></script>
    </body>
</html>