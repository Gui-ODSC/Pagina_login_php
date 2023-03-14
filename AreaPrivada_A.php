<?php //teste para verificar se a sessão está ativa, ou seja se a pessoa esta logada
    session_start();
    if(!isset($_SESSION['id_usuario'])){//isset verifica se existe algo dentro da variável $_SESSION    
        header("location: index.php");//se não houver nada, encaminha o usuário para a tela principal e exit;
        exit;//para nesta linha, não mostrando a msg abaixo
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Projeto Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href="CSS/style.css">
    <script src='main.js'></script>
</head>
<body id="tela-a">
    <div id="barra-sup"><a id="sair" href ="sair.php"><strong>Sair</strong></a></div>
    <div id="tela-A">
        <h1>A</h1>
        <a href="AreaPrivada_B.php"><button style="background: #DAA520; width: 150px; border-radius: 6px; padding: 15px; cursor: pointer; color: black; border: none; font-size: 16px margin 0px;"><strong>Página B</strong></button></a>
    </div>
</body>
</html>