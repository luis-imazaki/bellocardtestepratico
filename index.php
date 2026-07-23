<?php

require_once __DIR__ . '/app/config/Database.php';
require_once __DIR__ . '/app/models/Usuario.php';
require_once __DIR__ . '/app/controllers/UsuarioController.php';

$controller = new UsuarioController(); // instancia o controlador de usuários

$acao = $_GET['acao'] ?? 'listar'; // obtém a ação da query string, padrão é 'listar'

switch ($acao) {
    case 'listar':
        $controller->listar();
        break;
    case 'criar':
        $controller->criar();
        break;
    case 'salvar':
        $controller->salvar();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'atualizar':
        $controller->atualizar();
        break;
    case 'deletar':
        $controller->deletar();
        break;
    case 'ver':
        $controller->ver();
        break;
    default:
        $controller->listar(); // ação padrão é listar usuários
        break;
}