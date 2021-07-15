CREATE DATABASE CadastroUsuario;

CREATE TABLE 'usuario' (
    'id' int(11) NOT NULL AUTO_INCREMENT,
    'nome' varchar(255) DEFAULT NULL,
    'nascimento' date DEFAULT NULL,
    'sexo' varchar(255) DEFAULT NULL,
    'email' varchar(255) DEFAULT NULL,
    'telefone' varchar(255) DEFAULT NULL,
    'cpf' varchar(255) DEFAULT NULL,
    'imagem' varchar(255) DEFAULT NULL,
    PRIMARY KEY ('id')
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8