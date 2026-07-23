<?php


class Usuario{
    private PDO $conexao;

    public function __construct(PDO $db){
        $this->conexao = $db;
    }
    
    // inserir um novo usuario
    public function cadastrar(array $dados): bool{
        $sql = "INSERT INTO usuarios
                (nome, cpf, data_nascimento, email, telefone, endereco, cidade, estado)
                VALUES
                (:nome, :cpf, :data_nascimento, :email, :telefone, :endereco, :cidade, :estado)"; // evitar SQL injection usando prepared statements
        
        $stmt = $this->conexao->prepare($sql);

        //mapear os dados do array para os parâmetros da query
        return $stmt->execute([
            ':nome' => $dados['nome'],
            ':cpf' => $dados['cpf'],
            ':data_nascimento' => $dados['data_nascimento'],
            ':email' => $dados['email'],
            ':telefone' => $dados['telefone'],
            ':endereco' => $dados['endereco'],
            ':cidade' => $dados['cidade'],
            ':estado' => $dados['estado']
        ]); // retorna true se a execução foi bem-sucedida, false caso contrário
    }

    public function listarTodos(): array{
        $sql = "SELECT * FROM usuarios ORDER BY nome ASC";
        $stmt = $this->conexao->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): array|false{
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC); // retorna o usuario como array associativo ou false se não encontrado
    }

    public function atualizar(int $id, array $dados): bool{
        $sql = "UPDATE usuarios SET
                nome = :nome,
                cpf = :cpf,
                data_nascimento = :data_nascimento,
                email = :email,
                telefone = :telefone,
                endereco = :endereco,
                cidade = :cidade,
                estado = :estado
                WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);

        //mapear os dados do array para os parâmetros da query
        return $stmt->execute([
            ':id' => $id,
            ':nome' => $dados['nome'],
            ':cpf' => $dados['cpf'],
            ':data_nascimento' => $dados['data_nascimento'],
            ':email' => $dados['email'],
            ':telefone' => $dados['telefone'],
            ':endereco' => $dados['endereco'],
            ':cidade' => $dados['cidade'],
            ':estado' => $dados['estado']
        ]); // retorna true se a execução foi bem-sucedida, false caso contrário
    }

    public function deletar(int $id): bool{
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}