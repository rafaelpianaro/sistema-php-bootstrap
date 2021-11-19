<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sistema_login_php";
    $port = 3308;

    try {
        $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Conexao com db realizada com sucesso.";
    } catch(PDOException $e) {
        echo "Erro: falha ao conectar com db. Erro: " . $e->getMessage();
    }
?>