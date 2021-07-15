<?php require('../../Controller/User.php'); ?> 
<!DOCTYPE HTML>
<html lang="pt-br">
    <?=Includes()?>
    <body>
        <div style="width: 90%; margin-left: auto; margin-right: auto;" class="mb-5">
            <div class="col-xs-12 bg-white mb-5 mt-5 p-3 rounded shadow">
                <div class="fs-4 p-3 pt-0 border-bottom text-muted">
                    Cadastro de usuários
                </div>
                <form action="<?=Nome_Arquivo()?>.php" method="post" class="m-0 p-0" enctype="multipart/form-data">
                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                    <input type="hidden" name="id" value="<?=$usuario->id?>">

                    <div class="border-bottom p-3">
                        <div class="input-group">
                            <div class="col-xs-12 col-md-8 p-2">
                                <label for="nome">Nome</label>
                                <input required id="nome" value="<?=$usuario->nome?>" placeholder="Insira o nome" type="text" name="nome" class="form-control">
                            </div>

                            <div class="col-xs-12 col-md-4 p-2">
                                <label for="data">Data Nascimento</label>
                                <input required id="data" value="<?=$usuario->nascimento?>" type="date" name="data" class="form-control">
                            </div>

                            <div class="col-xs-12 col-md-4 p-2">
                                <label for="cpf">CPF</label>
                                <input required id="cpf" value="<?=$usuario->cpf?>" type="text" name="cpf" class="form-control">
                            </div>

                            <div class="col-xs-12 col-md-4 p-2">
                                <label for="sexo">Sexo</label>
                                <select id="sexo" onchange="Sexo(this)" name="sexo" class="form-select <?php if($outros != ""){echo "d-none";} ?>">
                                    <option id="select1" value=''>Selecione</option>
                                    <option <?=$masculino?> value='Masculino'>Masculino</option>
                                    <option <?=$feminino?> value='Feminino'>Feminino</option>
                                    <option value='X'>Outro</option>
                                </select> 
                                <div id="sexo-outro" class="<?php if($outros == ""){echo "d-none";} ?>" >
                                    <input value="<?=$outros?>" class=" form-control" type="text" name="sexo-outro">
                                    <button class="btn" type="button" onclick="Sexo(this)" value="">X</button>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4 p-2">
                                <label for="email">E-mail</label>
                                <input required id="email" value="<?=$usuario->email?>" placeholder="Insira o e-mail" type="mail" name="email" class="form-control">
                            </div>

                            <div class="col-xs-12 col-md-4 p-2">
                                <label for="tel">Telefone</label>
                                <input required id="tel" value="<?=$usuario->telefone?>" placeholder="Insira o telefone" type="tel" name="tel" class="form-control">
                            </div>

                            <div class="col-xs-12 col-md-8 p-2">
                                <label for="foto">Foto do usuário</label>
                                <input id="foto" value="<?=$usuario->imagem?>" type="file" name="foto" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="text-center p-3 pb-0">
                        <a href="<?=Nome_Arquivo()?>.php" class="text-dark text-decoration-none me-3">Limpar</a>
                        <button type="submit" name="btn" value="enviar" class="btn btn-outline-primary border rounded m-0">
                            Enviar
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>


            <div class="col-xs-12 bg-white mt-5 p-3 rounded shadow">
                <div class="fs-4 p-3 pt-0 border-bottom text-muted">
                    Listagem de usuários
                </div>
                <div class="border-bottom p-3">
                    <div class="input-group">
                        <div class="header-list col-sm-12">
                            <div class="col-sm-4">Nome</div>
                            <div class="col-sm-3">CPF</div>
                            <div class="col-sm-4">E-mail</div>
                            <div class="col-sm-1">Opções</div>
                        </div>
                        <ul class="col-sm-12">
                            <?php for($i = $page*$tamanho_pagina; $i < $rows ; $i++){ ?>
                                <li class="li input-group mb-3">
                                    <a class="text-decoration-none col-sm-11 text-dark a-collapse" data-bs-toggle="collapse" href="#collapseExample<?=$rs_usuarios[$i]['id']?>" role="button" aria-expanded="false" aria-controls="collapseExample<?=$rs_usuarios[$i]['id']?>">
                                        <div class="col-sm-4 ps-2 "><?= $rs_usuarios[$i]['nome'] ?></div>
                                        <div class="col-sm-3 ps-5"><?= $rs_usuarios[$i]['cpf'] ?></div>
                                        <div class="col-sm-4 ps-5" style='overflow:auto;'><?= $rs_usuarios[$i]['email'] ?></div>
                                    </a>

                                    <div class="col-sm-1 p-0 m-0">
                                        <button type="button" onclick="Edit(<?=$rs_usuarios[$i]['id']?>)" class="btn"><i class="fas fa-edit"></i></button>
                                        <?php $nome = $rs_usuarios[$i]['nome']; ?>
                                        <button type="button" onclick="Delete(<?=$rs_usuarios[$i]['id']?>,'<?=$nome?>')" class="btn"><i class="fas fa-trash"></i></button>
                                    </div>
                                </li>
                                <div class="collapse" id="collapseExample<?=$rs_usuarios[$i]['id']?>">
                                    <div class="card card-body ">
                                        <div class="input-group">
                                            <div class="col-sm-12 text-center col-md-6">
                                                <?php if(!file_exists('../../../Shared/Imagem/'.$rs_usuarios[$i]['imagem'])){
                                                    $imagem = '../../../Shared/Imagem/sem-foto.jpg';
                                                }elseif($rs_usuarios[$i]['imagem'] == "" ){
                                                    $imagem = '../../../Shared/Imagem/sem-foto.jpg';
                                                }else{
                                                    $imagem = '../../../Shared/Imagem/'.$rs_usuarios[$i]['imagem'];
                                                } ?>
                                                <img class="border rounded shadow" src="<?=$imagem?>">
                                            </div>
                                            <div class="col-sm-12 col-md-6  ">
                                                <div class="col-sm-12 col-md-12">
                                                    Telefone: <?= $rs_usuarios[$i]['telefone'] ?>
                                                </div>
                                                <div class="col-sm-12 col-md-12">
                                                    Data de nascimento: <?= FormatDate($rs_usuarios[$i]['nascimento']) ?>
                                                </div>
                                                <div class="col-sm-12 col-md-12">
                                                    Sexo: <?= $rs_usuarios[$i]['sexo'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </ul>

                        <!-- cria paginação -->
                        <div class="col-12">
                            <ul class="pagination">
                                <?php if($page > 0){ ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?=Nome_Arquivo()?>.php?page=<?=$page-1?>" tabindex="-1">Anterior</a>
                                    </li>
                                <?php } ?>
                                <?php if(sizeof($rs_usuarios)/$tamanho_pagina > 1){ 
                                    for($pagina = 0; $pagina < sizeof($rs_usuarios)/$tamanho_pagina; $pagina++){ 
                                        if($pagina == $page){?>
                                            <li class="page-item active"><a class="page-link" href="<?=Nome_Arquivo()?>.php?page=<?=$pagina?>"><?=$pagina+1?></a></li>
                                        <?php }else{ ?>
                                            <li class="page-item"><a class="page-link" href="<?=Nome_Arquivo()?>.php?page=<?=$pagina?>"><?=$pagina+1?></a></li>
                                        <?php }
                                    } 
                                } ?>
                                <?php if(sizeof($rs_usuarios)/$tamanho_pagina > $page+1){ ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?=Nome_Arquivo()?>.php?page=<?=$page+1?>">Próximo</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        <?php 
        if($erro){
            echo "Toast($erro,'bg-danger')";
        }
        if(!$erro && $btn=="enviar" && $id == ""){
            echo "Toast('Usuário criado com sucesso.','bg-success')";
        }
        if(!$erro && $btn=="enviar" && $id != ""){
            echo "Toast('Usuário editado com sucesso.','bg-success')";
        }
        if($btn=="delete"){
            echo "Toast('Usuário excluído com sucesso.','bg-success')";
        }
        ?>
    </script>
</html>