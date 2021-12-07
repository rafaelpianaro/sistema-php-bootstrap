<?php
include_once('conection.php');
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if(empty($data['id'])){
    $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Não foi possível atualizar.</div>"];
}elseif(empty($data['nome'])){
    $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Campo obrigatório.</div>"];
}elseif(empty($data['email'])){
    $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Campo obrigatório.</div>"];
}else{
    $query_user = "update usuarios set nome = :nome, email = :email where id = :id";
    $edit_user = $conn->prepare($query_user);
    $edit_user->bindParam(':id', $data['id']);
    $edit_user->bindParam(':nome', $data['nome']);
    $edit_user->bindParam(':email', $data['email']);

    if($edit_user->execute()){
        $return = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Usuário atualizado com sucesso.</div>"];
    }else{
        $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não atualizado.</div>"];
    }
}
echo json_encode($return);
