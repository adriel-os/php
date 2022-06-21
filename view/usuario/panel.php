<?php
class view_usuario_panel extends view_abstract
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
      <div class="main">

      </div>
    <?php
  }
}