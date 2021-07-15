/*14/07/2021*/
$(document).ready(function(){
    $("#tel").mask("(99) 99999-9999");
});
$(document).ready(function(){
    $("#cpf").mask("999.999.999-99");
});

function Sexo(obj){
    if(obj.value == 'X'){
        $("#sexo").addClass('d-none')
        $("#sexo-outro").removeClass('d-none')
        $("#sexo-outro").addClass('d-flex')
        $("#select1").prop('selected',true)
    }else{
        $("#sexo").removeClass('d-none')
        $("#sexo-outro").addClass('d-none')
        $("#sexo-outro").removeClass('d-flex')
    }
}

function Edit(id){
    location.href = 'User.php?id='+id+'&btn=edit'
}

function Delete(id,nome){
    var resposta = confirm('Deseja resalmente deletar o usuário '+nome+' ?')
    if(resposta){
        location.href = 'User.php?id='+id+'&btn=delete'
    }
}