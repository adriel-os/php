<?php
abstract class view_abstract
{

function __construct($options = false)
{
    // lançando atributos especificos
    if(isset($options) and $options!=false)
    {
        $this->options($options);
    }

    // lançando atributos globais
    $config = config_System::getConfig();

    if(isset($config['view']))
    {
        $this->title = $config['view']['system_name'];
        $this->options($options);
    }

    //renderizando
    $this->render();
}

function options($options)
{
    if(is_array($options))
    foreach($options as $attr=>$valor)
    {
        $this->$attr = $valor;
    }
}


function head()
{

    ?>
    <head>
        <?php 
        if(isset($this->charset))
        {
            ?>
             <meta charset="<?=$this->charset?>">
            <?php
        } ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?=$this->title?></title>
    </head>
    <?php
}

function body()
{
    ?>

    <body>
        <?=$this->body()?>
    </body>
    <?php
}

function render()
{
    ?>
    <!doctype html>
    <html>    
    <?php
    $this->head();
    $this->body();
    ?>
    </html>
    <?php
}

}
?>

