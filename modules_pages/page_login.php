<?php
session_start();
?>

<div id="root_wrap">
    <div class="content_wrap">
        <div class="box">
            <h1>Login</h1><br>
            <form method="post" action="modules_functions/function_login.php">
                Email: <input type="text" name="email" placeholder="...@flane.de" value="<?=$_SESSION["email"]?>"><br>
                Password: <input type="password" name="pass" placeholder="*****"><br><br>
                <input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
</div>