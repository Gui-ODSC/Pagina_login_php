<?php
//É necessário instanciar as classes que serão usadas
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
<body id="cad">
<div id="corpo-form-Cad">
    <h1>Cadastrar</h1>
    <form method="POST"> <!--Post é mais seguro que GET para senhas, action, manda o que for capturado para a página que processará os dados-->
        <input type="text" name="nome" placeholder="Nome Completo" maxlength="45"> <!--nome-->
        <input type="number" name="telefone" placeholder="Telefone" maxlength="30"> <!--número-->
        <input type="email" name="email" placeholder="Usuário" maxlength="40"> <!--email-->
        <input type="password" name="senha" placeholder="Senha" maxlength="15"> <!--senha-->
        <input type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="15"> <!--conf senha-->
        <input id="cad" type="submit" value="Cadastrar"> <!--botão de envio-->
        <a href="index.php">Já é inscrito?<strong>Faça o Login!</strong></a>
    </form>
</div>
<?php
//capturar todas as informações digitadas pelo usuário após o submit;
//1 - Verificar se a pessoa clicou no botão cadastrar;
if(isset($_POST['nome'])){//isset checa se veio algum atributo name, a partir do POST
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $confirmarSenha = addslashes($_POST['confSenha']);
    //2 - verificar se esta preenchido
    if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha)){ // empty verifica se o campo foi preenchido
        $u->conectar("login_arca","localhost", "root", "secret"); // realizando a conexão a partir do chamado do método conectar
        if($u->msgErro == ""){ // tudo ok
            if($senha == $confirmarSenha){ // antes de cadastrar é necessário verificar se $senha e $confSenha são iguais
                if($u->cadastrar($nome, $telefone, $email, $senha)){ //se true
                    ?> <!--fecha php-->
                    <div id="msg-sucesso">
                        Cadastrado com Sucesso! Acesse para entrar!
                    </div>
                    <?php
                } else{ // ja esta cadastrada
                    ?> <!--fecha php-->
                    <div class="msg-erro">
                        Email já cadastrado!
                    </div>
                    <?php
                }
            }else{ // se não exibe na tela a msg
                ?> <!--fecha php-->
                <div class="msg-erro">
                    Senha e confirmar senha não correspondem!
                </div>
                <?php
            }
        }else{ // apresenta erro
            ?>
            <div>
            <?php echo "Erro: ".$u->msgErro;?>
            </div>
            <?php
        }
    }else{
        ?> <!--fecha php-->
        <div class="msg-erro">
            Preencha todos os campos!
        </div>
        <?php
    }
}
?>
</body>
</html>
