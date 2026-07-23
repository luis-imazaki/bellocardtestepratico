<?php
require 'header.php';

$isEdicao = !empty($dados['id']); // flag para determinar se é edição ou criação
$titulo = $isEdicao ? 'Editar Usuário' : 'Cadastrar Novo Usuário';
$action = $isEdicao ? 'index.php?acao=atualizar' : 'index.php?acao=salvar';
$botao = $isEdicao ? 'Salvar Alterações' : 'Cadastrar';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $titulo ?></h2>
    <a href="index.php?acao=listar" class="btn btn-secondary">Voltar</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="<?= $action ?>" method="POST">
            <?php if ($isEdicao): ?>
                <input type="hidden" name="id" value="<?= $dados['id'] ?>">
            <?php endif; ?>

            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label">Nome Completo *</label>
                    <input type="text" id="nome" name="nome" class="form-control" oninvalid="this.setCustomValidity('Por favor, preencha este campo.')"  oninput="this.setCustomValidity('')" required maxlength="100" placeholder="Digite o nome completo" value="<?= htmlspecialchars($dados['nome'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">CPF *</label>
                    <input type="text" id="cpf" name="cpf" class="form-control" oninvalid="this.setCustomValidity('Por favor, preencha este campo.')"  oninput="this.setCustomValidity('')" required maxlength="14" placeholder="000.000.000-00" value="<?= htmlspecialchars($dados['cpf'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Data de Nascimento *</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" placeholder="Digite sua data de nascimento" oninvalid="this.setCustomValidity('Por favor, preencha este campo.')"  oninput="this.setCustomValidity('')" required value="<?= htmlspecialchars($dados['data_nascimento'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control"  maxlength="100" placeholder="Digite o email" value="<?= htmlspecialchars($dados['email'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Telefone</label>
                    <input type="text" id="telefone" name="telefone" class="form-control" maxlength="15" placeholder="(XX) 9XXXX-XXXX" value="<?= htmlspecialchars($dados['telefone'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">CEP</label>
                    <input type="text" id="cep" name="cep" class="form-control" maxlength="9" placeholder="00000-000">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Endereço</label>
                    <input type="text" id="endereco" name="endereco" class="form-control" maxlength="100" value="<?= htmlspecialchars($dados['endereco'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Estado *</label>
                    <select id="estado" name="estado" class="form-select" oninvalid="this.setCustomValidity('Por favor, selecione um item da lista.')" onchange="this.setCustomValidity('')" required>
                        <option value="">Selecione...</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Cidade *</label>
                    <select id="cidade" name="cidade" class="form-select" oninvalid="this.setCustomValidity('Por favor, selecione um item da lista.')" onchange="this.setCustomValidity('')" required>
                        <option value="">Selecione um estado primeiro</option>
                    </select>
                </div>
                
                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success"><?= $botao ?></button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const estadoSelecionado =  "<?= htmlspecialchars($dados['estado'] ?? '') ?>";
        const cidadeSelecionada = "<?= htmlspecialchars($dados['cidade'] ?? '') ?>";

        const estados = [
            { sigla: 'AC', nome: 'Acre' },
            { sigla: 'AL', nome: 'Alagoas' },
            { sigla: 'AP', nome: 'Amapá' },
            { sigla: 'AM', nome: 'Amazonas' },
            { sigla: 'BA', nome: 'Bahia' },
            { sigla: 'CE', nome: 'Ceará' },
            { sigla: 'DF', nome: 'Distrito Federal' },
            { sigla: 'ES', nome: 'Espírito Santo' },
            { sigla: 'GO', nome: 'Goiás' },
            { sigla: 'MA', nome: 'Maranhão' },
            { sigla: 'MT', nome: 'Mato Grosso' },
            { sigla: 'MS', nome: 'Mato Grosso do Sul' },
            { sigla: 'MG', nome: 'Minas Gerais' },
            { sigla: 'PA', nome: 'Pará' },
            { sigla: 'PB', nome: 'Paraíba' },
            { sigla: 'PR', nome: 'Paraná' },
            { sigla: 'PE', nome: 'Pernambuco' },
            { sigla: 'PI', nome: 'Piauí' },
            { sigla: 'RJ', nome: 'Rio de Janeiro' },
            { sigla: 'RN', nome: 'Rio Grande do Norte' },
            { sigla: 'RS', nome: 'Rio Grande do Sul' },
            { sigla: 'RO', nome: 'Rondônia' },
            { sigla: 'RR', nome: 'Roraima' },
            { sigla: 'SC', nome: 'Santa Catarina' },
            { sigla: 'SP', nome: 'São Paulo' },
            { sigla: 'SE', nome: 'Sergipe' },
            { sigla: 'TO', nome: 'Tocantins' }
        ];
        
        const selectEstado = document.getElementById('estado');
        estados.forEach(uf => {
            let option = document.createElement('option');
            option.value = uf.sigla;
            option.textContent = uf.sigla + ' - ' + uf.nome;
            if(uf.sigla === estadoSelecionado){
                option.selected = true;
            };
            selectEstado.appendChild(option);
        });
        
        //funcao para normalizar o nome da cidade, removendo acentos e convertendo para minúsculas ('Corumbá' -> 'corumba')
        const normalizarNomeCidade = (nome) => {
            return nome.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
        };
        // carregar cidades com base no estado selecionado pela API do IBGE
        function carregarCidades(uf, cidadeSelecionada = ''){
            const selectCidade = document.getElementById('cidade');
            if(!uf){
                selectCidade.innerHTML = '<option value="">Selecione um estado primeiro</option>';
                return;
            }

            selectCidade.innerHTML = '<option value="">Carregando...</option>';
            fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${uf}/municipios`)
                .then(res => res.json())
                .then(cidades=>{
                    selectCidade.innerHTML = '<option value="">Selecione...</option>';
                    cidades.forEach(cidade=>{
                        let option = document.createElement('option');
                        option.value = cidade.nome;
                        option.textContent = cidade.nome;
                        if(normalizarNomeCidade(cidade.nome) === normalizarNomeCidade(cidadeSelecionada)){
                            option.selected = true;
                        }
                        selectCidade.appendChild(option);
                    })
                })
        }
            
        selectEstado.addEventListener('change', (e) => carregarCidades(e.target.value));

        // se houver um estado selecionado (em caso de edição), carregamos as cidades correspondentes
        if(estadoSelecionado) {
            carregarCidades(estadoSelecionado, cidadeSelecionada);
        }

        document.getElementById('cep').addEventListener('input', (e) => {
            let cep = e.target.value.replace(/\D/g, '');

            let cepFormatado = cep.replace(/(\d{5})(\d)/, '$1-$2');
            e.target.value = cepFormatado;
            if(cep.length === 8){
                document.getElementById('endereco').value = 'Carregando...';
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(res => res.json())
                    .then(dados => {
                        if(!dados.erro){
                            document.getElementById('endereco').value = `${dados.logradouro}, ${dados.bairro}`;
                            selectEstado.value = dados.uf;

                            // forcar o recarregamento das cidades para o novo estado e selecionar a cidade do CEP
                            carregarCidades(dados.uf, dados.localidade);
                        } else{
                            document.getElementById('endereco').value = 'CEP não encontrado';
                        }
                    })
                    .catch(()=>{
                        document.getElementById('endereco').value = 'Erro ao buscar CEP';
                    });
            }
        });

        // mascara para CPF, Telefone

        // mascara para CPF
        document.getElementById('cpf').addEventListener('input', function(e){
            let valor = e.target.value.replace(/\D/g, '');
            
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

            e.target.value = valor;
        })
        
        // mascara para Telefone
        document.getElementById('telefone').addEventListener('input', function(e){
            let valor = e.target.value.replace(/\D/g, '');
            
            if(valor.length > 10){
                valor = valor.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            }else{
                valor = valor.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
            }

            e.target.value = valor;
        })
        
    </script>

    <?php require 'footer.php'; ?>