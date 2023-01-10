<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>網站前台登入介面</title>
        <link href="index.css" rel="Stylesheet">
    </head>
    <body>
        <form>
            <?php session_start(); ?>
            <h1>TODO工作管理系統</h1>
            <h3>
                帳號: <input type="text" name="username" id="username" value="<?= @$_SESSION["username"] ?>"><br>
                密碼: <input type="password" name="code" id="code" value="<?= @$_SESSION["password"] ?>"><br>
            </h3>
            <class class="text">驗證碼:</class><br>
            <?php
                for($i=0;$i<3;$i=$i+1){
                    $str=range("a","z");
                    $finalStr = $str[rand(0,25)];
                    ?>
                    <div class="dragbox" id="dragbox">
                        <img src="verifyCode.php?val=<?=$finalStr?>" id="<?= $finalStr ?>" class="dragimg" draggable="true"></img>
                    </div>
                    <?php
                }
            ?>
            <input type="submit" name="reflashpng" value="重新產生">
            <h6>請拖動驗證碼圖片
                <?php
                    $key=rand(0,1);
                    $string=array(
                        "'由大排到小'",
                        "'由小排到大'"
                    );
                    echo($string[$key]);
                ?><br>
                <div class="dropbox" id="dropbox"></div>
            </h6>
            <input type="submit" value="清除" name="clear" class="button2">
            <button type="button" class="button2" onclick="loginclick(<?= $key ?>)" id="login">登入</button><br><br>
            <?php
                if(isset($_GET["reflashpng"])){
                    @$_SESSION["username"]=$_GET["username"];
                    @$_SESSION["password"]=$_GET["code"];
                    header("location:index.php");
                }
                if(isset($_GET["clear"])){
                    session_unset();
                    header('location.index.php');
                }
            ?>
        </form>
        <script src="verifyCode.js"></script>
    </body>
</html>