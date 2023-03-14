<?php //destruiremos a sessão
    session_start();//necessário startar primeiro
    unset($_SESSION['id_usuario']); //destruir/ promove segurança, não permitindo que o site possa ser reacessado através da URL
    header("location: index.php");
?>