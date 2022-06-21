<?php

class view_default_auth extends view_abstract
{

  function body()
  {
    if(isset($this->msg))
    {
    ?>
    <span><?=$this->msg?></span>
    <?php 
    }
    ?>
    <form method="post" action="/auth" name="auth" >
        <label>Login:</label>
        <input type="text" name="login"/>
        <label>Senha:</label>
        <input type="password" name="password"/>
        <input type="submit" name="submit" value="Login"/>
    </form>
    <?php 

  }
}