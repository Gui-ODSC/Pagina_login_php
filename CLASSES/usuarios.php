<?php

Class Usuario{

    private $pdo;//variável vista por todos os métodos da função
    public $msgErro = ""; // variável que armazena possível erro

    //método 1 - se conectar com o banco de dados
    public function conectar($nome, $host, $usuario, $senha){
        global $pdo; // global serve como .this, para mostrar que $pdo é a mesma que a de cima
        global $msgErro;
        //caso dê errada a conexão o try tentará tratá-la
        try {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage(); //o erro é armazenado dentro de $msgErro
        }

    }

    //método 2 - Cadastra as informações, enviando-as para o banco de dados
    public function cadastrar($nome, $telefone, $email, $senha){
        global $pdo;
        //verificar (BUSCAR) se ele já esta cadastrado, através do método prepare do PDO, relacionando o email digitado com o id da tabela
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e"); //prepare = prepara operações, que serão executadas com execute
        $sql->bindValue(":e",$email);//relaciona símbolo :e com um valor de ligação no caso a variável $email
        $sql->execute();
        if($sql->rowCount() > 0){//a função rowCount; conta as linhas que vieram da tabela
            return false; //já está cadastrada
        }else{//caso não, ai cadastra
            $sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":t", $telefone);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));//OBS: é necessário criptografar a senha antes de mandar para o banco de dados
            $sql->execute();
            return true; //a pessoa foi cadastrada com sucesso
        }
    }

    //método 3 - Serve para a Tela de Login e verifica se a pessoa está cadastrada
    public function logar($email, $senha){
        global $pdo;

        //verificar se o email e senha estão cadastrados, se sim
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s"); //SELECT traz informações
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();
        if ($sql->rowCount() > 0){
            //se ela está cadastrada então entrar no sistema (sessão)
            //guardar o id da consulkta numa varialvel global da sessão
            $dado = $sql->fetch(); //transformar o que veio do banco em array, utilizando a função fetch();
            session_start(); //inicializa a sessão
            $_SESSION['id_usuario'] = $dado['id_usuario']; // id do usuario foi armazenado na sessão, portanto somente ele possui acesso a aquela sessão
            return true; //logado com sucesso
        }else{ //se não
            return false; //não foi possível logar, devido a inexistência do id;
        }
    }
}
?>