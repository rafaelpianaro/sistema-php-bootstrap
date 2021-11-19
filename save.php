<?php
include_once('conection.php');
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$query_user = "INSERT INTO usuarios(nome,email) VALUES (:nome, :email)";
$save_user = $conn->prepare($query_user);
$save_user->bindParam(':nome', $data['nome']);
$save_user->bindParam(':email', $data['email']);

$save_user->execute();

if($save_user->rowCount()){
    $return = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso.</div>"];
}else{
    $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado.</div>"];
}

echo json_encode($return);
