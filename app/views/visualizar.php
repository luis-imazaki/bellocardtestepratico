<?php require 'header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Detalhes do Usuário</h2>
    <a href="index.php?acao=listar" class="btn btn-secondary">Voltar</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header text-white py-3" style="background-color: #1c3b6b;">
        <h5 class="card-title mb-0"><?= htmlspecialchars($usuario['nome']) ?></h5>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">

            <div class="col-md-6">
                <span class="text-muted d-block mb-1">CPF</span>
                <strong><?= htmlspecialchars($usuario['cpf']) ?></strong>
            </div>
            <div class="col-md-6">
                <span class="text-muted d-block mb-1">Data de Nascimento</span>
                <strong><?= htmlspecialchars($usuario['data_nascimento']) ?></strong>
            </div>
            <div class="col-md-6">
                <span class="text-muted d-block mb-1">Email</span>
                <strong><?= htmlspecialchars($usuario['email']) ?></strong>
            </div>
            <div class="col-md-6">
                <span class="text-muted d-block mb-1">Telefone</span>
                <strong><?= htmlspecialchars($usuario['telefone']) ?></strong>
            </div>
            <div class="col-md-6">
                <span class="text-muted d-block mb-1">Endereço</span>
                <strong><?= htmlspecialchars($usuario['endereco']) ?></strong>
            </div>
            <div class="col-md-6">
                <span class="text-muted d-block mb-1">Cidade</span>
                <strong><?= htmlspecialchars($usuario['cidade']) ?></strong>
            </div>
            <div class="col-md-6">
                <span class="text-muted d-block mb-1">Estado</span>
                <strong><?= htmlspecialchars($usuario['estado']) ?></strong>
            </div>
        </div>
    </div>
    <div class="card-footer bg-light text-end py-3">
        <a href="index.php?acao=editar&id=<?= $usuario['id'] ?>" class="btn btn-warning">Editar</a>
        <a href="index.php?acao=deletar&id=<?= $usuario['id'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este usuário?');">Deletar</a>
    </div>
</div>

<?php require 'footer.php'; ?>
