<?php

class UsuarioController {
    
    private Usuario $usuarioModel;

    public function __construct($db){
        $db = Database::getConnection(); // obtém a conexão com o banco de dados
        $this->usuarioModel = new Usuario($db); // instancia o modelo Usuario com a conexão do banco de dados
    }

    public function listar(){
        $usuarios = $this->usuarioModel->listarTodos();
        require __DIR__ . '/../views/listar.php'; // usamos require ao inves de include para caso haja algum erro, o script será interrompido
    }

    public function criar() {
        // inicializa um array de dados vazio para o formulário
        $dados = [
            'nome' => '',
            'cpf' => '',
            'data_nascimento' => '',
            'email' => '',
            'telefone' => '',
            'endereco' => '',
            'cidade' => '',
            'estado' => ''
        ];
        require __DIR__ . '/../views/criar.php';
    }

    public function salvar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->usuarioModel->cadastrar($_POST);
            header('Location: index.php?acao=listar'); // redireciona para a lista de usuários
            exit;
        }
    }

    public function editar(){
        $id = $_GET['id'] ?? null;
        if ($id !== null){
            $dados = $this->usuarioModel->buscarPorId((int)$id);
            if ($dados){
                require __DIR__ . '/../views/form.php';
            }else{
                header('Location: index.php?acao=listar'); // usuario não encontrado, redireciona para a lista de usuários
                exit;
            }
        }
    }

    public function atualizar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id !== null) {
                $this->usuarioModel->atualizar((int)$id, $_POST);
            }
            header('Location: index.php?acao=listar'); // redireciona para a lista de usuários
            exit;
        }
    }

    public function deletar(){
        $id = $_GET['id'] ?? null;
        if ($id !== null) {
            $this->usuarioModel->deletar((int)$id);
        }
        header('Location: index.php?acao=listar'); // redireciona para a lista de usuários
        exit;
    }
}