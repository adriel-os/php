<?php
$usuario = new Model_Usuario();
$usuario->populate($rotas->variables);

if($usuario->insert())
{
    echo json_encode($usuario->dados);
    return true;
}
else
{
      echo json_encode(array('acao'=>false, 'msg'=>'Usuário não cadastrado, revise os dados.', 'dados'=>$rotas->variables));
}

