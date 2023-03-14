<?php
    require_once 'CLASSES/usuarios.php';
    $u = new Usuario;
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
<body>
<div id="corpo-form">
    <h1>Entrar</h1>
    <form method="POST"> <!--Post é mais seguro que GET para senhas, action, manda o que for capturado para a página que processará os dados-->
        <input type="email" name="email" placeholder="Usuário" maxlength="40"> <!--email-->
        <input type="password" name="senha" placeholder="Senha" maxlength="15"> <!--senha-->
        <input type="submit" value="ACESSAR"> <!--botão de envio-->
        <a href="cadastrar.php">Ainda não é inscrito?<strong>Cadastre-se!</strong></a>
    </form>
</div>
<?php
//capturar todas as informações digitadas pelo usuário após o submit;
//1 - Verificar se a pessoa clicou no botão logar;
if(isset($_POST['email'])){//isset checa se veio algum atributo name, a partir do POST
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    //2 - verificar se esta preenchido
    if(!empty($email) && !empty($senha)){ // empty verifica se o campo foi preenchido,se sim então verifica conexão
        $u->conectar("login_arca","localhost", "root", "secret");//conectar com banco de dados para realizar consultas;
        if($u->msgErro == ""){
            if($u->logar($email, $senha)){//se true, quer dizer que id foi encontrado
                header("location: AreaPrivada_A.php");
            }else{ // se false, id não encontrado
                ?>
                <div class="msg-erro">
                    Email e/ou senha estão incorretos!
                </div>
                <?php
            }
        }else{
            ?>
            <div class="msg-erro">
                <?php echo "Erro ".$u->msgErro;?>
            </div>
            <?php
        }
    }else{ // se estiverem vazios imprimir a msg
        ?>
        <div class="mag-erro">
            Preencha todos os campos!
        </div>
        <?php
    }
}
?>
</body>
</html>
