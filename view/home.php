<?php
$entregas[] = array('id'=>1, 'titulo'=>'IJA', 'responsavel'=>'ADR', 'data_entrega'=>'2022-02-02');
$entregas[] = array('id'=>2, 'titulo'=>'ISA', 'responsavel'=>'ADR', 'data_entrega'=>'2022-02-23');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Entregas</title>
    </head>
    <body>
        <div class="main">
            <div class="navbar">
                <div class="item"><a href="?logout=true">Logout</a></div>
            </div>
            <div class="entregas">
            <?php 
                    if(isset($entregas) and count($entregas) > 0)
                    {
                        foreach($entregas as $index=>$entrega)
                        {
                            ?>
                            <div class="item">
                                <?="<div>$entrega[id]</div><div>$entrega[titulo]</div>";?>
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>