<?php require 'header.php'; ?>

<div  class="d-flex justify-content-between align-items-center mb-4">
    <h2>Usuários Cadastrados</h2>
    <a href="index.php?acao=criar" class="btn btn-primary"> + Novo Usuário</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <?php if (empty($usuarios)): ?>
            <div class="alert alert-info" role="alert">
                Nenhum usuário cadastrado.
            </div> 
        <?php else: ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Data de Nascimento</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['nome']) ?></td>
                            <td><?= htmlspecialchars($usuario['cpf']) ?></td>
                            <td><?= htmlspecialchars($usuario['data_nascimento']) ?></td>
                            <td><?= htmlspecialchars($usuario['email']) ?></td>
                            <td>
                                <a href="index.php?acao=ver&id=<?= $usuario['id'] ?>" class="btn btn-sm btn-info">Ver</a>
                                <a href="index.php?acao=editar&id=<?= $usuario['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="index.php?acao=deletar&id=<?= $usuario['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja deletar este usuário?');">Deletar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?php require 'footer.php'; ?>