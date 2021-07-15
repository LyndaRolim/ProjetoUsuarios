<?php 
    session_start();
    function Includes (){
        $retorno="<head> <title>Cadastro de Usuários</title>";
        $retorno.='<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">';
        $retorno.='<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> ';
        $retorno.='<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> ';
        $retorno.='<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">';
        $retorno.='<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script> ';
        $retorno.='<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script> ';
        $retorno.='<script src="../../../Shared/Arquivo/Script.js"></script>';
        $retorno.='<link rel="stylesheet" href="../../../Shared/Arquivo/Style.css"></link>';
        $retorno.='<script src="../../../Shared/Arquivo/jquery.mask.js"></script>';
        $retorno.='<script src="'.Nome_Arquivo().'.js"></script>';
        $retorno.='<link rel="stylesheet" href="'.Nome_Arquivo().'.css"></link>';
        $retorno.='</head>';
        $retorno.='<div id="snackbar"></div>';

        return $retorno;
    }


    function Nome_Arquivo(){
        $arr = explode('/',$_SERVER['PHP_SELF']);
        $tam = sizeof($arr) - 1;
        $arr = explode('.',$arr[$tam]);
        return $arr[0];
    }

    function Conexao(){
        $bd = "CadastroUsuarios";
        $localhost = "localhost";
        $usuario = "root";
        $senha = "";
        $conexao = mysqli_connect($localhost, $usuario, $senha, $bd);
        if (mysqli_connect_error()){
            Error("Error");
        }else{
            return $conexao;
        }
    }

    function recive($val){
        if(isset($_POST[$val])){
            if(trim($_POST[$val]) != ''){
                return $_POST[$val];
            }
        }elseif(isset($_GET[$val])){
            if(trim($_GET[$val]) != ''){
                return $_GET[$val];
            }
        }elseif(isset($_SESSION[$val])){
            if(trim($_SESSION[$val]) != ''){
                return $_SESSION[$val];
            }
        }else{
            return false;
        }
    }

    function r_arr($val){
        if(isset($_POST[$val])){
            return $_POST[$val];
        }elseif(isset($_GET[$val])){
            return $_GET[$val];
        }elseif(isset($_SESSION[$val])){
            return $_SESSION[$val];
        }else{
            return false;
        }
    }

    function ExisteSql($sql){
        $query = RunSql($sql);
        if(mysqli_num_rows($query) > 0){
            return true;
        }else{
            return false;
        }
    }
    
    function NumRows($sql){
        $query = RunSql($sql);
        return mysqli_num_rows($query);
    }

    function Error($msg){
        $str = '<html>';
        $str .= Includes();
        $str .= '    <body style="background-color: #1111; color:white;"> ';
        $str .= '        <div class="body"> ';
        $str .= '            <div class="bg-danger" style="width: 60%; margin-top: 5%; border-radius: 5px; margin-left: 20%;"> ';
        $str .= '                <div style="padding: 15px; font-size: 22px; border-bottom: 1px solid;"> ';
        $str .= '                    Error ';
        $str .= '                </div> ';
        $str .= '                <div style="padding: 15px; border-bottom: 1px solid;"> ';
        $str .=                     $msg;
        $str .= '                </div> ';
        $str .= '                <div style="padding: 15px;"> ';
        $str .= '                    <a href="javascript:history.back()" style="color: white; text-decoration: none;"><i class="fas fa-arrow-left" style="margin-right: 10px;"></i>Voltar</a> ';
        $str .= '                </div> ';
        $str .= '            </div> ';
        $str .= '        </div> ';
        $str .= '    </body> ';
        $str .= '</html> ';
        die($str);
    }

    function RunSql($sql){
        return mysqli_query(Conexao(),$sql);
    }
    
    function Consulta($sql){
        $query = RunSql($sql);
        $colunas = mysqli_fetch_fields($query);
        for($i = 0; $i < sizeof($colunas); $i++){
            $arr[$i] = $colunas[$i]->name;
        }
    
        $i = 0;
        $retorno = array();
        while($rs = mysqli_fetch_assoc($query)){
            for($j = 0; $j < sizeof($arr); $j++){
                $retorno[$i][$arr[$j]] = $rs[$arr[$j]];
            }
            $i++;
        }
        return $retorno;
    }
    
    function Insert($table,$value){
        $sql = "SELECT IF(ISNULL(MAX(id)+1),1,MAX(id)+1) id FROM $table ";
        $id = Consulta($sql)[0]["id"];
        $sql = "INSERT INTO ".$table." VALUES ($id,".$value.")";
        RunSql($sql);
    }
    
    function Update($table,$values,$id){
        $sql = "UPDATE ".$table." SET ".$values." WHERE id = ".$id;
        RunSql($sql);
    }
    
    function Delete($table, $id){
        $sql = "DELETE FROM ".$table." WHERE id = ".$id;
        RunSql($sql);
    }

    
    function FormatDate($date)
    {
        $sql = "SELECT DATE_FORMAT('$date','%d/%m/%Y') data";
        $rs = Consulta($sql);
        return $rs[0]['data'];
    }
?>