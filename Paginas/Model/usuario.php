<?php 
    class usuario{
        public $id;
        public $nome;
        public $nascimento;
        public $sexo;
        public $email;
        public $telefone;
        public $cpf;
        public $imagem;
    

        function construtor($id, $nome, $nascimento, $sexo, $email, $telefone, $cpf, $imagem){
            $this->id = $id;
            $this->nome = $nome;
            $this->nascimento = $nascimento;
            $this->sexo = $sexo;
            $this->email = $email;
            $this->telefone = $telefone;
            $this->cpf = $cpf;
            $this->imagem = $imagem;
        }

        function inserir_usuario(){
            Insert("usuario","'$this->nome','$this->nascimento','$this->sexo','$this->email','$this->telefone','$this->cpf','$this->imagem'");
        }
        
        function deletar_usuario(){
            Delete("usuario","'$this->id'");
        }

        function alterar_usuario(){
            Update("usuario","nome='$this->nome'
                ,nascimento='$this->nascimento'
                ,sexo='$this->sexo'
                ,email='$this->email'
                ,telefone='$this->telefone'
                ,cpf='$this->cpf'
                ,imagem='$this->imagem'"
                ,$this->id);
        }

        function get_usuarios (){
            return Consulta("SELECT * FROM usuario");
        }

        function get_usuario($id){
            $rs = Consulta("SELECT * FROM usuario WHERE id = '$id'");

            $this->id = $rs[0]['id'];
            $this->nome = $rs[0]['nome'];
            $this->nascimento = $rs[0]['nascimento'];
            $this->sexo = $rs[0]['sexo'];
            $this->email = $rs[0]['email'];
            $this->telefone = $rs[0]['telefone'];
            $this->cpf = $rs[0]['cpf'];
            $this->imagem = $rs[0]['imagem'];
        }
    }

?>