<?php
include_once('conection.php');

// $query_users = "select id, nome, email from usuarios order by id asc limit 10";
$query_users = "SELECT id, nome, email FROM usuarios LIMIT 10";
$result_users = $conn->prepare($query_users);
$result_users->execute();

$data = "";
while($row_user = $result_users->fetch(PDO::FETCH_ASSOC)){
    // var_dump($row_user);
    extract($row_user);
    $data .= 
    "<tr>
        <td>$id</td>
        <td>$nome</td>
        <td>$email</td>
        <td>Ações</td>
    </tr>";
}
echo $data;