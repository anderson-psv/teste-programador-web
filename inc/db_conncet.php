<?php
    $servername = "localhost";
    $databse    = "sistema_vendas";
    $username   = "root";
    $password   = "";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $databse);

    // Check connection
    if ($conn->connect_error)
    {
        die("Não foi possivel se conectar ao Banco de Dados: " . $conn->connect_error);
    }

    $conn->set_charset('utf8');
?>