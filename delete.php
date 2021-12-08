<?php
include_once('conection.php');
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if(!empty($id)){
    $query_user = "delete from usuarios where id = :id";
    $result_user = $conn->prepare($query_user);
    $result_user->bindParam(':id',$id);
    if($result_user->execute())
        $return = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Usuário deletado.</div>"];
    else
        $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Não foi possível deletar.</div>"];
    
    // $row_user = $result_user->fetch(PDO::FETCH_ASSOC);
    // $return = ['erro' => false, 'dados' => $row_user];
}else{
    $return = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado.</div>"];
}
echo json_encode($return);