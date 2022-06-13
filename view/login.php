<?php
if(isset($err))
echo $err['msg'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Autenticação de usuário</title>
    </head>
    <body>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="auth" >
            <label>Login:</label>
            <input type="text" name="login"/>
            <label>Senha:</label>
            <input type="password" name="password"/>
            <input type="submit" name="submit" value="Login"/>
        </form>
    </body>
</html>
