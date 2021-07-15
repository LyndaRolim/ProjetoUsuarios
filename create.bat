@echo off
cls
:menu
title "Criacao de arquivo"
cls

set /p nome= Insira o nome do modulo a ser criado: 

mkdir .\Paginas\View\%nome%
echo /*%date%*/> .\Paginas\View\%nome%\%nome%.js
echo /*%date%*/ > .\Paginas\View\%nome%\%nome%.css

echo ^<?php require('../../Controller/%nome%.php'); ?^> > .\Paginas\View\%nome%\%nome%.php

echo ^<?php require('../../../Shared/Arquivo/Funcoes.php'); ?^> > .\Paginas\Controller\%nome%.php

exit