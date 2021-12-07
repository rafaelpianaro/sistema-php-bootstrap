<?php
include_once('conection.php');
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if(!empty($id)){
    $query_user = "select id,nome,email from usuarios where id =:id limit 1";
    $result_user = $conn->prepare($query_user);
    $result_user->bindParam(':id',$id);
    $result_user->execute();
    $row_user = $result_user->fetch(PDO::FETCH_ASSOC);
    $return = ['erro' => false, 'dados' => $row_user];
}else{
    $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado.</div>"];
}
echo json_encode($return);