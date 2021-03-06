<?php
include_once('conection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- <link href="/css/bootstrap.min.css" rel="stylesheet"> -->
    <title>CRUD - PHP FETCH</title>
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 d-flex justify-content-between aligns-items-center">
                <div>
                    <h4>Listar usuários</h4>
                </div>
                <div>
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" 
                    data-bs-target="#addUser">
                        Cadastrar
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <span id="msgAlert"></span>
        <div class="row">
            <div class="col-lg-12">
                <span class="list-users"></span>
            </div>
        </div>
    </div>
    <!-- MODAL SAVE -->
    <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserLabel">Cadastrar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="add-user-form">
                    <span id="msgAlertError"></span>
                    <div class="mb-3">
                        <label for="nome" class="col-form-label">Nome:</label>
                        <input type="text" name="nome" class="form-control" value="" id="nome" placeholder="Digite nome completo">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="col-form-label">E-mail:</label>
                        <input type="email" name="email" class="form-control" value="" id="email" placeholder="Digite e-mail">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                        <input type="submit" class="btn btn-outline-success" id="add-user-btn" value="Salvar" />
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL VIEW -->
    <div class="modal fade" id="viewUser" tabindex="-1" aria-labelledby="viewUser" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewUserLabel">Detalhes do usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgAlertErrorView"></span>
                    <dl class="row">
                        <dt class="col-sm-3">ID</dt>
                        <dd class="col-sm-9"><span id="idUser"></span></dd>
                        <dt class="col-sm-3">Nome</dt>
                        <dd class="col-sm-9"><span id="nameUser"></span></dd>
                        <dt class="col-sm-3">E-mail</dt>
                        <dd class="col-sm-9"><span id="mailUser"></span></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL EDIT -->
    <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserLabel">Editar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="edit-user-form">
                    <span id="msgAlertErrorEdit"></span>
                    <input type="hidden" name="id" id="edit_id">
                    <div class="mb-3">
                        <label for="nome" class="col-form-label">Nome:</label>
                        <input type="text" name="nome" class="form-control" value="" id="edit_nome" placeholder="Digite nome completo">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="col-form-label">E-mail:</label>
                        <input type="email" name="email" class="form-control" value="" id="edit_email" placeholder="Digite e-mail">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                        <input type="submit" class="btn btn-outline-warning" id="edit-user-btn" value="Atualizar" />
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL DELETE -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Deletar usuário</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <dl class="row">
                <dt class="col-sm-3">Nome</dt>
                <dd class="col-sm-9"><span id="nomeDelete"></span></dd>
                <dt class="col-sm-3">E-mail</dt>
                <dd class="col-sm-9"><span id="mailDelete"></span></dd>
            </dl>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="confirmDelete">Confirmar</button>
        </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="js/bootstrap.bundle.min.js"></script> -->
    <script src="js/custom.js"></script>
</body>
</html>