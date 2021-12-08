<?php
include_once('conection.php');
$paginate = filter_input(INPUT_GET, "paginate", FILTER_SANITIZE_NUMBER_INT);

if(!empty($paginate)){

    // calc start pagination
    $qtd_result_page = 3;
    $start = ($paginate * $qtd_result_page) - $qtd_result_page;

// $query_users = "SELECT id, nome, email FROM usuarios LIMIT 10";
$query_users = "SELECT id, nome, email FROM usuarios ORDER BY ID DESC LIMIT $start, $qtd_result_page";
$result_users = $conn->prepare($query_users);
$result_users->execute();

$data = "<div class='table-responsive'>
            <table class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>";
while($row_user = $result_users->fetch(PDO::FETCH_ASSOC)){
    // var_dump($row_user);
    extract($row_user);
    $data .= 
    "<tr>
        <td>$id</td>
        <td>$nome</td>
        <td>$email</td>
        <td>
            <button id='$id' class='btn btn-outline-primary btn-sm' onClick='viewUser($id)'>Visualizar</button>
            <button id='$id' class='btn btn-outline-warning btn-sm' onClick='editUser($id)'>Editar</button>
            <button id='$id' class='btn btn-outline-danger btn-sm' 
            onClick='deleteUser($id)'
            data-bs-toggle='modal' data-bs-target='#deleteModal'>Deletar</button>
        </td>
    </tr>";
}
$data .= "</tbody>
            </table>
            </div>";
// pagination = sum qtd of users
$query_paginate = "SELECT COUNT(ID) AS num_result from usuarios";
$resulte_paginate = $conn->prepare($query_paginate);
$resulte_paginate->execute();
$row_paginate = $resulte_paginate->fetch(PDO::FETCH_ASSOC);

$qtd_paginate = ceil($row_paginate['num_result'] / $qtd_result_page);
$max_links = 2;
$data .= '<nav aria-label="Page navigation example"><ul class="pagination pagination-sm justify-content-center">';
$data .= "<li class='page-item'><a class='page-link' href='#' onclick='listUser(1)'>Primeira</a></li>";
for($paginate_prev = $paginate - $max_links; $paginate_prev <= $paginate - 1; $paginate_prev++){
    if($paginate_prev >= 1){
        $data .= "<li class='page-item'><a class='page-link' href='#' onclick='listUser($paginate_prev)'>$paginate_prev</a></li>";
    }
}
$data .= "<li class='page-item active'><a class='page-link' href='#'>$paginate</a></li>";
for($paginate_next = $paginate + 1; $paginate_next <= $paginate + $max_links; $paginate_next++){
    if($paginate_next <= $qtd_result_page){
        $data .= "<li class='page-item'><a class='page-link' href='#' onclick='listUser($paginate_next)'>$paginate_next</a></li>";
    }
}
$data .= "<li class='page-item'><a class='page-link' href='#' onclick='listUser($qtd_paginate)'>Última</a></li>";
// other way
// $data .= '<li class="page-item"><a class="page-link" href="'.$qtd_paginate.'">Última</a></li>';
$data .= '</ul></nav>';
echo $data;
}else{
    echo "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado.</div>";
}