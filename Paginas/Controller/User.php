<?php require('../../../Shared/Arquivo/Funcoes.php'); 
    require('../../Model/usuario.php');

    $usuario=new usuario(); //Cria objeto de usuário vazio
    $btn=recive("btn");
    $erro=false;

    if($btn=="edit"){
        $usuario->get_usuario(recive('id')); //Pega o usuário escolhido para edição
    }

    if($btn=="delete"){
        $usuario->get_usuario(recive('id')); //Pega usuário escolhido para deleção
        $usuario->deletar_usuario(); //Deleta usuário
    }

    //Envia formulário
    if($btn=="enviar"){
        if(recive('id')){
            $id = recive('id');
        }else{
            $id = '';
        }

        //Verificação de erro
        if(!recive("nome")){
            $erro.="Insira o nome<br>";
        }else{
            $nome=recive("nome");
        }

        if(!recive("data")){
            $erro.="Insira a data de nascimento<br>";
        }else{
            $nascimento=recive("data");
        }

        if(!recive("sexo")){
            $erro.="Insira o gênero<br>";
        }else{
            $sexo=recive("sexo");
        }

        if(!recive("email")){
            $erro.="Insira o e-mail<br>";
        }else{
            $email=recive("email");
        }

        if(!recive("tel")){
            $erro.="Insira o telefone<br>";
        }else{
            $telefone=recive("tel");
        }

        if(!recive("cpf")){
            $erro.="Insira o CPF<br>";
        }else{
            $cpf=recive("cpf");
        }

        if(isset($_files["foto"])){
            $erro.="Insira a foto<br>";
        }
        if(!$erro){ //Caso não tenha erro faz as ações
            $imagem=$_FILES["foto"]["name"];
            $imagemTemporario=$_FILES["foto"]["tmp_name"];

            $usuario->construtor($id, $nome, $nascimento, $sexo, $email, $telefone, $cpf, $imagem);

            if($usuario->id == ''){ //Verifica se o id do usuario foi enviado
                $usuario->inserir_usuario(); //Caso não tenha sido enviado o id ele cria um novo
            }else{
                $usuario->alterar_usuario(); //Caso tenha sido enviado o id ele altera o usuário
            }

            move_uploaded_file($imagemTemporario,"../../../Shared/Imagem/$imagem");
        }
    }

    //Seleciona com base no usuário
    if($usuario->sexo == 'Masculino'){
        $masculino = "selected";
        $feminino = "";
        $outros = "";
    }elseif($usuario->sexo == 'Feminino'){
        $masculino = "";
        $feminino = "selected";
        $outros = "";
    }else{
        if($usuario->sexo != ""){
            $masculino = "";
            $feminino = "";
            $outros = $usuario->sexo;
        }else{
            $masculino = "";
            $feminino = "";
            $outros = "";
        }
    }
    if($btn != "edit"){
        $usuario=new usuario(); //Limpa usuário caso não seja edição dele
    }
    $rs_usuarios = $usuario->get_usuarios();


    //Cria paginação
    $tamanho_pagina = 20;
    $page = recive('page');
    if(!$page){
        $page = 0;
    }
    if(($page*$tamanho_pagina)+$tamanho_pagina >= sizeof($rs_usuarios)){
        $rows = sizeof($rs_usuarios);
    }else{
        $rows = ($page*$tamanho_pagina)+$tamanho_pagina;
    }
?> 
